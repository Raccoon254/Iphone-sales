<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreatedAdminNotification;
use App\Notifications\OrderCreatedUserNotification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    //checkout
    public function checkout(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('orders.checkout');
    }

    //store
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the form data
        $request->validate([
            'shipping_address' => 'required',
            'total' => 'required',
            'payment_method' => 'required',
            'shipping_method' => 'required',
            'items' => 'required|json',
        ]);

        // Check if the user has a pending order that matches the current cart
        $pendingOrder = Order::where('user_id', auth()->user()->id)
            ->where('status', 'pending')
            ->where('items', $request->input('items'))
            ->first();


        if ($pendingOrder) {
            return redirect()->back()->with('error', 'You already have a pending order with the same items in your cart.');
        }

        // Create a new order
        /** @var Order $order */
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'order_number' => $this->generate_order_number(),
            'status' => 'pending',
            'order_date' => now(),
            'payment_method' => $request->input('payment_method'),
            'payment_status' => 'pending',
            'grand_total' => $request->input('total'),
            'shipping_address' => $request->input('shipping_address'),
            'shipping_method' => $request->input('shipping_method'),
            'shipping_cost' => '0',
            'location' => json_decode($request->input('location')),
            'shipping_status' => 'pending',
            'delivery_date' => null,
            'items' => json_decode($request->input('items'), true),
        ]);
        $order->createPayment();

        // Notify the user
        $user = auth()->user();
        //$total = $request->input('total');

        $total = 0;
        foreach (session('cart') as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        // Notify admins
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new OrderCreatedAdminNotification($order, session('cart'), $total));


        $user->notify(new OrderCreatedUserNotification($order, session('cart'), $total));

        // Ensure the order total and cart total match
        if ($order->grand_total != $total) {
            return redirect()->back()->with('error', 'There was a mismatch with the total amount. Please try again.');
        }

        //Handle payment ie redirect to payment gateway or view and show payment address and guidelines

        // Clear the cart session data
        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    //show

    private function generate_order_number(): string
    {
        $order_number = Str::upper(Str::random(4) . time());
        $order = Order::where('order_number', $order_number)->first();
        if ($order) {
            return $this->generate_order_number();
        }
        return $order_number;
    }

    public function show(Order $order): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('orders.show', compact('order'));
    }

    public function all(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $orders = Order::where('user_id', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('orders.all', compact('orders'));
    }

}
