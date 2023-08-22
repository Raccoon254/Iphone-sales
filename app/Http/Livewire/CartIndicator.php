<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartIndicator extends Component
{
    protected $listeners = ['cartUpdated' => 'render'];

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.cart-indicator');
    }
}
