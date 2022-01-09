<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeContent extends Component
{
    public $show = false;
    public $hideOrder = true;
    public $name;
    public $mobile;
    public $address;
    public $notes;
    public $amount = 6;
    public $query = '';

    protected $rules = [
        'name' => 'required',
        'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:11',
        'address' => 'required',
        'notes' => 'nullable|min:6',
    ];

    public function increaseQty($rowId)
    {
        $cart = Cart::whereuser_id(auth()->id())->whereproduct_id($rowId)->first();
        $product = Product::find($rowId);
        $qty = $cart->quantity + 1;
        $subTotal = $cart->price * $qty;
        if($product->quantity < $qty){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => $product->name .' has only ' .$product->quantity .' available stock.', 'error',
                'text' => '',
                ]);
        }else{
            $cart->update([
                'quantity' => $qty,
                'sub_total' => $subTotal,
            ]);
            $this->emit('refreshCart');
        }
    }

    public function decreaseQty($rowId)
    {
        $cart = Cart::whereuser_id(auth()->id())->whereproduct_id($rowId)->first();
        $qty = $cart->quantity - 1;
        $subTotal = $cart->price * $qty;
        if($qty < 1){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Minimum quantity should not less than 1', 'error',
                'text' => '',
                ]);

        }else{
                $cart->update([
                    'quantity' => $qty,
                    'sub_total' => $subTotal,
                ]);
                $this->emit('refreshCart');
        }
    }

    public function destroy($rowId)
    {
        $cart = Cart::whereuser_id(auth()->id())->whereproduct_id($rowId)->first();
        $cart->delete();
    }

    public function openDiv()
    {
        $cartItems = Cart::whereuser_id(auth()->id())->get();
        // dd($cartItems);
        if($cartItems->count() > 0) {
            // dd('Success');
            $this->show = true;
            $this->hideOrder = false;
        }else{
            // dd('Failed');
            $this->dispatchBrowserEvent('swal:modal', [
                'type'  => 'error',
                'title' => 'Your cart is empty!',
                'text'  => '',
            ]);
        }
    }

    public function back()
    {
        $this->show = false;
        $this->hideOrder = true;
    }



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

                }
        }
    }


    public function order()
    {
        $this->validate();

        $order = new Order();
        $cartItems = Cart::whereuser_id(auth()->id())->get();
        $user = User::find(auth()->id());
        DB::beginTransaction();
        if($order) {

            $order->order_number = uniqid();

            $order->user_id = $user->id;
            $order->shipping_fullname = $this->name;
            $order->shipping_address = $this->address;
            $order->shipping_phone = $this->mobile;
            $order->notes = $this->notes;
            $order->item_count = $cartItems->sum('quantity');
            $order->sub_total = $cartItems->sum('sub_total');
            $order->grand_total = $cartItems->sum('sub_total') + 30;
            foreach($cartItems as $item) {
                $qty = $item->quantity;
                $prodId = $item->product_id;
                $product = Product::find($prodId);
                if($product->quantity < $qty){
                    $this->dispatchBrowserEvent('swal:modal', [
                        'type' => 'error',
                        'title' => $product->name .' has only ' .$product->quantity .' available stock.', 'error',
                        'text' => '',
                        ]);
                        return redirect()->back();
                }else{
                    $product->deductProdQty($qty);
                }
              }
              if($user->address != $this->address) {
                  $user->update(['address'=> $this->address]);
              }
            $order->save();
            $order->deleteCart($product->shop_id);

            // For Cart Items
            foreach($cartItems as $item) {
                $order->items()->attach($item->product_id, ['user_id'=> auth()->id(), 'price'=> $item->price, 'sub_total'=> $item->sub_total, 'quantity'=> $item->quantity]);
            }

        DB::commit();

        }else{
            DB::rollBack();
            return back();
        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type'  => 'success',
            'title' => 'Order was successfully submitted!',
            'text'  => '',
        ]);

        return redirect()->route('order.confirm', $order->order_number);
    }

    public function info($slug)
    {
        return redirect()->route('product.info', $slug);
    }

    public function mount()
    {
       if(auth()->check()){
        $this->name = auth()->user()->f_name .' '.auth()->user()->l_name;
        $this->mobile = auth()->user()->mobile_number;
        $this->address = auth()->user()->address;
       }
    }

    public function refresh()
    {
        $this->query = null;
    }

    public function render()
    {

        if(strlen($this->query) > 2) {
            $products = Product::search($this->query)
                ->latest()
                ->take($this->amount)
                ->get();

                $allProducts = Product::search($this->query)->pluck('id')->count();
            }else{
                $products = Product::latest()
                ->take($this->amount)
                ->get();
                $allProducts = Product::pluck('id')->count();
            }

        $carts = Cart::whereuser_id(auth()->id())->latest()->get();
        $cartTotal = $carts->sum('sub_total');

        return view('livewire.home-content', compact('products', 'carts', 'cartTotal', 'allProducts'))->extends('layouts.master');
    }

    public function load()
    {
        $this->amount += 6;
    }
}
