<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProductCustom extends Model
{
    //
    use SoftDeletes;
    protected $casts = ['order_product_id' => 'integer','custom_id' => 'integer','price' => 'double'];

}
