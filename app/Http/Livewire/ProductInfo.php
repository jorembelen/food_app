<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class ProductInfo extends Component
{
    public $slug;

    public function addToCart($product_id)
    {
        if(!auth()->user()) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type'  => 'error',
                'title' => 'Please Login to continue!',
                'text'  => '',
            ]);
            return redirect()->route('login');
        }else{
        $product = Product::find($product_id);
        $cart = Cart::whereproduct_id($product->id)->whereuser_id(auth()->id())->first();

            if($product->getProductQty() == 0) {
                $this->dispatchBrowserEvent('swal:modal', [
                    'type'  => 'error',
                    'title' => 'Failed!!',
                    'text'  => $product->name .' is out of stock!',
                ]);
            }else{
                if($product->sale_price) {
                    $price = $product->sale_price;
                }else{
                    $price = $product->regular_price;
                }
                    if($cart) {
                        $product->updateCart($price);
                    }else{
                        $product->addCart($price);
                    }

                    $this->dispatchBrowserEvent('swal:modal', [
                        'type'  => 'success',
                        'title' => $product->name .' was added to cart!',
                        'text'  => '',
                    ]);
                    return redirect()->route('home');
                }
        }
    }

    public function info($slug)
    {
        return redirect()->route('product.info', $slug);
    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $product = Product::whereslug($this->slug)->first();
        $products = Product::take(6)->inRandomOrder()->get();

        return view('livewire.product-info', compact('product', 'products'))->extends('layouts.master');
    }
}
