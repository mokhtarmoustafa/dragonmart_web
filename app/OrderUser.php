<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderUser extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['orders', 'client'];
    protected $casts = ['user_id' => 'integer', 'calculated_price' => 'double', 'total_shipment_price' => 'double'];

    public function Orders()
    {
        return $this->hasMany(Order::class, 'user_order_id', 'id');
    }

    public function getOrdersAttribute()
    {
        return $this->Orders()->get();
    }

    public function Client()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function getClientAttribute()
    {
        $client = $this->Client()->first();
        if (isset($client))
            return $client->makeHidden(['order_bought', 'order_pending', 'order_canceled']);
    }
}
