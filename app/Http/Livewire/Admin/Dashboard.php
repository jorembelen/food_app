<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalProducts = Product::pluck('id')->count();
        $totalOrders = Order::pluck('id')->count();
        $totalSales = Order::wherestatus('delivered')->sum('sub_total');


        $sales = [];
        // Circle trough all 12 months
        for ($month = 1; $month <= 12; $month++) {
            // Create a Carbon object from the current year and the current month (equals 2022-01-01 00:00:00)
            $date = Carbon::create(date('Y'), $month);

            // Make a copy of the start date and move to the end of the month (e.g. 2022-01-31 23:59:59)
            $date_end = $date->copy()->endOfMonth();

            $orders = Order::where('created_at', '>=', $date)
                ->where('created_at', '<=', $date_end)
                ->wherestatus('delivered')
               ->sum('sub_total');

            // Save the count of transactions for the current month in the output array
            $sales[$month] = $orders;
        }

        return view('livewire.admin.dashboard', compact('totalProducts', 'totalOrders', 'totalSales', 'sales', 'date'))->extends('admin.master');
    }
}
