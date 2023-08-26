<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AddToCart extends Component
{
    public Product $product;
    public bool $isAddingToCart = false;
    /**
     * @var mixed|string
     */
    public mixed $extraClass;

    public function mount(Product $product, $extraClass = ''): void
    {
        $this->product = $product;
        $this->extraClass = $extraClass;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addToCart(): void
    {
        // Get the current cart data from the session
        $this->isAddingToCart = true;
        $cart = session()->get('cart', []);
        // Check if this product is already in the cart
        if(isset($cart[$this->product->id])) {
            $cart[$this->product->id]['quantity']++;
        } else {
            // Add the product to the cart
            $cart[$this->product->id] = [
                'name' => $this->product->name,
                'quantity' => 1,
                'price' => $this->product->price,
                'image' => $this->product->images[0]->image_path,
            ];
        }

        // Update the cart data in the session
        session()->put('cart', $cart);

        $this->emitUp('productAddedToCart');
        $this->isAddingToCart = false;
        $this->emit('cartUpdated');
    }

    public function removeFromCart(): void
    {
        $this->isAddingToCart = true;
        $cart = session('cart', []);
        if(isset($cart[$this->product->id])) {
            unset($cart[$this->product->id]);
            session(['cart' => $cart]);
            $this->emit('cartUpdated');
        }

        $this->isAddingToCart = false;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.add-to-cart');
    }
}
