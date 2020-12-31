<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adv extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['image100', 'image300'];


    public function Merchant()
    {
        return $this->belongsTo(Admin::class, 'merchant_id');
    }

    public function getImage100Attribute()
    {
        return url('storage/app/advs/' . $this->id) . '/100/' . $this->attributes['image'];
    }

    public function getImage300Attribute()
    {
        return url('storage/app/advs/' . $this->id) . '/300/' . $this->attributes['image'];
    }

    public function getImageAttribute($value)
    {
        if (isset($value))
            return url('storage/app/advs/' . $this->id) . '/' . $value;
        return null;
    }


    public function getActionAttribute()
    {
            return json_decode($this->attributes['action']);
    }



}
