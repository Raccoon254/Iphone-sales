<div class="navbar bg-base-100">
    <div class="navbar-start">
        @auth
            <section data-tip="SideBar" class="tooltip tooltip-bottom m-0 p-0 shrink-0 flex items-center">
                <label for="my-drawer" class="drawer-button swap swap-rotate">

                    <!-- this hidden checkbox controls the state -->
                    <input class="hidden" type="checkbox" />

                    <!-- hamburger icon -->
                    <svg class="swap-off fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>


                    <!-- close icon -->
                    <svg class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512"><polygon points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49"/></svg>

                </label>
            </section>
        @endauth
    </div>
    <div class="navbar-center">
        <a class="normal-case text-xl font-semibold">
            {{ config('app.name', 'RaccoonCreations') }}
            ™️</a>
    </div>
    <div class="navbar-end px-3 flex items-center gap-3">

        <!-- Cart -->

        <livewire:cart-indicator />
        @can('manage-products')
            <a href="{{ route('admin') }}" class="btn btn-sm ring ring-inset btn-ghost btn-circle">
            <span data-tip="Admin Dashboard" class="indicator tooltip tooltip-bottom">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </span>
            </a>
        @endcan

    @if (Route::has('login'))
            <div class="">
                @auth
                    <div class="">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <a href="#" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    <button class="btn btn-sm btn-ghost btn-circle">
                                        <span class="indicator">
                                            <i class="fa-regular text-2xl fa-circle-user"></i>
                                            <span class="badge badge-xs badge-primary indicator-item"></span>
                                        </span>
                                    </button>
                                    </a>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
