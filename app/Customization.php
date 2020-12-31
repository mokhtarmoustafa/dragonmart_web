<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customization extends Model
{
    //
    use SoftDeletes;
    protected $hidden = ['pivot'];

    public function product_customizations()
    {
        return $this->hasMany(ProductCustomization::class, 'custom_id', 'id');
    }

}
