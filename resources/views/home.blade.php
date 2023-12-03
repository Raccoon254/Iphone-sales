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
        @livewireStyles
    </head>
    <body class="antialiased">
    <nav class="fixed top-0 sm:top-0 w-full z-50">
        @include('layouts.nav')
    </nav>
    @section('sidebar')
        @include('layouts.sidebar')
    @show

        <div class="relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center dark:bg-dots-lighter mt-8 selection:bg-red-500 selection:text-white">
            {{--{{$mainBanner}}--}}
            {{--{{$trBanner}}--}}
            <div class="max-w-7xl overflow-clip sm:h-[500px] md:h-[600px] flex flex-col mx-auto p-2 lg:p-8">


                <div class="pictures w-full overflow-clip flex flex-col md:flex-row gap-2">

                        <figure class="w-full h-full relative rounded md:w-2/3">

                            <!-- display data in mainBanner -->

                            @if(isset($mainBanner->image_url))
                                <img src="{{ $mainBanner->image_url}}" class="rounded lazyloaded md:h-[580px] object-cover w-full" alt="" decoding="async" sizes="(max-width: 887px) 100vw, 887px" srcset="{{ $mainBanner->image_url }}" data-ll-status="loaded">
                                @else
                                <img src="{{ asset('images/left_banner-1.jpg') }}">
                            @endif


                            <section class="absolute sm:top-[65%] top-[50%] m-2 sm:m-4 right-[65%] sm:right-[75%] top-[50%]">
                                <h2 class="sm:text-2xl text-xs bg-blend-hard-light font-bold my-1 text-white hover:text-base-900">
                                    @if(isset($mainBanner->title))
                                        {{ $mainBanner->title }}
                                    @else
                                        Air Jordan 1
                                    @endif
                                </h2>
                                <a class="btn btn-sm sm:btn-md bg-gray-800 text-white hover:bg-opacity-5 my-1 rounded btn-outline text-xs px-1 sm:px-4 sm:text-sm">
                                    SHOP NOW
                                </a>

                            </section>
                        </figure>

                    <div class="w-full flex-col hidden sm:flex gap-2 md:w-1/3">

                        <figure class="rounded relative h-1/2 overflow-clip">

                            @if(isset($trBanner->image_url))
                                <img src="{{ $trBanner->image_url}}" class="rounded lazyloaded" alt="" decoding="async" sizes="(max-width: 680px) 100vw, 680px" srcset="{{ $trBanner->image_url }}" data-ll-status="loaded">
                            @else

                            <img  src="{{ asset('images/right_banner-1.jpg') }}" class="rounded" alt="" decoding="async" sizes="(max-width: 400px) 100vw, 400px" srcset="{{ asset('images/right_banner-1.jpg') }}" />

                            @endif

                            <section class="absolute top-[50%] right-[60%]">
                                <h2 class="text-2xl font-bold text-white hover:text-gray-100">
                                    @if(isset($trBanner->title))
                                        {{ $trBanner->title }}
                                    @else
                                        Air Jordan 1
                                    @endif
                                </h2>
                                <a class="btn bg-white hover:bg-opacity-5 rounded btn-outline">
                                    SHOP NOW
                                </a>
                            </section>

                        </figure>

                        <figure class="rounded relative h-1/2 overflow-clip">

                            @if(isset($brBanner->image_url))
                                <img src="{{ $brBanner->image_url}}" class="rounded lazyloaded" alt="" decoding="async" sizes="(max-width: 680px) 100vw, 680px" srcset="{{ $brBanner->image_url }}" data-ll-status="loaded">
                            @else

                            <img  src="{{ asset('images/right_banner-2.jpg') }}" class="rounded" alt="" decoding="async" sizes="(max-width: 400px) 100vw, 400px" srcset="{{ asset('images/right_banner-2.jpg') }}" />

                            @endif

                            <section class="absolute top-[50%] right-[60%]">
                                <h2 class="text-2xl font-bold text-white hover:text-gray-100">
                                    @if(isset($brBanner->title))
                                        {{ $brBanner->title }}
                                    @else
                                        New Releases
                                    @endif
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

            <div class="container w-full p-2 sm:p-8">
                    @livewire('search-products')
            </div>

        </div>
    </section>


    @livewireScripts
    <script src="//unpkg.com/alpinejs" defer></script>
    </body>
</html>
