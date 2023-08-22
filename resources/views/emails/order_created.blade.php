@component('mail::message')
    # Order Created

    Hello!

    Your order has been created successfully.

    ## Order Details

    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cart as $id => $details)
            <tr>
                <td>{{ $details['name'] }}</td>
                <td>{{ $details['quantity'] }}</td>
                <td>{{ $details['price'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    **Total: {{ $total }}**

    @component('mail::button', ['url' => route('orders.show', $order->id)])
        View Order
    @endcomponent

    Thank you for shopping with us!

    Regards,<br>
    {{ config('app.name') }}
@endcomponent
