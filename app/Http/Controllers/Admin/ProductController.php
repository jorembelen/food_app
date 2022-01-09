<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsCreateRequest $request)
    {
        $product = new Product();

        DB::beginTransaction();

        if($product) {
            $product->addProduct($request);
            DB::commit();
            Alert::success('Success', 'Product added successfully.');
        }else{
            DB::rollBack();
            Alert::error('Failed', 'Please check your data and try again!');
            return back();
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        DB::beginTransaction();

        if($product) {
            $product->updateProduct($request);
            DB::commit();
            Alert::success('Success', $product->name .' was updated successfully.');
        }else{
            DB::rollBack();
            Alert::error('Failed', 'Please check your data and try again!');
            return back();
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->orders->count() > 0 || $product->carts->count() > 0) {
            Alert::error('Failed', 'This product cannot be deleted!');
            return back();
        }else{
            if($product->image) {
                $path1 = 'uploads/images/';
                \File::delete($path1 .$product->image);
        }
            $product->delete();
            Alert::success('Success', $product->name .' was deleted successfully.');
            return back();
        }
    }
}
