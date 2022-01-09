<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;
    public $slug, $name, $description, $regular_price, $sale_price, $is_featured, $quantity, $image;

    public function update()
    {
        // dd($this->image);
        $product = Product::whereslug($this->slug)->first();
        $dataValid = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'regular_price' => 'required|integer',
            'sale_price' => 'sometimes|integer',
            'is_featured' => 'required',
            'quantity' => 'required|integer',
            'image' => $this->image == $product->image ? '' : 'image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);


        DB::beginTransaction();
        if($product) {
            $product->updateProduct($dataValid);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type'  => 'success',
                'title' => 'Product was successfully updated.',
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

    public function mount($slug)
    {
        $this->slug = $slug;
        $product = Product::whereslug($this->slug)->first();
        $this->name = $product->name;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->is_featured = $product->is_featured;
        $this->quantity = $product->quantity;
        $this->description = $product->description;
        $this->image = $product->image;
    }

    public function render()
    {
        return view('livewire.products.edit-product')->extends('admin.master');
    }
}
