<x-app-layout>
    <div class="container flex flex-col items-center justify-center mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold mb-4">Payment Instructions</h1>

        @php
            $instructions = [
                'credit_card' => [
                    'step1' => ['text' => 'Go to our secure payment gateway.', 'icon' => 'fa-credit-card'],
                    'step2' => ['text' => 'Enter your credit card details and complete the transaction.', 'icon' => 'fa-lock'],
                ],
                'paypal' => [
                    'step1' => ['text' => 'Log in to your PayPal account.', 'icon' => 'fa-paypal'],
                    'step2' => ['text' => 'Send the payment to our PayPal email: example@email.com.', 'icon' => 'fa-envelope'],
                ],
                'mpesa' => [
                    'step1' => ['text' => 'Go to M-Pesa on your phone.', 'icon' => 'fa-mobile'],
                    'step2' => ['text' => 'Select Lipa na M-Pesa, then Pay Bill.', 'icon' => 'fa-money-bill-wave'],
                    'step3' => ['text' => 'Enter the Business Number provided, and the Account Number as your Order ID.', 'icon' => 'fa-info-circle'],
                    'step4' => ['text' => 'Enter the amount and complete the transaction.', 'icon' => 'fa-check-circle'],
                ],
                'binance' => [
                    'step1' => ['text' => 'Log in to your Binance account.', 'icon' => 'fa-bitcoin'],
                    'step2' => ['text' => 'Navigate to Wallet, then Spot Wallet.', 'icon' => 'fa-wallet'],
                    'step3' => ['text' => 'Send the specified amount to our Binance address.', 'icon' => 'fa-address-card'],
                ],
                'bank_transfer' => [
                    'step1' => ['text' => 'Log in to your online banking portal.', 'icon' => 'fa-university'],
                    'step2' => ['text' => 'Set up a new payee using our bank details provided.', 'icon' => 'fa-building'],
                    'step3' => ['text' => 'Transfer the amount to the new payee.', 'icon' => 'fa-exchange-alt'],
                ],
            ];
        @endphp

        <div class="payment-instructions">
            <h2 class="text-lg">Order ID: {{ $payment->order_id }}</h2>
            <h3 class="text-lg">Amount: {{ $payment->amount }} {{ $payment->currency }}</h3>
            <h4 class="text-lg mb-4">Payment Method: {{ ucfirst($payment->order->payment_method) }}</h4>

            @if(isset($instructions[$payment->order->payment_method]))
                <div class="steps flex flex-col gap-2">
                    @foreach($instructions[$payment->order->payment_method] as $step)
                        <div class="flex items-center mb-2">
                            <i class="fas {{ $step['icon'] }} mr-2"></i>
                            <p>{{ $step['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No instructions available for this payment method.</p>
            @endif

            <!--Form to submit payment proof-->
            <form class="max-w-xs w-full flex flex-col justify-center gap-1"
                  action="{{ route('payments.update', $payment->id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Payment Proof -->
                <div class="mb-4">
                    <label for="proof" class="block font-medium">Payment Proof</label>
                    <input type="file" class="form-input mt-1 block w-full" id="proof" name="proof" required>
                </div>

                <!-- Order ID -->
                <input type="hidden" name="order_id" value="{{ $payment->order_id }}">

                <button type="submit" class="btn btn-primary">Submit Payment Proof</button>
            </form>
        </div>
    </div>
</x-app-layout>
