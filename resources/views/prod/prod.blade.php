<div class="card w-full rounded bg-base-100 shadow-sm">
    <a href="{{ route('products.show', $product->id) }}">
    <figure class="h-44 bg-cover relative img-container">
        <img class="base-img" src="{{ asset('images/' . (isset($product->images[0]) ? $product->images[0]->image_path : $product->images[1]->image_path)) }}" alt="Shoes" />
        <img class="hover-img" src="{{ asset('images/' . (isset($product->images[1]) ? $product->images[1]->image_path : $product->images[0]->image_path)) }}" alt="Shoes Hover" />

        <section class="absolute z-20 top-[7%] right-[60%]">
            <!-- Discount badge -->
                <div class="badge overflow-clip whitespace-nowrap text-ellipsis text-[10px] sm:text-xs badge-warning">
                    {{ (int) $product->discount_percentage ?? 0 }}% OFF
                </div>
        </section>
    </figure>
        </a>
    <div class="card-body flex flex-col gap-3 sm:p-6 p-3">

        <section class="flex gap-2 items-center">

            <h1 class="whitespace-nowrap overflow-clip font-semibold w-9/12 text-ellipsis">
                {{ $product->name }}
            </h1>

            <!-- use carbon to check if product is new -->
            @if ($product->created_at->diffInDays(Carbon\Carbon::now()) < 1)
                <span class="badge badge-secondary text-xs">NEW</span>
            @endif
        </section>

        <div class="card-actions flex items-center justify-between text-sm">

            <!-- discount -->
            <section class="flex gap-2">
                <div class="text-gray-500 text-opacity-40 line-through">
                    <!-- calculate discount -->
                    @if ($product->discount_percentage)
                        {{ (int) $product->price + ((int) $product->price * ((int) $product->discount_percentage / 100)) }}
                    @endif
                </div>

                <div class="">
                    {{ (int) $product->price }}
                </div>

                <div class="">
                    {{ env('CURRENCY') }}
                </div>
            </section>

            <section class="flex">
                <div wire:key="add-to-cart-{{ $product->id }}">
                    @livewire('add-to-cart', ['product' => $product], key($product->id))
                </div>
            </section>

        </div>

        <div class="badge overflow-clip whitespace-nowrap text-[10px] text-ellipsis badge-outline">
            {{ $product->category->name }}
        </div>

    </div>
</div>
