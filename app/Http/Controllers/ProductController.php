<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Category;
use App\Models\Product;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name', 'asc')->paginate(12);
        return view('product.index', compact('products'));
    }

    public function catalog(Request $request)
    {
        $categories = Category::paginate(18);

        if ($request->filled('category')) {
            $products = Product::where('category_id', $request->category)->where('available',1)->paginate(18);
        } elseif ($request->filled('name')) {
            $products = Product::where('name', 'like', '%' . $request->name . '%')->where('available',1)->paginate(18);
        } else {
            $products = Product::orderBy('name', 'asc')->where('available',1)->paginate(18);
        }



        return view('product.catalog', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('product.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = null;
        $product->need_region_id = $request->need_region_id;
        $product->need_access = $request->need_access;
        $product->gif = null;
        $product->category_id = $request->category;

        $product->customizable_field = $request->customizable_field;

        $product->image = $request->file('image')->store('images');

        $product->gif = $request->file('gif')->store('images');

        $product->save();

        return redirect(route('home'));
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);

        return Response($file, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = product::find($id);
        if ($product->available) {
            $bundles = Bundle::where('product_id', $id)->where('availability', 1)->get();
            $paymentMethods = PaymentMethod::where('available', 1)->get();
            return view('product.show', ['product' => $product, 'paymentMethods' => $paymentMethods, 'bundles' => $bundles]);
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = product::find($id);
        $categories = Category::all();

        return view('product.edit', compact('product','categories'));
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
        $product = product::find($id);
        $product->name = $request->name;
        $product->available = $request->available;
        $product->customizable_field = $request->customizable_field;
        $product->description = $request->description;
        $product->category_id  = $request->category;
        if (!empty($request->file('file'))) {
            Storage::delete($product->image);
            $product->image = $request->file->store('images');
        }


        $product->save();

        return redirect(route('product.index'));
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
