<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Product;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('available', '1')->where('category_id', '1')->paginate(12);
        $gifcards = Product::where('category_id', '2')->where('available', 1)->paginate(12);
        $notices = Notice::where('active', '1')->orderBy('position', 'asc')->get();

        if (auth()->user()) {
            $favoriteProducts = UserController::favoriteProducts(auth()->user()->id);
            return view('home', ['products' => $products, 'favoriteProducts' => $favoriteProducts, 'gifcards' => $gifcards, 'notices' => $notices]);
        } else {
            return view('home', ['products' => $products, 'gifcards' => $gifcards, 'notices' => $notices]);
        }
    }

    public function close()
    {
        $actual = new DateTime();
        $close_time = new DateTime('22:00');
        if ($actual >= $close_time) {
            return view('close', ['close_time' => $close_time->format('d-m-Y h:i')]);
        } else {
            return redirect(route('home'));
        }
    }
}
