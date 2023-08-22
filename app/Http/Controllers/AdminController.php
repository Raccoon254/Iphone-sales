<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderStatusUpdatedNotification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.index');
    }

    public function users(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        //get all users
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function show(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.show-user', compact('user'));
    }

    public function orders(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        //get all orders
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    //show an order
    public function showOrder(Order $order): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.orders.show', compact('order'));
    }

    //updateOrder status
    public function updateOrderStatus(Order $order, Request $request): \Illuminate\Http\RedirectResponse
    {
        //validate the request
        $request->validate([
            'status' => 'required|in:pending,processing,completed,decline,cancel',
        ]);

        //update the order status
        $order->update([
            'status' => $request->input('status'),
        ]);

        //send notification to the user
        $user = $order->user;
        $user->notify(new OrderStatusUpdatedNotification($order));

        //redirect the user back and show flash message
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

}
