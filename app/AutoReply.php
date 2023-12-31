<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoReply extends Model
{
    protected $fillable = [
        'name', 'post_id', 'shop_id', 'status'
    ];

    public function auto_reply_products()
    {
        return $this->belongsToMany(Product::class, AutoReplyProduct::class, 'ar_id', 'pid');
    }

    public function shop()
    {
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }
}
