<?php

namespace App\Models;

use App\Traits\OrderTraits;
use App\Traits\ProductTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, ProductTraits, OrderTraits;

    protected $guard = [];

    protected $fillable = ['status', 'notes'];

    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')->withPivot('quantity', 'price', 'sub_total');
    }

    public function user()
    {
            return $this->belongsTo(User::class);
    }

}
