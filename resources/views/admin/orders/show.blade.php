<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 border-b flex justify-between border-gray-200 sm:px-6">
                <div class="flex gap-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Order made by
                    </h3>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $order->user->name }}
                    </h3>
                </div>
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
                        <!-- Form to update order status -->
                        <form action="{{ route('order-update-status', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <dd class="mt-1 text-sm text-gray-900">
                                <label for="status"></label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="decline" {{ $order->status == 'decline' ? 'selected' : '' }}>Decline</option>
                                    <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                                </select>
                            </dd>
                            <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Status
                            </button>
                        </form>

                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            User Email
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $order->user->email }}
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
