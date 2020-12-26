<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'stock', 'uom', 'price', 'category_id'];

    public function discounts()
    {
        return $this->hasOne(Discount::class, 'pid', 'id')
            ->where('state', '=', 1)
            ->where('dis_from', '<=', date("Y-m-d"))
            ->where('dis_to', '>=', date("Y-m-d"));
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'pid', 'id');
    }

    public function shop()
    {
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function orderedProducts()
    {
        return $this->hasMany(OrderedProducts::class, 'pid', 'id');
    }
}
