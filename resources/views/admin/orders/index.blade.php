<x-admin.index>
    <div class="flex">
        <section class="z-50">
            @include('admin.sidebar')
        </section>

        <section class="px-4 w-full">
            <center class="text-2xl font-semibold mb-4">
                All Orders</center>
            <div class="container mx-auto px-4 py-8">

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Order Number</th>
                            <th class="border border-gray-300 px-4 py-2">User</th>
                            <th class="border border-gray-300 px-4 py-2">Total</th>
                            <th class="border border-gray-300 px-4 py-2">Payment Method</th>
                            <th class="border border-gray-300 px-4 py-2">Shipping Method</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Updated At</th>
                            <th class="border border-gray-300 px-4 py-2">View</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->order_number }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->grand_total }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->payment_method }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->shipping_method }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->status }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->updated_at->diffForHumans() }}</td>
                                <td class="border border-gray-300 py-2">
                                    <a href="{{ route('admin-show-order', $order->id) }}" class="btn mx-[25%] btn-sm btn-circle hover:text-blue-700">
                                        <i class="fa-solid fa-mountain"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-admin.index>
