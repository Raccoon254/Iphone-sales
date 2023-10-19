@if(Auth::check())
    <x-app-layout>
        <!-- Page Content -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- Product Images -->
                <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-2 lg:-mx-2 xl:-mx-2">
                    @foreach($product->images as $image)
                        <div class="my-2 px-2 w-full overflow-hidden
                {{ count($product->images) > 1 ? 'sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2' : 'sm:w-full md:w-full lg:w-full xl:w-full' }}">
                            <img src="{{ asset('images/' . $image->image_path) }}" alt="{{ $product->name }}" class="w-full h-auto rounded">
                        </div>
                    @endforeach
                </div>

                <!-- Product Details -->
                <div>
                    <h2 class="text-2xl font-semibold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-600 mb-6">{{ $product->description }}</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="p-4 bg-white rounded shadow">
                            <div class="container grid grid-cols-2">
                                <div class="left flex items-center justify-center w-full h-full">
                                    <i class="fas fa-coins text-5xl mb-2"></i>
                                </div>
                                <div class="right">
                                    <h4 class="text-2xl text-orange-800 font-semibold">Price</h4>
                                    <p class="text-3xl">{{ $product->price }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-white rounded shadow">
                            <div class="container grid grid-cols-2">
                                <div class="left flex items-center justify-center w-full h-full">
                                    <i class="fas fa-lightbulb text-5xl mb-2"></i>
                                </div>
                                <div class="right">
                                    <h4 class="text-2xl text-orange-800 font-semibold">Brand</h4>
                                    <p class="text-3xl">{{ $product->brand }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white flex flex-col gap-4 justify-between">
                            <div class="container rounded h-1/2 shadow grid grid-cols-2">
                                <div class="left flex items-center justify-center w-full h-full">
                                    <i class="fas fa-palette text-5xl mb-2"></i>
                                </div>
                                <div class="right">
                                    <h4 class="text-2xl text-orange-800 font-semibold">Main Color</h4>
                                    <p class="text-3xl">{{ $product->color }}</p>
                                </div>
                            </div>

                            <div class="container rounded  h-1/2 shadow grid grid-cols-2">
                                <div class="left flex items-center justify-center w-full h-full">
                                    <i class="fas fa-percent text-5xl mb-2"></i>
                                </div>
                                <div class="right">
                                    <h4 class="text-2xl text-orange-800 font-semibold">Discount</h4>
                                    <p class="text-3xl">{{ $product->discount_percentage }}%</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 bg-white rounded shadow">
                            <center class="text-2xl font-semibold mb-4">Specs</center>
                            <!-- {"ram":"4GB","rom":"32GB","screen_size":"5.5 inches","processor":"Snapdragon 865","camera":"12MP","battery_capacity":"5000 mAh","operating_system":"One UI 3.0","connectivity":"Bluetooth 5.2","colors":["Red","White"]} -->
                            @php
                                $product->specs = json_decode($product->specs, true);
                            @endphp
                            <ul class="grid grid-cols-3 place-items-start">
                                @php
                                    $iconClasses = "w-6 text-gray-700 group-hover:text-gray-500";
                                @endphp

                                @foreach([
                                    'processor' => ['icon' => 'fa-microchip', 'label' => 'Processor', 'suffix' => ' GHz'],
                                    'ram' => ['icon' => 'fa-memory', 'label' => 'RAM', 'suffix' => ' GB'],
                                    'rom' => ['icon' => 'fa-hdd', 'label' => 'ROM', 'suffix' => ' GB'],
                                    'screen_size' => ['icon' => 'fa-mobile', 'label' => 'Screen Size', 'suffix' => ' cm'],
                                    'camera' => ['icon' => 'fa-camera', 'label' => 'Camera', 'suffix' => ' MP'],
                                    'battery_capacity' => ['icon' => 'fa-battery-full', 'label' => 'Battery Capacity', 'suffix' => ' mAh'],
                                    'operating_system' => ['icon' => 'fa-cogs', 'label' => 'Operating System'],
                                    'connectivity' => ['icon' => 'fa-wifi', 'label' => 'Connectivity'],

                                ] as $key => $data)
                                    <li class="group p-1 tooltip flex justify-center items-center space-x-2" data-tip="{{ $data['label'] }}">
                                        <i class="{{ $iconClasses }} fas {{ $data['icon'] }}"></i>
                                        <span class="text-xs">{{ $product->specs[$key] }}{{ $data['suffix'] ?? '' }}</span>
                                    </li>
                                @endforeach

                                <li data-tip="Colors" class="group p-1 tooltip flex justify-center items-center space-x-2">
                                    <i class="{{ $iconClasses }} fas fa-palette"></i>
                                    <div class="flex space-x-1">
                                        @foreach($product->specs['colors'] as $color)
                                            <span class="color-badge h-4 w-4 rounded-full" style="background-color: {{ $color }}"></span>
                                        @endforeach
                                    </div>
                                </li>
                            </ul>

                            <style>
                                .color-badge:hover {
                                    box-shadow: 0 0 5px rgba(0,0,0,0.3);
                                }
                            </style>

                        </div>

                        <div class="p-4 bg-white rounded shadow">
                            <div class="container grid grid-cols-2">
                                <div class="left flex items-center justify-center w-full h-full">
                                    <i class="fas fa-archive text-5xl mb-2"></i>
                                </div>
                                <div class="right">
                                    <h4 class="text-2xl text-orange-800 font-semibold">Stock</h4>
                                    <p class="text-3xl">{{ $product->stock }}</p>
                                </div>
                            </div>
                        </div>

                    </div>


                    @auth
                        @if(Auth::user()->isAdmin())
                            <!--if the user is an admin, show the edit and delete buttons-->
                            <div class="flex items-center justify-center gap-4 my-4">
                                <a href="{{ route('products.edit', $product) }}">
                                    <x-round-button class="btn-sm" type="submit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </x-round-button>
                                </a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-round-button type="submit" class="text-white btn-sm bg-red-500">
                                        <i class="fas fa-trash"></i>
                                    </x-round-button>
                                </form>
                            </div>
                        @endif
                    @endauth

                    <div class="flex justify-center items-center" wire:key="add-to-cart-{{ $product->id }}">
                        @livewire('add-to-cart', ['product' => $product, 'extraClass' => 'btn-primary rounded-full btn-outline btn-warning w-[300px] sm:w-[400px] md:w-[500px] h-[50px] text-2xl'], key($product->id))
                    </div>

                </div>

            </div>

            <div class="container p-2 sm:p-8">

                <section>
                    <h2 class="text-2xl font-semibold mb-2 mt-6">Related Products</h2>
                </section>

                <div class="products grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach ($relatedProducts as $prod)
                        @include('prod.relatedProd')
                    @endforeach
                </div>
            </div>

        </div>
    </x-app-layout>
@else
    <!DOCTYPE html>
    <html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ShoeShop') }}</title>
        <!--description-->
        <meta name="description" content="{{ $product->description }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- icons -->
        <script src="https://kit.fontawesome.com/af6aba113a.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @livewireScripts
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen w-full overflow-clip">
        @include('layouts.nav')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- Product Images -->
                <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-2 lg:-mx-2 xl:-mx-2">
                    @foreach($product->images as $image)
                        <div class="my-2 px-2 w-full overflow-hidden
                        {{ count($product->images) > 1 ? 'sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2' : 'sm:w-full md:w-full lg:w-full xl:w-full' }}">
                            <img src="{{ asset('images/' . $image->image_path) }}" alt="{{ $product->name }}" class="w-full h-auto rounded">
                        </div>
                    @endforeach
                </div>

                <!-- Product Details -->
                <div>
                    <h2 class="text-2xl font-semibold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-600 mb-6">{{ $product->description }}</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="p-4 bg-white rounded shadow">
                            <div class="container grid grid-cols-2">
                                <div class="left flex items-center justify-center w-full h-full">
                                    <i class="fas fa-coins text-5xl mb-2"></i>
                                </div>
                                <div class="right">
                                    <h4 class="text-2xl text-orange-800 font-semibold">Price</h4>
                                    <p class="text-3xl">{{ $product->price }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-white rounded shadow">
                            <div class="container grid grid-cols-2">
                                <div class="left flex items-center justify-center w-full h-full">
                                    <i class="fas fa-lightbulb text-5xl mb-2"></i>
                                </div>
                                <div class="right">
                                    <h4 class="text-2xl text-orange-800 font-semibold">Brand</h4>
                                    <p class="text-3xl">{{ $product->brand }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white flex flex-col gap-4 justify-between">
                            <div class="container rounded h-1/2 shadow grid grid-cols-2">
                                <div class="left flex items-center justify-center w-full h-full">
                                    <i class="fas fa-palette text-5xl mb-2"></i>
                                </div>
                                <div class="right">
                                    <h4 class="text-2xl text-orange-800 font-semibold">Main Color</h4>
                                    <p class="text-3xl">{{ $product->color }}</p>
                                </div>
                            </div>

                            <div class="container rounded  h-1/2 shadow grid grid-cols-2">
                                <div class="left flex items-center justify-center w-full h-full">
                                    <i class="fas fa-percent text-5xl mb-2"></i>
                                </div>
                                <div class="right">
                                    <h4 class="text-2xl text-orange-800 font-semibold">Discount</h4>
                                    <p class="text-3xl">{{ $product->discount_percentage }}%</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 bg-white rounded shadow">
                            <center class="text-2xl font-semibold mb-4">Specs</center>
                            <!-- {"ram":"4GB","rom":"32GB","screen_size":"5.5 inches","processor":"Snapdragon 865","camera":"12MP","battery_capacity":"5000 mAh","operating_system":"One UI 3.0","connectivity":"Bluetooth 5.2","colors":["Red","White"]} -->
                            @php
                                $product->specs = json_decode($product->specs, true);
                            @endphp
                            <ul class="grid grid-cols-3 place-items-start">
                                @php
                                    $iconClasses = "w-6 text-gray-700 group-hover:text-gray-500";
                                @endphp

                                @foreach([
                                    'processor' => ['icon' => 'fa-microchip', 'label' => 'Processor', 'suffix' => ' GHz'],
                                    'ram' => ['icon' => 'fa-memory', 'label' => 'RAM', 'suffix' => ' GB'],
                                    'rom' => ['icon' => 'fa-hdd', 'label' => 'ROM', 'suffix' => ' GB'],
                                    'screen_size' => ['icon' => 'fa-mobile', 'label' => 'Screen Size', 'suffix' => ' cm'],
                                    'camera' => ['icon' => 'fa-camera', 'label' => 'Camera', 'suffix' => ' MP'],
                                    'battery_capacity' => ['icon' => 'fa-battery-full', 'label' => 'Battery Capacity', 'suffix' => ' mAh'],
                                    'operating_system' => ['icon' => 'fa-cogs', 'label' => 'Operating System'],
                                    'connectivity' => ['icon' => 'fa-wifi', 'label' => 'Connectivity'],

                                ] as $key => $data)
                                    <li class="group p-1 tooltip flex justify-center items-center space-x-2" data-tip="{{ $data['label'] }}">
                                        <i class="{{ $iconClasses }} fas {{ $data['icon'] }}"></i>
                                        <span class="text-xs">{{ $product->specs[$key] }}{{ $data['suffix'] ?? '' }}</span>
                                    </li>
                                @endforeach

                                <li data-tip="Colors" class="group p-1 tooltip flex justify-center items-center space-x-2">
                                    <i class="{{ $iconClasses }} fas fa-palette"></i>
                                    <div class="flex space-x-1">
                                        @foreach($product->specs['colors'] as $color)
                                            <span class="color-badge h-4 w-4 rounded-full" style="background-color: {{ $color }}"></span>
                                        @endforeach
                                    </div>
                                </li>
                            </ul>

                            <style>
                                .color-badge:hover {
                                    box-shadow: 0 0 5px rgba(0,0,0,0.3);
                                }
                            </style>

                        </div>

                        <div class="p-4 bg-white rounded shadow">
                            <div class="container grid grid-cols-2">
                                <div class="left flex items-center justify-center w-full h-full">
                                    <i class="fas fa-archive text-5xl mb-2"></i>
                                </div>
                                <div class="right">
                                    <h4 class="text-2xl text-orange-800 font-semibold">Stock</h4>
                                    <p class="text-3xl">{{ $product->stock }}</p>
                                </div>
                            </div>
                        </div>

                    </div>


                    @auth
                        @if(Auth::user()->isAdmin())
                            <!--if the user is an admin, show the edit and delete buttons-->
                            <div class="flex items-center justify-center gap-4 my-4">
                                <a href="{{ route('products.edit', $product) }}">
                                    <x-round-button class="btn-sm" type="submit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </x-round-button>
                                </a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-round-button type="submit" class="text-white btn-sm bg-red-500">
                                        <i class="fas fa-trash"></i>
                                    </x-round-button>
                                </form>
                            </div>
                        @endif
                    @endauth

                    <div class="flex justify-center items-center" wire:key="add-to-cart-{{ $product->id }}">
                        @livewire('add-to-cart', ['product' => $product, 'extraClass' => 'btn-primary rounded-full btn-outline btn-warning w-[300px] sm:w-[400px] md:w-[500px] h-[50px] text-2xl'], key($product->id))
                    </div>

                </div>
            </div>

            <div class="container p-2 sm:p-8">
                <section>
                    <h2 class="text-2xl font-semibold mb-2 mt-6">Related Products</h2>
                </section>
                <div class="products grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach ($relatedProducts as $prod)
                        @include('prod.relatedProd')
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    </body>
    </html>


@endif
