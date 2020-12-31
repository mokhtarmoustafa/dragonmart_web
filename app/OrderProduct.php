<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['total_price', 'product'];
    protected $casts = ['order_id' => 'integer', 'cart_product_id' => 'integer', 'custom_id' => 'integer', 'price' => 'double', 'quantity' => 'double'];

    public function Customizations()
    {
        return $this->belongsToMany(ProductCustomization::class, OrderProductCustom::class, 'order_product_id', 'custom_id', 'id', 'id');
    }

    //    public function Customization()
    //    {
    //        return $this->belongsTo(ProductCustomization::class, 'custom_id');//->withPivot(['price','text', 'description', 'is_default']);
    //        return $this->hasMany(ProductCustomization::class, 'product_id', 'id');
    //    }

    public function getTotalPriceAttribute()
    {

        $total = $this->price;
        $this->custom = json_decode($this->custom, true);
        if (is_array($this->custom)) {
            foreach ($this->custom as $custom) {
                $options = $custom['options'];

                foreach ($options as $option) {

                    $total +=  $option['details_price'];
                }
            }
        }

        return $total * $this->qty;
    }

    public function getCustomizationsAttribute()
    {
        return $this->Customizations()->get();
    }

    public function getProductAttribute()
    {
        // if ($this->type == 'order') {
        return Product::find($this->product_id);
        // } else {
        //     $cart_product = CartProduct::find($this->cart_product_id);
        //     if (isset($cart_product))
        //         return $cart_product->product;

        //     if (isset($this->product_id))
        //         return Product::find($this->product_id);
        // }
    }
}
