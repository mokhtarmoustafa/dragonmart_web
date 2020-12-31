<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProviderCategory extends Model
{
    //
    use SoftDeletes;

//    protected $appends = [];

    protected $casts = ['product_id' => 'integer','category_id' => 'integer'];
}
