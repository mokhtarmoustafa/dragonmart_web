<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends Model
{
    //
    use SoftDeletes;

    public function type()
    {
        return $this->hasMany(CarType::class, 'manufacturer_id');
    }
}
