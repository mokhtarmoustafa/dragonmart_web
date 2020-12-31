<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    //

    use SoftDeletes;

    protected $appends = ['title', 'content'];

    public function getMediaAttribute($value)
    {
        if (isset($value) && $this->media_type == 'image')
            return url('storage/app/abouts/' . $this->id) . '/' . $value;
        return url('assets/upload') . '/' . $this->getOriginal('media');
    }


    public function getTitleAttribute()
    {
        if ((request()->has('lang') && request()->get('lang') == 'ar') || (session()->has('lang') && session()->get('lang') == 'ar'))
            return $this->title_ar;
        return $this->title_en;
    }

    public function getContentAttribute()
    {
        if ((request()->has('lang') && request()->get('lang') == 'ar') || (session()->has('lang') && session()->get('lang') == 'ar'))
            return $this->content_ar;
        return $this->content_en;
    }

}
