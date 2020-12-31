<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['icon32'];

    public function getIcon32Attribute()
    {
        if (isset($this->icon) && !preg_match("/unknown_ic/i", $this->icon))
            return url('storage/app/categories/' . $this->id) . '/32/' . $this->getOriginal('icon');
        return url('assets/unknown_ic.png');
    }

    public function getIconAttribute($value)
    {
        if (isset($value))
            return url('storage/app/categories/' . $this->id) . '/' . $value;
        return url('assets/unknown_ic.png');
    }

    public function getNameAttribute($value)
    {

        if (request()->segment(1) == 'api') {
            if (request()->hasHeader('lang') && request()->header('lang') == 'ar') {
                return $this->name_ar;
            }
            return $value;
        }


        if (session()->has('lang') && request()->segment(1) != 'admin') {
            if (session()->get('lang') == 'ar') {
                return $this->name_ar;
            }
        }
        return $value;
    }

}
