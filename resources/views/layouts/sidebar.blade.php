<div class="drawer">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">

    </div>
    <div class="z-40 drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>

        <div class="menu p-4 pt-[100px] w-64 h-full bg-base-200 text-base-content gap-4 flex flex-col justify-start items-start">
            <!-- App Logo -->
            <div class="flex items-center w-full justify-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Sidebar content here -->
            <!-- if user is logged in -->
            @auth
                <a class="side" href="{{ route('home') }}" >
                    <i class="fa-solid fa-shopping-cart"></i>
                    <div class="">
                        Shop
                    </div>
                </a>

                <a class="side" href="{{ route('orders.all') }}" >
                    <i class="fa-solid fa-shopping-bag"></i>
                    <div class="">
                        Orders
                    </div>
                </a>

                <a class="side" href="{{ route('home') }}" >
                    <i class="fa-solid fa-circle-nodes"></i>
                    <div class="">
                        Connect
                    </div>
                </a>

                <a class="side" href="{{ route('profile.edit') }}" >
                    <i class="fa-regular fa-circle-user"></i>
                    <div class="">
                        Account
                    </div>
                </a>
                @else
            login
            @endauth

        </div>
    </div>
</div>
