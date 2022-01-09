<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderComponent extends Component
{
    protected $listeners = ['cancelOrder', 'proceedOrder'];

    public function confirm($orderId)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Are you sure?',
            'text' => 'Are you sure to cancel this order?',
            'id' => $orderId
            ]);
    }

    public function reorder($orderId)
    {
        $this->dispatchBrowserEvent('swal:reorder', [
            'type' => 'warning',
            'message' => 'Are you sure?',
            'text' => 'Are you sure to proceed this order?',
            'id' => $orderId
            ]);
    }

    public function cancelOrder($orderId)
    {
        $order = Order::find($orderId);
        $ordertItems = OrderItem::whereorder_id($orderId)->get();
        DB::beginTransaction();
        if($order->status == 'order placed'){
              // process the product inventory
              foreach($ordertItems as $item) {
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
                    $product->addProdQty($qty);
                }
            }
            // update the order status
            $order->update(['status' => 'cancelled']);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Order was successfully cancelled',
                'text' => '',
                ]);
        }else{
                DB::rollBack();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'This order cannot be cancelled!',
                'text' => '',
                ]);
            return redirect()->back();
        }
    }

    public function proceedOrder($orderId)
    {
        $order = Order::find($orderId);
        $ordertItems = OrderItem::whereorder_id($orderId)->get();

        DB::beginTransaction();
        if($order->status == 'cancelled'){
            // process the product inventory
            foreach($ordertItems as $item) {
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
            // update the order status
            $order->update(['status' => 'order placed']);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Order was successfully placed',
                'text' => '',
                ]);
        }else{
            DB::rollBack();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'This order cannot be process!',
                'text' => '',
                ]);
            return redirect()->back();
        }
    }

    public function mount()
    {
        $orders = Order::whereuser_id(auth()->id())->pluck('id')->count();
        if($orders == 0) {
            session()->flash('message', 'Sorry, your order list is empty!');
            return redirect('/');
        }
    }

    public function render()
    {
        $orders = Order::whereuser_id(auth()->id())->latest()->paginate(10);

        return view('livewire.order-component', compact('orders'))->extends('layouts.master');
    }
}
