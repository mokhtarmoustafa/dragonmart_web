<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Cart extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['total_cost', 'products', 'client'];

    protected $casts = ['user_id' => 'integer'];

    public function Products()
    {
        return $this->belongsToMany(Product::class, 'cart_products', 'cart_id', 'product_id')->withPivot(['price', 'quantity']);
    }

    public function Client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getProductsAttribute()
    {
        return $this->Products()->get();
    }

    public function getClientAttribute()
    {
        return $this->Client()->first();
    }

    public function getTotalCostAttribute()
    {
        return $this->Products()->value(DB::raw("SUM(cart_products.price * cart_products.quantity)"));//->sum('cart_products.price', '*' ,'cart_products.quantity');
    }


}
