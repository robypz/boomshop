<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Category;
use App\Models\product;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $categories = Category::all();

        if ($request->filled('category')) {
            $products = Product::where('category_id', $request->category)->paginate(24);
        } elseif ($request->filled('name')) {
            $products = Product::where('name', 'like', '%' . $request->name . '%')->paginate(24);
        } else {
            $products = Product::orderBy('name', 'asc')->paginate(24);
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
        // Validate the request...

        $image_path = $request->file('image');
        $gif_path = $request->file('gif');

        $product = new Product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = null;
        $product->need_region_id = $request->need_region_id;
        $product->need_access = $request->need_access;
        $product->gif = null;
        $product->category_id = $request->category;

        $product->customizable_field = $request->customizable_field;


        $image_path_name = time() . $image_path->getClientOriginalName();
        Storage::disk('images')->put($image_path_name, File::get($image_path));
        $product->image = $image_path_name;

        $gif_path_name = time() . $gif_path->getClientOriginalName();
        Storage::disk('images')->put($gif_path_name, File::get($gif_path));
        $product->gif = $gif_path_name;

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

        return view('product.edit', compact('product'));
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

        $product->available = $request->available;
        $product->customizable_field = $request->customizable_field;

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
