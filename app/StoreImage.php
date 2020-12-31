<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreImage extends Model
{
    //

    use SoftDeletes;
    protected $appends = ['image100', 'image300', 'name', 'url', 'thumbnailUrl', 'deleteUrl', 'deleteType', 'deleteClass'];
    protected $casts = ['store_id' => 'integer'];

    public function getNameAttribute()
    {
        return $this->getOriginal('image');
    }

    public function getUrlAttribute()
    {
        return $this->image;
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->image300;
    }

    public function getDeleteUrlAttribute()
    {
        return url(merchant_store_url() . '/delete-image/' . $this->id);
    }

    public function getDeleteTypeAttribute()
    {
        return 'DELETE';

    }

    public function getDeleteClassAttribute()
    {
        return 'delete_image';

    }


    public function getImage100Attribute()
    {
        return url('storage/app/stores/' . $this->store_id) . '/100/' . $this->getOriginal('image');
    }

    public function getImage300Attribute()
    {
        return url('storage/app/stores/' . $this->store_id) . '/300/' . $this->getOriginal('image');
    }

    public function getImageAttribute($value)
    {
        if (isset($value))
            return url('storage/app/stores/' . $this->store_id) . '/' . $value;
        return null;
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $filename = storage_path('app/stores/' . $model->store_id . '/' . $model->getOriginal('image'));
            $filename100 = storage_path('app/stores/' . $model->store_id . '/100/' . $model->getOriginal('image'));
            $filename300 = storage_path('app/stores/' . $model->store_id . '/300/' . $model->getOriginal('image'));
//
            if (file_exists($filename)) {
                unlink($filename);
                unlink($filename100);
                unlink($filename300);
                $model->delete();
            }
        });
    }


}
