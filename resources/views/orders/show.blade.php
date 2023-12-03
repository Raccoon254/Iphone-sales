<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <div>
            @if($order->payment->status == 'pending')
                <div role="alert" class="alert rounded my-2 alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>
                        This order is pending payment verification.
                    </span>
                </div>
            @endif

        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 border-b flex justify-between border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Order Details
                </h3>
                <h3 class="text-lg leading-6 font-medium flex gap-4 items-center justify-center text-gray-900">
                    <i class="fa-solid fa-file-lines"></i>{{ $order->order_number }}
                </h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Order ID
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $order->id }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Shipping Address
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $order->shipping_address }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Total
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $order->grand_total }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Payment Method
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $order->payment_method }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Shipping Method
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $order->shipping_method }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Status
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $order->status }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Created At
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $order->created_at }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Items Ordered
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @foreach ($order->items as $item)
                                <section class="mb-2">
                                    {{ $item['name'] }} x {{ $item['quantity'] }}
                                </section>
                            @endforeach
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
