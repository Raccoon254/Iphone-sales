<div class="navbar bg-base-100">
    <div class="navbar-start">


        <!-- Hamburger -->
        <div class="drawer-content">

            <label for="my-drawer" class="btn btn-circle btn-ghost drawer-button lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
            </label>

        </div>
        <!-- End Hamburger -->
    </div>
    <div class="navbar-center">
        <a class="normal-case text-xl font-semibold">
            @can('manage-products')
                Admin
            @endcan
            {{ config('app.name', 'RaccoonCreations') }}
            ™️</a>
    </div>
    <div class="navbar-end px-3 flex items-center gap-3">

        <!-- Cart -->

        <livewire:cart-indicator />


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
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
