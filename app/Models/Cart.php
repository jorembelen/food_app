<?php

namespace App\Models;

use App\Traits\ProductTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, ProductTraits;

    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'quantity',
        'sub_total',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
