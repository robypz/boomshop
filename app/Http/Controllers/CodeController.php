<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Game;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;


class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $codes = Code::all();

        return view('code.index', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = date('Y-m-d');

        $products = Product::all(['id', 'name']);

        return view('code.create', compact('today', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /*var_dump($request->valid_for);
        die;*/

        $code = new Code;

        $code->code = $request->code;
        $code->value = $request->value;
        $code->valid_for = $request->valid_for;
        $code->expiration_date = $request->expiration_date;
        $code->save();

        return redirect(route('code.index'));
    }

    public function validateCode(Request $request)
    {
        $code = Code::where('code', $request->code)->first();
        if ($code) {
            if (in_array($request->product, $code->valid_for)) {
                if ($code->expiration_date >= now()->toDateString()) {
                    $used = Order::query()->select('orders.*')->where('orders.user_id', auth()->user()->id)->join('payments', 'payments.order_id', '=', 'orders.id')->whereJsonContains('data->code', $code->code)->first();
                    if (is_null($used)) {
                        return response()->json([
                            'code' => $code,
                            'status' => '200'
                        ]);
                    } else {
                        return response()->json([
                            'status' => '204',
                            'message' => 'Este código ya ha sido utilizado.'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => '204',
                        'message' => 'Este código ha expirado.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => '204',
                    'message' => 'Este código no es válido para este producto.'
                ]);
            }
        } else {
            return response()->json([
                'status' => '204',
                'message' => 'Este código no existe en nuestra base de datos.'
            ]);
        }
    }

    public function test()
    {
        $code = "PROMO23";

        $product = "Genshin Impact";

        $code = Code::where('code', $code)->first();
        if ($code) {
            if (in_array($product, $code->valid_for)) {
                if ($code->expiration_date >= now()->toDateString()) {
                    $used = Order::query()->select('orders.*')->where('orders.user_id', auth()->user()->id)->join('payments', 'payments.order_id', '=', 'orders.id')->whereJsonContains('data->code', $code->code)->first();
                    if (is_null($used)) {
                        return response()->json([
                            'code' => $code,
                            'status' => '200'
                        ]);
                    } else {
                        return response()->json([
                            'status' => '204',
                            'message' => 'Este código ya ha sido utilizado.'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => '204',
                        'message' => 'Este código ha expirado.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => '204',
                    'message' => 'Este código no es válido para este producto.'
                ]);
            }
        } else {
            return response()->json([
                'status' => '204',
                'message' => 'Este código no existe en nuestra base de datos.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $code = Code::find($id);
        $code->delete();
        return redirect(route('code.index'));
    }
}
