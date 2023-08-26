<div class="drawer sticky h-full lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle lg:hidden" />
    <div class="drawer-side z-40 lg:block">
        <label for="my-drawer" class="drawer-overlay lg:hidden"></label>
        <section class="menu p-4 flex flex-col z-50 gap-4 mt-16 sm:mt-0 w-56 h-full bg-base-200 text-base-content lg:block">
            <a href="{{route('admin')}}" class="sidebar-item ">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <header class="text-[15px] py-[10px] px-[16px] mx-[16px]">
                PAGES
            </header>

            <!-- Sidebar content here -->
            <a href="{{route('products.index')}}" class="sidebar-item ">
                <i class="fa-solid fa-tag"></i>
                Products
            </a>

            <a class="sidebar-item" href="{{ route('admin-orders') }}">
                <i class="fa-solid fa-bag-shopping"></i>
                Orders
            </a>
            <a href="{{ route('banners.index') }}" class="sidebar-item">
                <i class="fa-solid fa-image"></i>
                Banners
            </a>
            <a class="sidebar-item" href="{{ route('users') }}">
                <i class="fa-solid fa-user-gear"></i>
                Users
            </a>
            <a href="{{ route('categories.index') }}" class="sidebar-item">
                <i class="fa-solid fa-chart-simple"></i>
                Categories
            </a>

            <a class="sidebar-item" href="{{ route('notifications.index') }}">
                <i class="fa-solid fa-bell"></i>
                Notifications
            </a>

        </section>

    </div>
</div>
