<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Code;
use App\Models\product;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\OrderStatus;
use App\Models\User;
use App\Notifications\orderRequest;
use App\Notifications\ordersuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$orders = order::all();
        $products = product::all();

        if (isset($_GET['id']) && $_GET['id'] != '') {
            $orders = order::where('id',$_GET['id'])->get();
        }
        if (isset($_GET['product_id']) && $_GET['product_id'] != '') {
            $orders = order::select('orders.*')->join('bundles', 'orders.bundle_id', '=', 'bundles.id')
                ->where('bundles.product_id', '=', $_GET['product_id'])
                ->get();
        }*/

        $q = Order::query()->select('orders.*');

        if (isset($_GET['id']) && $_GET['id'] != '') {
            $q->where('orders.id', $_GET['id']);
        }

        if (isset($_GET['product_id']) && $_GET['product_id'] != '') {
            $q->join('bundles', 'orders.bundle_id', '=', 'bundles.id')->where('bundles.product_id', $_GET['product_id']);
        }

        $orders = $q->orderBy('updated_at', 'desc')->get();

        $products = Product::all();

        return view('order.index', ['orders' => $orders, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$validated = $request->validate([
            'bundle_id' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);*/

        $order = new Order();

        $order->user_id = Auth::id();

        $order->bundle_id = $request->bundle_id;

        $order->order_status_id = 2;

        $bundle = Bundle::find($request->bundle_id);


        if ($order->bundle->product->need_access) {
            $order->account_info = ['user_id' => $request->user_id];
        } elseif ($order->bundle->product->need_region_id) {
            $order->account_info = ['region_id' => $request->region_id, 'account_id' => $request->account_id];
        } elseif ($order->bundle->product->category->category == "Tarjetas") {
            $order->account_info = [];
        } else {
            $order->account_info = ['account_id' => $request->account_id];
        }



        $order->save();

        $paymentMethod = PaymentMethod::find($request->payment_method_id);

        $payment = new Payment;

        $payment->payment_method_id = $paymentMethod->id;

        if ($paymentMethod->method == "Pago Móvil") {

            $payment->data = [
                'bank' => $request->bank,
                'phone' => $request->phone,
                'transaction_id' => $request->transaction_id,
                'amount' => $request->amount,
            ];
        }

        if ($paymentMethod->method == "Zelle") {

            $payment->data = [
                'name' => $request->name,
                'confirmation_code' => $request->confirmation_code,
                'amount' => $request->amount,
            ];
        }

        if ($paymentMethod->method == "Binance (USDT)") {

            $payment->data = [
                'user_id' => $request->user_id,
                'binance_alias' => $request->binance_alias,
                'order_id' => $request->order_id,
                'amount' => $request->amount,
            ];
        }
        if ($paymentMethod->method == "Reserve") {

            $payment->data = [
                'reserve_user' => $request->reserve_user,
                'transaction_id' => $request->transaction_id,
                'amount' => $request->amount,
            ];
            if (!is_null($request->code && !empty($request->code))) {
                $code = Code::where('code', $request->code)->first();
                if ($code) {
                    if ($code->expiration_date >= now()->toDateString()) {
                        $used = order::query()->select('orders.*')->where('orders.user_id', auth()->user()->id)->join('payments', 'payments.order_id', '=', 'orders.id')->whereJsonContains('data->code', $code->code)->first();
                        if (is_null($used)) {
                            $array = array('code' => $code->code, 'code_discount' => $code->value);
                            $payment->data += $array;
                        }
                    }
                }
            }
            if ($bundle->discount > 0) {
                $array = array('bundle_discount' => $bundle->discount);
                $payment->data += $array;
            }
        }


        $order->payment()->save($payment);

        $users = User::all();

        foreach ($users as $user) {
            if ($user->hasRole(['super-admin', 'admin', 'operator'])) {
                $user->notify(new orderRequest($order));
            }
        }

        if ($order->bundle->product->category->category == "Tarjetas") {
            return redirect(route('user.giftCards'));
        } else {
            return redirect(route('user.orders'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = order::find($id);

        if ($order->orderStatus->status == 'Pendiente') {
            $order->asist_by = auth()->user()->id;
            $order->order_status_id = 3;
            $order->save();
        }

        $order = order::find($id);

        if ($order->orderStatus->status == 'Procesando') {
            if ($order->asist_by == auth()->user()->id or auth()->user()->hasRole(['admin', 'super-admin'])) {
                if ($order->bundle->product->need_access) {
                    $accountInfo = ['user_id' => $order->account_info['user_id']];
                } elseif ($order->bundle->product->need_region_id) {
                    $accountInfo = ['account_id' => $order->account_info['account_id'], 'region_id' => $order->account_info['region_id']];
                } elseif ($order->bundle->product->category->category == "Tarjetas") {
                    $accountInfo = [];
                } else {
                    $accountInfo = ['account_id' => $order->account_info['account_id']];
                }
            }
        } else {
            $accountInfo = $order->account_info;
        }

        $orderStatuses = OrderStatus::all();

        return view('order.show', ['order' => $order, 'orderStatuses' => $orderStatuses, 'accountInfo' => $accountInfo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $order = order::find($request->order_id);

        $order->order_status_id = $request->order_status;


        $order->save();

        if ($order->orderStatus->status == 'Exitoso' && $order->bundle->product->need_access) {
            $data = ['email' => 'No disponible', 'password' => 'No disponible'];
            $order->account_info = $data;
            $order->save();
        } elseif ($order->orderStatus->status == 'Exitoso') {
            if ($order->bundle->product->category->category == "Tarjetas") {
                $order->account_info = ["code" => $request->code];
                $order->save();
            }
            $user = User::find($order->user->id);
            $user->notify(new OrderSuccess($order));
        }

        return redirect(route('order.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pending()
    {
        $orders = Order::whereRelation(
            'orderStatus',
            'Status',
            '=',
            'Pendiente'
        )->orderBy('id', 'desc')->get();

        return view('order.pending', ['orders' => $orders]);
    }
}
