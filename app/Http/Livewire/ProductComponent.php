<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;


class ProductComponent extends Component
{
    use WithPagination;

    public $view = 'create';

    public $product_id, $name, $description, $quantity, $price;

    public function render()
    {
        $products = Product::orderByDesc('id')->paginate(10);

        return view('livewire.product-component', compact('products'));
    }

    public function save(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        Product::create([
            'name'        => $this->name,
            'description' => $this->description,
            'quantity'    => $this->quantity,
            'price'       => $this->price
        ]);

        $this->reset();
    }

    public function destroy(Product $product){
        $product->delete();
    }
}
