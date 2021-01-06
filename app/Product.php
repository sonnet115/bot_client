<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'stock', 'uom', 'price', 'category_id', 'variant_combination_ids', 'parent_product_id'];

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
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function orderedProducts()
    {
        return $this->hasMany(OrderedProducts::class, 'pid', 'id');
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class, ProductVariant::class, 'product_id', 'variant_id')
            ->with('variantPropertiesName');
    }

    public function childProducts()
    {
        return $this->hasMany(self::class, 'parent_product_id', 'id');
    }
}
