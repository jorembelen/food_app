<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function confirmOrder(Order $order)
    {
        $order->update(['status' => 'order confirm']);
        Alert::success('Success', 'Order was successfully confirmed.');

        return redirect()->back();
    }

    public function deliveredOrder(Order $order)
    {
        $order->update(['status' => 'delivered']);
        Alert::success('Success', 'Order was successfully delivered.');

        return redirect()->back();
    }

}
