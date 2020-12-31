<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartProductCustom extends Model
{
    //
    use SoftDeletes;

    protected $casts = ['price' => 'double', 'cart_product_id' => 'integer', 'custom_id' => 'integer'];


}
