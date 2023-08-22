<x-app-layout>
    <div class="container flex flex-col items-center justify-center mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold mb-4">Checkout</h1>

        @php
            $total = 0;
            //check if cart is empty
            if(session('cart')) {
                foreach(session('cart') as $id => $details) {
                    $total += $details['price'] * $details['quantity'];
                }
            }else{
                //redirect to cart if cart is empty
                return redirect()->route('cart');
            }
        @endphp


        @if ($errors->any())
            <div class="mb-4">
                <div class="text-red-600">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif


        <form class="max-w-xs w-full flex flex-col justify-center gap-1" action="{{ route('orders.store') }}" method="POST">
            @csrf

            <!-- Total -->
            <div class="mb-4">
                <label for="total" class="block font-medium">Total</label>
                <input type="number" class="form-input mt-1 block w-full" id="total" name="total" value="{{ $total }}" readonly>
            </div>

            <!-- Payment Method -->
            <div class="mb-4">
                <label for="payment_method" class="block font-medium">Payment Method</label>
                <select class="form-select mt-1 block w-full" id="payment_method" name="payment_method" required>
                    <option disabled selected>Select Payment Method</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="mpesa">Mpesa</option>
                    <option value="cash">Cash</option>
                </select>
            </div>

            <!-- Shipping Method -->
            <div class="mb-4">
                <label for="shipping_method" class="block font-medium">Shipping Method</label>
                <select class="form-select mt-1 block w-full" id="shipping_method" name="shipping_method" required>
                    <option disabled selected>Select Shipping Method</option>
                    <option value="standard">Standard</option>
                    <option value="express">Express</option>
                </select>
            </div>

            <!-- Location (Optional) -->
            <div class="mb-4">
                <label for="location" class="block font-medium">Location</label>
                <input type="text" class="form-input mt-1 block w-full" id="location" name="location">
            </div>

            <!-- Shipping Address -->
            <div class="mb-4">
                <label for="shipping_address" class="block font-medium">Shipping Address</label>
                <textarea class="form-input mt-1 block w-full" id="shipping_address" name="shipping_address" rows="3" required></textarea>
            </div>

            <!-- Delivery Date (Optional)
            <div class="mb-4">
                <label for="delivery_date" class="block font-medium">Delivery Date</label>
                <input type="datetime-local" class="form-input mt-1 block w-full" id="delivery_date" name="delivery_date">
            </div>
            -->

            <!-- Items (JSON) -->
            <input type="hidden" id="items" name="items" value="{{ json_encode(session('cart')) }}">

            <!-- Submit Button -->
            <div data-tip="Continue to Pay" class="mb-4 w-full flex tooltip justify-center items-center">
                <x-round-button type="submit" class="btn btn-primary">
                    <i class="fas fa-shopping-cart"></i>
                </x-round-button>
            </div>

        </form>

        <!-- Scrollable Table with Cart Items -->
        <div class="mb-4 mt-4">

            <table class="table-auto w-full">
                <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total = 0;
                @endphp
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                        @php
                            $total += $details['price'] * $details['quantity'];
                        @endphp
                        <tr>
                            <td class="border px-4 py-2">{{ $details['name'] }}</td>
                            <td class="border px-4 py-2">{{ $details['price'] }}</td>
                            <td class="border px-4 py-2">{{ $details['quantity'] }}</td>
                            <td class="border px-4 py-2">{{ $details['price'] * $details['quantity'] }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
