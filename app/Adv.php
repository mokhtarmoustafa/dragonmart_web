<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adv extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['image100', 'image300', 'merchant_image'];
    protected $hidden = ['Merchant'];


    public function Merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function getImage100Attribute()
    {
        return url('storage/app/advs/' . $this->id) . '/100/' . $this->image;
    }

    public function getImage300Attribute()
    {
        return url('storage/app/advs/' . $this->id) . '/300/' . $this->image;
    }

    public function getImageAttribute($image)
    {
        if (isset($image))
            return url('storage/app/advs/' . $this->id) . '/' . $image;
        return null;
    }

    public function getMerchantImageAttribute(){
        return $this->Merchant['image'];
    }


    public function getActionAttribute($action)
    {
            return json_decode($action);
    }



}
