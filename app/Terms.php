<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terms extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['desc','title'];

    public function getTitleAttribute()
    {
        if ((request()->has('lang') && request()->get('lang') == 'ar') || (session()->has('lang') && session()->get('lang') == 'ar'))
            return $this->title_ar;
        return $this->title_en;
    }
    public function getDescAttribute()
    {
        if ((request()->has('lang') && request()->get('lang') == 'ar') || (session()->has('lang') && session()->get('lang') == 'ar'))
            return $this->desc_ar;
        return $this->desc_en;
    }

}
