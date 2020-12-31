<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartProduct extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['total_price', 'product', 'customizations'];
    protected $casts = ['price' => 'double', 'product_id' => 'integer', 'cart_id' => 'integer', 'custom_id' => 'integer', 'quantity' => 'integer', 'store_id' => 'integer', 'merchant_id' => 'integer'];

    public function Cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function Customizations()
    {
        return $this->belongsToMany(ProductCustomization::class, CartProductCustom::class, 'cart_product_id', 'custom_id', 'id', 'id');
    }

    public function getProductAttribute()
    {
        return $this->Product()->first();
    }

    public function getTotalPriceAttribute()
    {
        return $this->price * $this->quantity;
    }

    public function getCustomizationsAttribute()
    {
        return $this->Customizations()->get();
    }


}
