<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentCost extends Model
{
    //
    use SoftDeletes;
    protected $casts = ['min_order_amount' => 'double','price' => 'double','from' => 'double','to' => 'double','merchant_id' => 'integer'];

}
