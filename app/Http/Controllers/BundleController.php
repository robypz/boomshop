<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Product;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (isset($_GET['product_id']) && $_GET['product_id'] != '') {
            $bundles = Bundle::where('product_id', '=', $_GET['product_id'])->paginate(12);
        } else {
            $bundles = Bundle::paginate(12);
        }

        $products = Product::all('id', 'name');

        return view('bundle.index', ['bundles' => $bundles, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('bundle.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bundle = new Bundle();

        $bundle->product_id = $request->product_id;
        $bundle->content = $request->content;
        $bundle->availability = $request->availability;
        $bundle->price = $request->price;
        $bundle->discount = $request->discount / 100;

        $bundle->save();

        //$request->session()->flash('message', 'Carga exitosa');

        return redirect()->back();
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
        $bundle = Bundle::find($id);

        return view('bundle.edit', ['bundle' => $bundle]);
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
        $bundle = bundle::find($request->id);

        $bundle->content = $request->content;
        $bundle->availability = $request->availability;
        $bundle->price = $request->price;
        $bundle->discount = $request->discount;

        $bundle->save();

        return redirect(route('bundle.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        $bundle = Bundle::find($id);

        try {
            $bundle->delete();
            return redirect(route('bundle.index'));
        } catch (\Throwable $th) {
            return redirect(route('bundle.index'))->with('danger', 'No se pueda eliminar este producto');
        }
    }*/
}
