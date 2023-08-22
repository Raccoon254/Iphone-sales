<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RemoveFromCart extends Component
{
    public $product;
    public $isRemovingFromCart = false;

    public function mount($product): void
    {
        $this->product = $product;
    }

    public function removeFromCart(): void
    {
        $this->isRemovingFromCart = true;
        $cart = session('cart', []);

        if(isset($cart[$this->product->id])) {
            unset($cart[$this->product->id]);
            session(['cart' => $cart]);
            $this->emit('cartUpdated');
        }

        $this->isRemovingFromCart = false;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.remove-from-cart');
    }
}

