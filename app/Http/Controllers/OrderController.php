<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\OrderStatus;
use App\Models\User;
use App\Notifications\OrderRequest;
use App\Notifications\Ordersuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $q = Order::query()->select('orders.*');

        if ($request->filled('id')) {
            $q->where('orders.id', $request->id);
        }

        if ($request->filled('product_id')) {
            $q->join('bundles', 'orders.bundle_id', '=', 'bundles.id')->where('bundles.product_id', $request->product_id);
        }

        $orders = $q->orderBy('updated_at', 'desc')->paginate(12);

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

        $order = new Order;

        $order->user_id = Auth::id();
        $order->bundle_id = $request->bundle_id;
        $order->order_status_id = 2;
        $order->account_info = $this->checkBundleType($order, $request);
        $order->save();
        $this->payOrder($order, $request);
        $this->notifyOrder($order);

        return redirect(route('user.orders'));
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

        if ($order) {
            if ($order->orderStatus->status == 'Pendiente') {
                $order->asist_by = auth()->user()->id;
                $order->order_status_id = 3;
                $order->save();
            }

            $order = order::find($id);

            if ($order->orderStatus->status == 'Procesando') {
                if ($order->asist_by == auth()->user()->id or auth()->user()->hasRole(['admin', 'super-admin'])) {
                    if ($order->bundle->product->need_access) {
                        $accountInfo = ['phone' => $order->account_info['phone']];
                    } elseif ($order->bundle->product->need_region_id) {
                        $accountInfo = ['account_id' => $order->account_info['account_id'], 'region_id' => $order->account_info['region_id']];
                    } elseif ($order->bundle->product->category->category == "Tarjetas") {
                        $accountInfo = ['boom_user' => $order->account_info['boom_user']];
                    } else {
                        $accountInfo = ['account_id' => $order->account_info['account_id']];
                    }
                }
            } else {
                $accountInfo = $order->account_info;
            }

            $orderStatuses = OrderStatus::all();

            return view('order.show', ['order' => $order, 'orderStatuses' => $orderStatuses, 'accountInfo' => $accountInfo]);
        } else {
            return redirect(route('order.index'));
        }
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
        if ($order->orderStatus->status == 'Exitoso') {
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

    private function checkBundleType($order, $request)
    {
        if ($order->bundle->product->need_access) {
            return ['phone' => $request->phone];
        } elseif ($order->bundle->product->need_region_id) {
            return ['region_id' => $request->region_id, 'account_id' => $request->account_id];
        } elseif ($order->bundle->product->category->category == "Tarjetas") {
            return ['boom_user' => $request->user()->nick];
        } else {
            return ['account_id' => $request->account_id];
        }
    }

    private function payOrder($order, $request)
    {
        $payment = new Payment;
        $payment->payment_method_id = $request->payment_method_id;
        $payment->data = $this->setPaymentMethod($request, $payment, $order);
        $order->payment()->save($payment);
    }

    private function setPaymentMethod($request, $payment, $order)
    {
        $paymentMethod = PaymentMethod::find($request->payment_method_id);

        if ($paymentMethod->method == "PuntoYaBDV") {

            $payment->data = [
                'transactionId' => $request->transactionId,
                'description' => $request->description,
                'amount' => $request->amount,
            ];
        }

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
        }
        $this->applyDiscounts($request, $payment, $order);
        return $payment->data;
    }

    private function applyDiscounts($request, $payment, $order)
    {
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
        if ($order->bundle->discount > 0) {
            $array = array('bundle_discount' => $order->bundle->discount);
            $payment->data += $array;
        }
    }

    private function notifyOrder($order)
    {
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
}
