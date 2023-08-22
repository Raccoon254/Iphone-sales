<a href="{{ route('cart') }}" class="indicator">
    <span class="indicator-item badge badge-secondary">
        <!-- Get the total count of items in the cart -->
        {{ count(session('cart', [])) }}
    </span>
    <section class="btn btn-sm btn-circle">
        <i class="fa-solid fa-cart-shopping"></i>
    </section>
</a>
