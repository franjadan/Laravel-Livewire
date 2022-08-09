<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;


class ProductComponent extends Component
{
    use WithPagination;

    public $view = null;

    public $error_text = null;

    public $success_text = null;

    public $product_id, $name, $description, $quantity, $price;

    public function render()
    {
        $products = Product::orderByDesc('id')->paginate(10);

        return view('livewire.product-component', compact('products'));
    }

    public function create(){
        $this->reset();
        $this->view = 'create';
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

        $this->success_text = "Se ha creado el producto";
    }

    public function edit(Product $product){

        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->view = 'edit';
    }

    public function update(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $product = Product::find($this->product_id);
        $product->update([
            'name'        => $this->name,
            'description' => $this->description,
            'quantity'    => $this->quantity,
            'price'       => $this->price
        ]);

        $this->reset();

        $this->success_text = "Se ha editado el producto";

    }

    public function destroy(Product $product){
        $product->delete();

        $this->reset();

        $this->success_text = "Se ha eliminado el producto";

    }

}
