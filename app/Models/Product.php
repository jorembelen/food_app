<?php

namespace App\Models;

use App\Traits\ProductTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, ProductTraits;

    protected $fillable=[
        'name',
        'slug',
        'description',
        'regular_price',
        'sale_price',
        'is_featured',
        'quantity',
        'image',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product){
            // produce a slug based on the activity title
            $slug = Str::slug($product->name);

            // check to see if any other slugs exist that are the same & count them
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

            // if other slugs exist that are the same, append the count to the slug
            $product->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::query()->where('id', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderItem::class);
    }

}
