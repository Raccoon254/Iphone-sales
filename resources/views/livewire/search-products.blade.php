<div class="container mx-auto w-full">
    <section class="Raccoon Search m-3 w-full flex justify-end">
        <div class="w-full sm:w-1/4 mx-4">
            <label class="relative">
                <input class="input input-bordered h-10 w-full max-w-xs" wire:model="search" type="text" placeholder="Search a product...">
                <span class="absolute top-[-10px] right-1 text-[10px] text-gray-500">Powered by Raccoon</span>
            </label>
        </div>
    </section>

    <div class="products grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
        @foreach ($products as $product)
            @include('prod.prod')
        @endforeach
    </div>
</div>
