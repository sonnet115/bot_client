<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestedPage extends Model
{
    protected $fillable = [
        'page_id', 'user_id'
    ];
}
