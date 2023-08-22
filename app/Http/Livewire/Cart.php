<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Cart extends Component
{
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.cart');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function increaseQuantity($productId): void
    {
        $cart = session()->get('cart');
        $product = Product::find($productId);

        if(isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            $cart[$productId]['price'] = $product->price * $cart[$productId]['quantity']; // Update the total price for this product
        }

        $this->emit('cartUpdated');

        session()->put('cart', $cart);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function decreaseQuantity($productId): void
    {
        $cart = session()->get('cart');
        $product = Product::find($productId);

        if(isset($cart[$productId])) {
            $cart[$productId]['quantity']--;
            if($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['price'] = $product->price * $cart[$productId]['quantity']; // Update the total price for this product
            }
        }

        $this->emit('cartUpdated');

        session()->put('cart', $cart);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeFromCart($productId): void
    {
        $cart = session()->get('cart');

        if(isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        $this->emit('cartUpdated');

        session()->put('cart', $cart);
    }

    public function clearCart(): void
    {

        $this->emit('cartUpdated');
        session()->forget('cart');
    }
}
