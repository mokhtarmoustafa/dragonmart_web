<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverType extends Model
{
    //
    use SoftDeletes;
    protected $casts = ['price' => 'double'];

    protected $appends = ['type'];

    public function getTypeAttribute()
    {
        //any_driver,third_part
        if ($this->id == 1) return 'any_driver';
        if ($this->id == 2) return 'third_part';
        if ($this->id == 3) return 'my_driver';
    }
}
