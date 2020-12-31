<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCustomization extends Model
{
    //
    use SoftDeletes;


    protected $appends = ['custom_name'];
    protected $casts = ['product_id' => 'integer','custom_id' => 'integer','price' => 'double','is_default'=>'integer'];

    public function Customization()
    {
        return $this->belongsTo(Customization::class, 'custom_id');
    }

    public function getCustomNameAttribute()
    {
        $custom = $this->Customization()->first();
        return (isset($custom)) ? $custom->name : '';
    }
}
