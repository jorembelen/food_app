<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;
    public $name, $description, $regular_price, $sale_price, $is_featured, $quantity, $image;


    public function submit()
    {
        $dataValid = $this->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'regular_price' => 'required|integer',
            'sale_price' => 'sometimes|integer',
            'is_featured' => 'required',
            'quantity' => 'required|integer',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        $product = new Product();

        DB::beginTransaction();

        if($product) {
            // Save product on Product Traits
            $product->addProduct($dataValid);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type'  => 'success',
                'title' => 'Product was successfully added.',
                'text'  => '',
            ]);
            return redirect()->route('products.index');
        }else{
            DB::rollBack();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Please check your data and try again!',
                'text' => '',
                ]);
                return redirect()->back();
        }
    }


    public function render()
    {
        return view('livewire.products.create-product')->extends('admin.master');
    }
}
