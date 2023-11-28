<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Valuation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('paymentMethod.index', ['paymentMethods' => $paymentMethods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $valuations = Valuation::all('id', 'name');

        return view('paymentMethod.create', ['valuations' => $valuations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paymentMethod = new PaymentMethod;
        $image = new ImageController;

        $paymentMethod->image = $image->store($request->file('image'));

        $paymentMethod->method = $request->method;
        $paymentMethod->available = $request->available;
        $paymentMethod->valuation_id = $request->valuation_id;

        $paymentMethod->save();

        return redirect(route('paymentMethod.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $valuations = Valuation::all();

        return view('paymentMethod.edit', ['paymentMethod' => $paymentMethod, 'valuations' => $valuations]);
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
        $paymentMethod = PaymentMethod::find($request->id);
        $image = new ImageController;

        if (!empty($request->file('image'))) {
            $paymentMethod->image = $image->update($paymentMethod->image,$request->file('image'));
        }


        $paymentMethod->method = $request->method;
        $paymentMethod->available = $request->available;
        $paymentMethod->valuation_id = $request->valuation_id;

        $paymentMethod->save();

        return redirect(route('paymentMethod.index'));
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

    public function getImage($filename)
    {
        $file= Storage::disk('images')->get($filename);

        return Response($file,200);
    }
}
