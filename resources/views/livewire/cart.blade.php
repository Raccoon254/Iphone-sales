<div class="container flex flex-col h-[100vh] items-center justify-center">

    <section class="my-3 md:my-6">
        <h1 class="text-center text-2xl font-semibold">Cart Data</h1>
    </section>

    @if(session('cart'))
        <div class="px-3 mb-4 overflow-y-auto overflow-x-clip sm:px-6 w-full p-6">
            <table class="table table-zebra table-striped">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach(session('cart') as $id => $details)
                    <tr>
                        <td>{{ $details['name'] }}</td>

                        <td>
                            <section class="flex gap-2">

                                <button class="btn-xs btn btn-circle btn-ghost ring ring-red-200" wire:click="decreaseQuantity({{ $id }})">
                                    <i class="fa-solid fa-minus"></i>
                                </button>

                                <div class="btn btn-ghost btn-circle btn-xs ring ring-orange-200">
                                    {{ $details['quantity'] }}
                                </div>

                                <button class="btn-xs btn btn-circle ring ring-blue-200 btn-ghost" wire:click="increaseQuantity({{ $id }})">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </section>
                        </td>

                        <td>{{ $details['price'] }}</td>

                        <td>
                            <img src="{{ asset('images/' . $details['image']) }}" width="100" height="100" class="img-responsive rounded" alt="{{ $details['image'] }}"/>
                        </td>

                        <td>
                            <div  class="tooltip" data-tip="Remove {{ $details['name'] }}">
                                <x-round-button wire:click="removeFromCart({{ $id }})">
                                    <i class="fa-regular fa-trash-can"></i>
                                </x-round-button>
                            </div>
                        </td>
                        </tr>
                @endforeach
                </tbody>
            </table>

            @php
                $total = 0;
                foreach(session('cart') as $id => $details) {
                    $total += $details['price'] * $details['quantity'];
                }
            @endphp

            <section class="total my-4 w-full">
                <div class="flex justify-between">
                    <div class="flex gap-2">
                        <div class="text-xl font-semibold">Total:</div>
                        <div class="text-xl font-semibold">{{ $total }}</div>
                    </div>
                </div>
            </section>

            <section class="my-2 pb-3 flex justify-center">
                <div class="flex gap-2">
                    <div data-tip="Clear the cat" class="tooltip">
                        <x-round-button wire:click="clearCart()">
                            <i class="fa-solid fa-trash"></i>
                        </x-round-button>
                    </div>

                    <a class="tooltip" data-tip="Checkout Here" href="{{ route('checkout') }}">
                        <x-round-button>
                            <i class="fa-solid fa-shopping-cart"></i>
                        </x-round-button>
                    </a>
                </div>
            </section>

        </div>

    @else
        <section class="my-1 md:my-2 flex items-center flex-col gap-4 justify-center">
            <div class="text-center text-2xl">Your cart is empty.</div>
            <div class="tooltip" data-tip="Shop Here">

                <a href="{{ route('home') }}">
                    <x-round-button>
                        <i class="fa-solid fa-shopping-cart"></i>
                    </x-round-button>
                </a>
            </div>
        </section>

    @endif
</div>
