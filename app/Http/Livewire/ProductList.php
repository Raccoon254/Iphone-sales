<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';

    // Adding this method
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.product-list', [
            'products' => Product::with(['category', 'sizes', 'images'])
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('price', 'like', '%' . $this->search . '%')
                ->orWhere('stock', 'like', '%' . $this->search . '%')
                ->orWhere('color', 'like', '%' . $this->search . '%')
                ->orWhere('specs', 'like', '%' . $this->search . '%')
                ->orWhere('discount_percentage', 'like', '%' . $this->search . '%')
                ->orWhereHas('category', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('product_sizes', function ($query) {
                    $query->where('size', 'like', '%' . $this->search . '%');
                })
                ->paginate(10),
        ]);
    }
}
