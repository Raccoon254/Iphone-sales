<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PaypalController extends Controller
{
    /**
     * @throws Exception
     * @throws Throwable
     */
    public function payment(Request $request)
    {
        $amount = $request->price;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('USD');
        $provider->getAccessToken();

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'value' => $amount,
                        'currency_code' => 'USD'
                    ]
                ]
            ],
            'application_context' => [
                'cancel_url' => route('paypal.cancel'),
                'return_url' => route('paypal.success')
            ]
        ]);

        if(isset($response['id']) && $response['id'] != '' && $response['status'] == 'CREATED') {
            foreach($response['links'] as $link) {
                if($link['rel'] == 'approve') {
                    return redirect($link['href']);
                }
            }
        }else {
            return redirect()->route('checkout')->with('error', 'Something went wrong. Please try again later.');
        }
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function success(Request $request): View
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('USD');
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        //last order made by user
        $order = Order::where('user_id', auth()->user()->id)->latest()->first();
        $amount = $order->grand_total;

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // Create a payment record
            Payment::create([
                'user_id' => auth()->user()->id,
                'order_id' => $order->id, // Assuming you have the order info available.
                'transaction_id' => $response['id'],
                'amount' => $amount,
                'currency' => 'USD',
                'status' => 'completed',
                'payment_date' => now()
            ]);

            // Update order's payment status
            $order->update(['payment_status' => 'completed']);

            return view('payments.success')->with('success', 'Payment successful.');
        } else {
            return view('payments.cancel')->with('error', 'Payment failed.');
        }
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function cancel(Request $request): View
    {
        //$order is the latest order of the user
        $order = Order::where('user_id', auth()->user()->id)->latest()->first();

        // Create a failed payment record
        Payment::create([
            'user_id' => auth()->user()->id,
            'order_id' => $order->id,
            'status' => 'cancelled',
            'payment_date' => now()
        ]);

        // Update order's payment status
        $order->update(['payment_status' => 'cancelled']);

        return view('payments.cancel')->with('error', 'Payment cancelled.');
    }


}
