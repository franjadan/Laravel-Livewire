<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;


class ProductComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::orderByDesc('id')->paginate(10);

        return view('livewire.product-component', compact('products'));
    }

    public function destroy(Product $product){
        $product->delete();
    }
}
