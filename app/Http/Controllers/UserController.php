<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);

        return view('user.index', ['users' => $users]);
    }

    public function show()
    {
        # code...
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

        $orders = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();

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

        $successOrders = count(Order::whereRelation('orderStatus', "status", "=", "Pendiente")->where('user_id', auth()->user()->id)->get());

        return view('user.profile',compact('user','pendingOrders','successOrders'));
    }
}
