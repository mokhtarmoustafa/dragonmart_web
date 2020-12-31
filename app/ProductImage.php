<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['image100', 'image300', 'name', 'url', 'thumbnailUrl', 'deleteUrl', 'deleteType','deleteClass'];
    protected $casts = ['product_id' => 'integer'];

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
        // if(auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin"){
        //     $url = "admin";
        // }else {
        //     $url = merchant_store_url();
        // }
        $url = merchant_store_url();
        
        return url( $url . '/product/delete-image/' . $this->id);
    }

    public function getDeleteTypeAttribute()
    {
        return 'DELETE';

    }

    public function getDeleteClassAttribute()
    {
        return 'delete-product-image';

    }


    public function getImage100Attribute()
    {
        return url('storage/app/products/' . $this->product_id) . '/100/' . $this->getOriginal('image');
    }

    public function getImage300Attribute()
    {
        return url('storage/app/products/' . $this->product_id) . '/300/' . $this->getOriginal('image');
    }

    public function getImageAttribute($value)
    {
        if (isset($value))
            return url('storage/app/products/' . $this->product_id) . '/' . $value;
        return null;
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $filename = storage_path('app/products/' . $model->product_id . '/' . $model->getOriginal('image'));
            $filename100 = storage_path('app/products/' . $model->product_id . '/100/' . $model->getOriginal('image'));
            $filename300 = storage_path('app/products/' . $model->product_id . '/300/' . $model->getOriginal('image'));
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
