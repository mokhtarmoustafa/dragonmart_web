<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreCategory extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['category_name'];
    protected $casts = ['store_id' => 'integer','merchant_id' => 'integer','category_id' => 'integer'];

    public function Category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function getCategoryNameAttribute()
    {
        $category = $this->Category()->first();
        return $category->name;
    }
}
