<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public function propertyName()
    {
        return $this->belongsToMany(VariantProperty::class, ProductVariantName::class, 'pvid', 'vpid');
    }
}
