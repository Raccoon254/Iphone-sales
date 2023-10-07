<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
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
    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('USD');
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if(isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('paypal.success')->with('success', 'Payment successful.');
        }else {
            return redirect()->route('paypal.cancel')->with('error', 'Something went wrong. Please try again later.');
        }
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function cancel(Request $request)
    {
        return redirect()->route('checkout')->with('error', 'Payment cancelled.');
    }

}
