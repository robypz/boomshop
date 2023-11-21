<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Bundle;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('user_id')) {
            $users = User::where('id', $request->user_id)->paginate(12);
        } else {
            $users = User::paginate(12);
        }

        return view('user.index', ['users' => $users]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', ['user' => $user]);
    }

    public function edit()
    {
        # code...
    }

    public function editRole($id)
    {
        $user = User::find($id);
        $roles = Role::all()->pluck('name');

        return view('user.editRole', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request)
    {
    }

    public function updateRole(Request $request)
    {
        $user = User::find($request->id);

        $user->syncRoles([$request->role]);

        $user->save();

        return redirect(route('user.index'));
    }

    public function orders()
    {

        $orders = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);

        return view('user.orders', ['orders' => $orders]);
    }

    public function giftCards()
    {

        $orders = Order::whereRelation('bundle', function (Builder $query) {
            $query->whereRelation('product', function (Builder $query) {
                $query->whereRelation('category', "category", "=", "Tarjetas");
            });
        })->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();

        return view('user.giftcards', ['orders' => $orders]);
    }

    public function ordersInProcess()
    {
        $orders = Order::where('asist_by', auth()->user()->id)->where('order_status_id', 3)->orderBy('id', 'desc')->get();

        return view('user.ordersInProcess', ['orders' => $orders]);
    }

    function profile()
    {
        $user = auth()->user();

        $pendingOrders = count(Order::whereRelation('orderStatus', "status", "=", "Pendiente")->where('user_id', auth()->user()->id)->get());

        $successOrders = count(Order::whereRelation('orderStatus', "status", "=", "Exitoso")->where('user_id', auth()->user()->id)->get());

        $favoriteBundles = Bundle::select('product_id', DB::raw('count(*) as total'))
            ->join('orders', 'bundles.id', '=', 'orders.bundle_id')
            ->where('orders.user_id', $user->id)
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->take(4)
            ->get();

        return view('user.profile', compact('user', 'pendingOrders', 'successOrders', 'favoriteBundles'));
    }

    function passwordChangeRequest()
    {
        return view('user.passwordChange');
    }

    function passwordChange(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::find($request->user()->id);

        $user->password = Hash::make($request->password);
        $user->update();
        return redirect(route('user.profile'))->with('password', 'changed');
    }

    public function editAvatar()
    {
        $avatars = Avatar::all();

        return view('user.edit-avatar', compact('avatars'));
    }

    public function setAvatar(Request $request)
    {
        $user = User::find($request->user()->id);

        $user->avatar_id = $request->avatar;

        $user->update();

        return redirect(route('user.profile'));
    }

    public static function favoriteProducts($id)
    {
        $favoriteBundles = Bundle::select('product_id', DB::raw('count(*) as total'))
            ->join('orders', 'bundles.id', '=', 'orders.bundle_id')
            ->where('orders.user_id', $id)
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->take(4)
            ->get();

        return $favoriteBundles;
    }
}
