<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public $show = false;
    public $hideOrder = true;
    public $name;
    public $mobile;
    public $address;
    public $notes;

    public function increaseQty($rowId)
    {
        $cart = Cart::whereuser_id(auth()->id())->whereproduct_id($rowId)->first();
        $qty = $cart->quantity + 1;
        $subTotal = $cart->price * $qty;
        $cart->update([
            'quantity' => $qty,
            'sub_total' => $subTotal,
        ]);
        $this->emit('refreshCart');
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
            $this->show = true;
            $this->hideOrder = false;
        }else{
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

    public function mount()
    {
        $carts = Cart::whereuser_id(auth()->id())->latest()->get();
        if($carts->count() == 0) {
            session()->flash('message', 'Your cart is empty!');
            return redirect('/');
        }
        $this->name = auth()->user()->f_name .' '.auth()->user()->l_name;
        $this->mobile = auth()->user()->mobile;
    }

    public function render()
    {
        $carts = Cart::whereuser_id(auth()->id())->latest()->get();
        $cartTotal = $carts->sum('sub_total');

        return view('livewire.cart-component', compact('carts', 'cartTotal'))->extends('layouts.master');
    }
}
