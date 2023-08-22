<div>
    @if(session('cart')[$product->id] ?? false)
        @if($isAddingToCart)
            <button class="btn btn-sm btn-circle">
                <i class="fa-solid fa-spinner fa-spin"></i>
            </button>
        @else
            <section data-tip="Remove from cart" class="indicator tooltip tooltip-bottom">
                <button wire:click="removeFromCart" class="btn btn-sm ring ring-red-600 btn-circle btn-danger">
                    <i class="fa-solid fa-trash-can"wire:loading.class="hidden"></i>
                    <i class="fa-solid fa-circle-notch fa-spin" wire:loading></i>
                </button>
            </section>
        @endif
    @else
        <section data-tip="Add to cart" class="indicator tooltip tooltip-bottom">
            <button wire:click="addToCart" class="btn btn-sm btn-circle ring">
                <i class="fa-solid fa-cart-plus" wire:loading.class="hidden"></i>
                <i class="fa-solid fa-circle-notch fa-spin" wire:loading></i>
            </button>
        </section>
    @endif
</div>
