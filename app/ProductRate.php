<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductRate extends Model
{
    //
    use SoftDeletes;
    protected $casts = ['product_id' => 'integer','user_id' => 'integer','rate' => 'double'];

}
