@if(Auth::check())
    <x-app-layout>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid lg:grid-cols-2 gap-6">
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

                    <table class="table border-solid border-2 border-gray-200 table-zebra w-full mb-6">
                        <tbody>
                        <tr>
                            <th scope="row"><i class="fas fa-dollar-sign"></i> Price</th>
                            <td>{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-palette"></i> Color</th>
                            <td>{{ $product->color }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-cube"></i> Specs</th>
                            <td>{{ $product->specs }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-industry"></i> Brand</th>
                            <td>{{ $product->brand }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-archive"></i> Stock</th>
                            <td>{{ $product->stock }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-percentage"></i> Discount Percentage</th>
                            <td>{{ $product->discount_percentage }}%</td>
                        </tr>
                        </tbody>
                    </table>

                    @auth
                        @if(Auth::user()->isAdmin())
                            <!--if the user is an admin, show the edit and delete buttons-->
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('products.edit', $product) }}">
                                    <x-round-button type="submit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </x-round-button>
                                </a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-round-button type="submit" class="text-white bg-red-500">
                                        <i class="fas fa-trash"></i>
                                    </x-round-button>
                                </form>
                            </div>
                        @endif
                    @endauth


                    <div wire:key="add-to-cart-{{ $product->id }}">
                        @livewire('add-to-cart', ['product' => $product], key($product->id))
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
            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Product Images -->
                <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-2 lg:-mx-2 xl:-mx-2">
                    @foreach($product->images as $index => $image)
                        <div class="my-2 px-2 w-full overflow-hidden sm:my-2 sm:px-2 sm:w-1/2 md:my-2 md:px-2 md:w-1/2 lg:my-2 lg:px-2 lg:w-1/2 xl:my-2 xl:px-2 xl:w-1/2 {{ $index !== 0 ? ' hidden sm:block' : '' }}">
                            <img src="{{ asset('images/' . $image->image_path) }}" alt="{{ $product->name }}" class="w-full h-auto rounded">
                        </div>
                    @endforeach
                </div>


                <!-- Product Details -->
                <div>
                    <h2 class="text-2xl font-semibold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-600 mb-6">{{ $product->description }}</p>

                    <table class="table border-solid border-2 border-gray-200 table-zebra w-full mb-6">
                        <tbody>
                        <tr>
                            <th scope="row"><i class="fas fa-dollar-sign"></i> Price</th>
                            <td>{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-palette"></i> Color</th>
                            <td>{{ $product->color }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-cube"></i> Specs</th>
                            <td>{{ $product->specs }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-industry"></i> Brand</th>
                            <td>{{ $product->brand }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-archive"></i> Stock</th>
                            <td>{{ $product->stock }}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fas fa-percentage"></i> Discount Percentage</th>
                            <td>{{ $product->discount_percentage }}%</td>
                        </tr>
                        </tbody>
                    </table>

                    <div data-tip="Add to Cart" class="tooltip w-full" wire:key="add-to-cart-{{ $product->id }}">
                        @livewire('add-to-cart', ['product' => $product, 'extraClass' => 'btn-md rounded-full px-6 btn-outline btn-warning w-full sm:w-1/2'], key($product->id))
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
    </div>
    </body>
    </html>


@endif
