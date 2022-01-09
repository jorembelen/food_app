<?php

namespace App\Traits;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Intervention\Image\Facades\Image;

trait ProductTraits
{

    public function deductProdQty($qty)
    {
        $product = Product::find($this->id);
        if(isset($product)) {
            $product->update(array(
                'quantity' => $product->quantity - $qty,
                ));
        }
        if($product->quantity == 0) {
            $product->update(array(
                'stock_status' => 'outofstock',
                ));
        }else{
            $product->update(array(
                'stock_status' => 'instock',
                ));
        }
    }

    public function addProdQty($qty)
    {
        $product = Product::find($this->id);
        if(isset($product)) {
            $product->update(array(
                'quantity' => $product->quantity + $qty,
                ));
        }
    }

    public function getProductQty()
    {
        $product = Product::find($this->id);
        if(isset($product)) {
          return  $product->quantity;
        }else{
            return 0;
        }
    }

    public function productImage()
    {
        $product = Product::whereslug($this->slug)->first();
        if(isset($product)) {
            return  asset('uploads/images/' .$product->image);
        }
    }

    public function updateCart($price)
    {
        $cart = Cart::whereuser_id(auth()->id())->whereproduct_id($this->id)->first();
        if(isset($cart)) {
            $qty = $cart->quantity + 1;
            $cart->update(array(
                'price' => $price,
                'quantity' => $cart->quantity + 1,
                'sub_total' => $price * $qty,
                ));
        }
    }

    public function removeCart()
    {
        $cart = Cart::whereuser_id(auth()->id())->whereproduct_id($this->id)->first();
        if(isset($cart)) {
            $cart->delete();
        }
    }

    public function addCart($price)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $this->id,
            'price' => $price,
            'sub_total' => $price,
        ]);
    }


    public function cartTotal()
    {
        $cart = Cart::whereuser_id(auth()->id())->get();
        if(isset($cart)) {
           return $cart->sum('sub_Total');
        }
    }

    public function deleteCart($id)
    {
        $carts = Cart::whereuser_id(auth()->id())->get();
        if(isset($carts)) {
            foreach($carts as $cart) {
                $cart->delete();
            }
        }
    }

    public function formatRegularPrice()
    {
        $product = Product::find($this->id);
        if(isset($product)) {
            return '₱'.number_format($product->regular_price, 2);
        }
    }

    public function formatSalePrice()
    {
        $product = Product::find($this->id);
        if(isset($product)) {
            return '₱'.number_format($product->sale_price, 2);
        }
    }

    public function formatCartPrice()
    {
        $cart = Cart::whereuser_id(auth()->id())->whereproduct_id($this->id)->first();
        if(isset($cart)) {
            return '₱'.number_format($cart->sub_total, 2);
        }
    }

    public function userAddress($address)
    {
        $user = User::find($this->id);
        if($user){
            $user->update(['address', $address]);
        }
        return null;
    }

    public function addProduct($data)
    {
        $product = new Product();

        $imgPath = public_path('/uploads/images/');
        if($data['image']){
            $image = $data['image'];
            $name = $image->hashName();

            // save and convert image size
            $ImageUpload = Image::make($image);
            $ImageUpload->resize(460, 310);
            $ImageUpload = $ImageUpload->save($imgPath .$name);
            $data['image'] = $name;
        }
        $product->create($data);
    }

    public function updateProduct($data)
    {
        $product = Product::find($this->id);
        $imgPath = public_path('/uploads/images/');
        if($data['image'] != $product->image){
            $image = $data['image'];
            $name = $image->hashName();

            if($product->image) {
                    $path1 = 'uploads/images/';
                    \File::delete($path1 .$product->image);
            }

                // for save original image
            $ImageUpload = Image::make($image);
            $ImageUpload->resize(460, 310);
            $ImageUpload = $ImageUpload->save($imgPath .$name);
            $data['image'] = $name;
        }
        $product->update($data);
    }

}
