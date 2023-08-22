<div class="card w-full rounded bg-base-100 shadow-sm">
    <a href="{{ route('products.show', $prod->id) }}">
        <figure class="h-44 bg-cover relative img-container">
            <img class="base-img" src="{{ asset('images/' . (isset($prod->images[0]) ? $prod->images[0]->image_path : $prod->images[1]->image_path)) }}" alt="Shoes" />
            <img class="hover-img" src="{{ asset('images/' . (isset($prod->images[1]) ? $prod->images[1]->image_path : $prod->images[0]->image_path)) }}" alt="Shoes Hover" />

            <section class="absolute z-20 top-[7%] right-[60%]">
                <!-- Discount badge -->
                <div class="badge overflow-clip whitespace-nowrap text-ellipsis text-[10px] sm:text-xs badge-warning">
                    {{ (int) $prod->discount_percentage ?? 0 }}% OFF
                </div>
            </section>
        </figure>

    </a>
    <div class="card-body flex flex-col gap-3 sm:p-6 p-3">

        <section class="flex gap-2 items-center">

            <h1 class="whitespace-nowrap overflow-clip font-semibold w-9/12 text-ellipsis">
                {{ $prod->name }}
            </h1>

            <!-- use carbon to check if product is new -->
            @if ($prod->created_at->diffInDays(Carbon\Carbon::now()) < 1)
                <span class="badge badge-secondary text-xs">NEW</span>
            @endif
        </section>

        <div class="card-actions flex items-center justify-between text-sm">

            <!-- discount -->
            <section class="flex gap-2">

                <div class="text-gray-500 text-opacity-40 line-through">
                    <!-- calculate discount -->
                    @if ($prod->discount_percentage)
                        {{ (int) $prod->price + ((int) $prod->price * ((int) $prod->discount_percentage / 100)) }}
                    @endif
                </div>

                <div class="">
                    {{ (int) $prod->price }}
                </div>

                <div class="">
                    {{ env('CURRENCY') }}
                </div>

            </section>

            <section>
                <div wire:key="add-to-cart-{{ $prod->id }}">
                    @livewire('add-to-cart', ['product' => $product], key($product->id))
                </div>
            </section>

        </div>

        <div class="badge overflow-clip whitespace-nowrap text-[10px] text-ellipsis badge-outline">
            {{ $prod->category->name }}
        </div>

    </div>

</div>
