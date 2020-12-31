<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['car_type'];
    protected $casts = [
        'driver_id' => 'integer','car_type_id' => 'integer'
    ];

    public function CarType()
    {
        return $this->belongsTo(CarType::class, 'car_type_id');
    }

    public function getCarTypeAttribute()
    {

        return $this->CarType()->first();
    }

    public function getPhotoAttribute($value)
    {
        if (isset($value))
            return url('storage/app/vehicles/' . $this->driver_id) . '/' . $value;
        return null;
    }

    public function getLicenseDrivingAttribute($value)
    {
        if (isset($value))
            return url('storage/app/vehicles/' . $this->driver_id) . '/' . $value;
        return null;
    }

    public function getDocumentAttribute($value)
    {
        if (isset($value))
            return url('storage/app/vehicles/' . $this->driver_id) . '/' . $value;
        return null;
    }

    public function getIdNoAttribute($value)
    {
        if (isset($value))
            return url('storage/app/vehicles/' . $this->driver_id) . '/' . $value;
        return null;
    }
}
