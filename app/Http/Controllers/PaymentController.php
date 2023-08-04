<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\product;
use App\Models\PaymentMethod;
use DateTime;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $actual = new DateTime();
        $cierre = new DateTime('22:00');
        if ($actual >= $cierre) {
            return redirect(route('close'));
        } else {
            $bundle = Bundle::find($request->bundle_id);
            $paymentMethod = PaymentMethod::findOrFail($request->payment_method_id);

            /*if($request->payment_method_id==null){
                redirect(route('product.show',['id' => $bundle->product->id]));
            }*/

            if($bundle->product->need_region_id){
                $account_id = $request->account_id;
                $region_id = $request->region_id;
                return view('payment.create', ['bundle' => $bundle, 'paymentMethod' => $paymentMethod, 'account_id' => $account_id,'region_id' => $region_id]);
            }elseif($bundle->product->need_access){
                return view('payment.create', ['bundle' => $bundle, 'paymentMethod' => $paymentMethod, 'user_id' => $request->user()->id]);
            }
            else{
                $account_id = $request->account_id;
                return view('payment.create', ['bundle' => $bundle, 'paymentMethod' => $paymentMethod, 'account_id' => $account_id]);
            }
        }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
