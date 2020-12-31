<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreDriver extends Model
{
    //
    use SoftDeletes;
    protected $casts = ['store_id' => 'integer','merchant_id' => 'integer','driver_id' => 'integer'];

}
