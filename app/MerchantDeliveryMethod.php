<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantDeliveryMethod extends Model
{
    //
    use SoftDeletes;

    protected $casts = ['merchant_id' => 'integer', 'driver_type_id' => 'integer'];

    protected $appends = ['driver_type'];
    public function DriverType()
    {
        return $this->belongsTo(DriverType::class, 'driver_type_id');
    }

    public function getDriverTypeAttribute()
    {
        return $this->DriverType()->first();
    }

}
