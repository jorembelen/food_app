<?php

use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeContent;
use App\Http\Livewire\OrderComponent;
use App\Http\Livewire\ProductInfo;
use App\Http\Livewire\Products\CreateProduct;
use App\Http\Livewire\Products\EditProduct;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();;

Route::get('/', HomeContent::class)->name('home');
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/orders', OrderComponent::class)->name('orders');
Route::get('product-info/{slug}', ProductInfo::class)->name('product.info');
Route::get('order-confirm/{id}', [HomeController::class, 'orderConfirm'])->name('order.confirm');
Route::get('order-details/{id}', [HomeController::class, 'orderDetails'])->name('order.details');




Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('create-product', CreateProduct::class)->name('create.product');
    Route::get('edit-product/{slug}', EditProduct::class)->name('edit.product');
    Route::resource('products', ProductController::class);
    Route::get('admin-orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('admin-order-confirm/{order}', [OrdersController::class, 'confirmOrder'])->name('admin-order.confirm');
    Route::get('admin-order-delivered/{order}', [OrdersController::class, 'deliveredOrder'])->name('admin-order.delivered');
    Route::get('admin-dashboard', Dashboard::class)->name('admin.dashboard');

});
