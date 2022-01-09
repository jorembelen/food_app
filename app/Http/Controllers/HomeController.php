<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    //
    }

    public function orderConfirm($id)
    {
        $order = Order::whereorder_number($id)->first();

        return view('orders.confirmation', compact('order'));
    }

    public function orderDetails($id)
    {
        $order = Order::whereorder_number($id)->first();

        return view('orders.details', compact('order'));
    }



}
