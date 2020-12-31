<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Product extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['offer_price', 'rate', 'is_rate', 'images', 'category', 'merchant', 'customizations', 'order_count'];
    protected $casts = ['price' => 'double', 'original_quantity' => 'integer', 'available_quantity' => 'integer', 'is_offer' => 'integer', 'offer_percentage' => 'double', 'is_sponsor' => 'integer', 'admin_is_sponsor' => 'integer', 'sponsor_duration' => 'integer', 'has_custom' => 'integer', 'merchant_id' => 'integer', 'category_id' => 'integer', 'store_id' => 'integer', 'is_active' => 'integer'];

    public function Category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function Merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function Customizations()
    {
        return $this->belongsToMany(Customization::class, 'product_customizations', 'product_id', 'custom_id')->withPivot(['price', 'text', 'description', 'is_default']);
        //        return $this->hasMany(ProductCustomization::class, 'product_id', 'id');
    }

    public function Store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function Rates()
    {
        return $this->hasMany(ProductRate::class, 'product_id', 'id');
    }

    public function Images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    //    public function Orders()
    //    {
    //        return $this->hasMany(OrderProduct::class, 'cart_product_id', 'id')->where('type','order');
    //    }

    public function getCategoryAttribute()
    {
        return $this->Category()->first();
    }

    public function getMerchantAttribute()
    {
        if (request()->segment(3) != 'profile' && request()->segment(3) != 'merchants')
            return $this->Merchant()->first(); //
    }


    // public  function getMerchantIdAttribute(){

    //     // return $this->Store()->first()->merchant_id;
    // }

    public function getImagesAttribute()
    {
        return $this->Images()->get();
    }

    public function getOrderCountAttribute()
    {
        //        g->count();

        $count = OrderProduct::join('orders', 'orders.id', '=', 'order_products.order_id')->where('orders.last_status', 'finished')->where('product_id', $this->id)->count();

        $count += OrderProduct::join('cart_products', 'cart_products.id', '=', 'order_products.product_id')->join('orders', 'orders.id', '=', 'order_products.order_id')->where('cart_products.product_id', $this->id)->where('orders.last_status', 'finished')->count();

        return $count;
    }

    public function getCustomizationsAttribute()
    {

        return $this->Customizations()->with(['product_customizations' => function ($query) {
            $query->where('product_id', $this->id);
        }])->get()->unique();
    }

    public function getRateAttribute()
    {
        $avg_rate = $this->Rates()->avg('rate');
        return (isset($avg_rate)) ? doubleval($avg_rate) : 0;
    }


    public function getOfferPriceAttribute()
    {
        if ($this->is_offer)
            return $this->price - (($this->price * $this->offer_percentage) / 100.0);
        return 0;
    }

    public function getIsRateAttribute()
    {
        if (auth()->check()) {
            $is_rate = $this->Rates()->where('user_id', auth()->user()->id)->first();
            return isset($is_rate);
        }

        return false;
    }

    public static function getPopular()
    {
        $product_top_rate_ids = Product::leftJoin('product_rates', function ($join) {
            $join->on('products.id', '=', 'product_rates.product_id');
        })->groupBy('product_rates.product_id')
            ->select('product_rates.product_id', DB::raw('ROUND(AVG(product_rates.rate),2) as rate'), DB::raw('count(product_rates.product_id) as num_rates'))->orderByDesc('num_rates')->orderByDesc('rate')->pluck('product_id');
        $popular_products = Product::whereIn('id', $product_top_rate_ids)->orderByDesc('created_at'); // popular of products (top rating)
        return $popular_products;
    }

    public static function getTopSelling()
    {
        $cart_product_ids = CartProduct::select('product_id', DB::raw('COUNT(*) as NUM_PROD'), DB::raw('SUM(quantity) as SUM_QUANTITY'))->groupBy('product_id')->orderByDESC('SUM_QUANTITY')->pluck('product_id');
        $cart_ids = CartProduct::whereIn('product_id', $cart_product_ids)->pluck('id')->unique();

        $order_product_cart_id = OrderProduct::whereIn('product_id', $cart_ids)->join('order_statuses', 'order_products.order_id', '=', 'order_statuses.order_id')->where('order_statuses.status', 'finished')->pluck('order_products.product_id');

        $product_top_selling_ids = CartProduct::whereIn('id', $order_product_cart_id)->select('product_id', DB::raw('COUNT(*) as NUM_PROD'), DB::raw('SUM(quantity) as SUM_QUANTITY'))->groupBy('product_id')->orderByDESC('SUM_QUANTITY')->pluck('product_id')->toArray();

        $order_product_id = OrderProduct::join('order_statuses', 'order_products.order_id', '=', 'order_statuses.order_id')->where('order_statuses.status', 'finished')->pluck('order_products.product_id')->toArray();

        //        dd($order_product_id);
        $product_top_selling_ids = array_merge($product_top_selling_ids, $order_product_id);

        $ids_products = implode(',', $product_top_selling_ids);
        //        dd($ids_products);

        if (!isset($ids_products) || empty($ids_products))
            $ids_products = 0;
        $top_selling_products = Product::whereIn('id', $product_top_selling_ids)->orderByRaw(DB::raw("FIELD(id, $ids_products)"));

        return $top_selling_products;
    }
}
