<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Order extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['last_status', 'reject_reason'];

    protected $appends = [
        'driver',
        'merchant',
        'store',
        'order_user',
        'order_status', //
        'order_products',
        'delivery_method',
        'revenue',
        'commission_cost', 
        'duration',
        'statuses' //
    ];
    protected $casts = ['user_order_id' => 'integer', 'store_id' => 'integer', 'merchant_id' => 'integer', 'driver_id' => 'integer', 'products_price' => 'double', 'shipment_price' => 'double', 'commission_rate' => 'double'];

    public function OrderProducts()
    {
        return $this->belongsToMany(CartProduct::class, OrderProduct::class, 'order_id', 'product_id')->withPivot('quantity');
        // return $this->belongsToMany(CartProduct::class, OrderProduct::class, 'order_id', 'cart_product_id')->where('order_products.type', 'cart')->withPivot('quantity');
    }

    public function DirectOrderProducts()
    {
        return $this->belongsToMany(Product::class, OrderProduct::class, 'order_id', 'product_id')->withPivot('quantity');
        // return $this->belongsToMany(Product::class, OrderProduct::class, 'order_id', 'cart_product_id')->where('order_products.type', 'order')->withPivot('quantity');
    }

    public function OrderStatus()
    {
        return $this->hasMany(OrderStatus::class, 'order_id', 'id');
    }

    public function OrderUser()
    {
        return $this->belongsTo(OrderUser::class, 'user_order_id');
    }


    public function Merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id', 'id');
    }

    public function Driver()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function getStoreAttribute()
    {
        return Store::where('id', $this->store_id)->first();
    }

    public function getOrderProductsAttribute()
    {
        return OrderProduct::where('order_id', $this->id)->get();
    }

    public function getOrderUserAttribute()
    {
        $order = $this->OrderUser()->first();
        if (isset($order))
            return $order->makeHidden('orders');
    }

    public function getMerchantAttribute()
    {
        $merchant = $this->Merchant()->first();
        if (isset($merchant))
            return $merchant->makeHidden('merchant_products');
    }

    public function getDriverAttribute()
    {
        return $this->Driver()->first();
    }

    public function getTypeAttribute()
    {
        return 'order';
    }

    public function getDeliveryMethodAttribute()
    {
        if (isset($this->driver_source))
            return DriverType::where('key', $this->driver_source)->first()->name;
        return null;
    }

    public function getRevenueAttribute()
    {
        if (isset($this->driver_source)) {
            if ($this->driver_source == 'any_driver')
                return ($this->commission_rate * $this->products_price) / 100.0 + $this->shipment_price;
            else
                return ($this->commission_rate * $this->products_price) / 100.0;
        }
        return 0;
    }

    public function getCommissionCostAttribute()
    {
        if (isset($this->driver_source)) {
            return ($this->commission_rate * $this->products_price) / 100.0;
        }
        return 0;
    }


    public function getOrderStatusAttribute()
    {
        $order_status = $this->OrderStatus()->orderByDesc('created_at')->first();

        return $order_status;
    }

    public function getStatusesAttribute()
    {
        return $this->OrderStatus()->get();
    }

    public function getDurationAttribute()
    {
        $first_status = $this->OrderStatus()->where('edit_at', 'last_status')->where('status', 'new')->orderByDesc('created_at')->first();
        $last_status = $this->OrderStatus()->orderByDesc('created_at')->first();
        
        if (isset($first_status) && ($this->driver_status != 'delivered' || $this->last_status != 'canceled' || $this->last_status != 'rejected')) {
            
            $totalDuration = Carbon::now()->diffInSeconds($first_status->created_at);
            return gmdate('H:i:s', $totalDuration);
        }
        elseif(isset($first_status) && ($this->driver_status == 'delivered' || $this->last_status == 'canceled' || $this->last_status == 'rejected')){
            $totalDuration = $last_status->created_at->diffInSeconds($first_status->created_at);
            return gmdate('H:i:s', $totalDuration);
        }
        else{
            return 'Issue with statuses';
        }
    }
}
