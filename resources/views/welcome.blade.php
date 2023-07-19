<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        <script src="https://kit.fontawesome.com/af6aba113a.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles & scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
    <nav class="sticky sm:fixed sm:top-0 w-full z-10">
        @include('layouts.nav')
    </nav>

        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center dark:bg-dots-lighter mt-8 selection:bg-red-500 selection:text-white">

            <div class="max-w-7xl flex flex-col mx-auto p-6 lg:p-8">


                <div class="pictures w-full overflow-clip flex flex-col md:flex-row gap-2">

                        <figure class="w-full h-full relative rounded md:w-2/3">
                            <img  src="https://airjordanofficial.us.com/wp-content/uploads/2023/06/left_banner-1.jpg" class="rounded lazyloaded h-full" alt="" decoding="async" sizes="(max-width: 887px) 100vw, 887px" srcset="https://airjordanofficial.us.com/wp-content/uploads/2023/06/left_banner-1.jpg 887w, https://airjordanofficial.us.com/wp-content/uploads/2023/06/left_banner-1-300x198.jpg 300w, https://airjordanofficial.us.com/wp-content/uploads/2023/06/left_banner-1-768x506.jpg 768w, https://airjordanofficial.us.com/wp-content/uploads/2023/06/left_banner-1-150x99.jpg 150w, https://airjordanofficial.us.com/wp-content/uploads/2023/06/left_banner-1-450x296.jpg 450w" data-ll-status="loaded">
                            <section class="absolute top-[65%] m-4 right-[75%]">
                                <h2 class="text-2xl bg-blend-hard-light font-bold m-2 text-white hover:text-gray-900">
                                    Air Jordan 4
                                </h2>
                                <a class="btn bg-gray-800 text-white hover:bg-opacity-5 m-2 rounded btn-outline">
                                    SHOP NOW
                                </a>
                            </section>
                        </figure>

                    <div class="w-full flex flex-col gap-2 md:w-1/3">

                        <figure class="rounded relative">
                            <img  src="https://airjordanofficial.us.com/wp-content/uploads/2023/06/Off-White-x-Air-Jordan-0.jpg" class="rounded lazyloaded" alt="" decoding="async" sizes="(max-width: 680px) 100vw, 680px" srcset="https://airjordanofficial.us.com/wp-content/uploads/2023/06/Off-White-x-Air-Jordan-0.jpg 680w, https://airjordanofficial.us.com/wp-content/uploads/2023/06/Off-White-x-Air-Jordan-0-300x200.jpg 300w, https://airjordanofficial.us.com/wp-content/uploads/2023/06/Off-White-x-Air-Jordan-0-150x100.jpg 150w, https://airjordanofficial.us.com/wp-content/uploads/2023/06/Off-White-x-Air-Jordan-0-450x300.jpg 450w" data-ll-status="loaded">

                            <section class="absolute top-[50%] right-[50%]">
                                <h2 class="text-2xl font-bold text-white hover:text-gray-100">
                                    Air Jordan 1
                                </h2>
                                <a class="btn bg-white hover:bg-opacity-5 rounded btn-outline">
                                    SHOP NOW
                                </a>
                            </section>

                        </figure>

                        <figure class="rounded relative">
                            <img  src="https://airjordanofficial.us.com/wp-content/uploads/2023/06/admin-ajax-1.jpg" class="rounded" alt="" decoding="async" sizes="(max-width: 400px) 100vw, 400px" srcset="https://airjordanofficial.us.com/wp-content/uploads/2023/06/admin-ajax-1.jpg 400w, https://airjordanofficial.us.com/wp-content/uploads/2023/06/admin-ajax-1-300x193.jpg 300w, https://airjordanofficial.us.com/wp-content/uploads/2023/06/admin-ajax-1-150x96.jpg 150w" />


                            <section class="absolute top-[50%] right-[50%]">
                                <h2 class="text-2xl font-bold text-white hover:text-gray-100">
                                    New Release
                                </h2>
                                <a class="btn bg-white hover:bg-opacity-5 rounded btn-outline">
                                    SHOP NOW
                                </a>
                            </section>

                        </figure>
                    </div>


                </div>

            </div>

        </div>


    <section>
        <div class="products">
            @php
               //10 mock products
                $products = collect(range(1, 10))->map(function ($i) {
                    return (object) [
                        'id' => $i,
                        'name' => 'Product ' . $i,
                        'price' => rand(1000, 10000),
                        'image' => 'https://picsum.photos/seed/' . $i . '/300/300',
                    ];
                });
            @endphp
            <div class="container p-2 sm:p-8">
                <div class="products grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach ($products as $product)
                        @include('prod.prod')
                    @endforeach
                </div>
            </div>

            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam architecto asperiores aut corporis dolore eligendi est fuga harum inventore, minus, necessitatibus nisi officiis omnis praesentium quia quod repellat ut?
        </div>
    </section>

    </body>
</html>
