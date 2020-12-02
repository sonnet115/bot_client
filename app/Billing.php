<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = "billing_infos";

    protected $fillable = [
        'page_id', 'prev_billing_date', 'next_billing_date', 'paid_amount', 'payable_amount'
    ];

    function shop()
    {
        return $this->belongsTo(Shop::class, 'page_id', 'id');
    }

}
