<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchProducts extends Component
{
    public $search = '';

    protected $listeners = ['addToCart' => 'setProduct'];
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.search-products', [
            'products' => Product::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->get(),
        ]);
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
