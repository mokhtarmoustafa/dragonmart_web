<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Store extends Model
{
    //
    use SoftDeletes;
    protected $appends = ['categories', 'drivers', 'is_open'];
    protected $casts = ['merchant_id' => 'integer'];

    public function Merchant()
    {
        return $this->belongsTo(Admin::class, 'merchant_id');
    }

    public function Categories()
    {
        return $this->belongsToMany(ProductCategory::class, StoreCategory::class, 'store_id', 'category_id')->whereNull('store_categories.deleted_at');
    }

    public function Drivers()
    {
        return $this->belongsToMany(User::class, StoreDriver::class, 'store_id', 'driver_id');
    }

    public function getCategoriesAttribute()
    {
        return $this->Categories()->get();
    }

    public function getDriversAttribute()
    {
        return $this->Drivers()->get();
    }

    public function getIsOpenAttribute()
    {
        $today = Carbon::now()->format('l');

        $now = Carbon::now()->format('H:i');

        
        $open_times = json_decode($this->open_times);
        $close_times = json_decode($this->close_times);
        
        return 'open';
        $open_time = '';
        $close_time = '';
        $close_tomorow = false;

        // get today open time
        foreach ($open_times as $day => $time) {
            if ($day == $today) {
                $open_time = $time;
            }
        }
        // get today close time
        foreach ($close_times as $day => $time) {
            if ($day == $today) {
                $close_time = $time;
            }
        }

        // Close tomorow?
        if ($close_time < $open_time) { 
            $close_tomorow = true;
        }

        if (($now >= $open_time && $now > $close_time && $close_tomorow)
            || ($now < $open_time && $now < $close_time && $close_tomorow)
            || ($now >= $open_time && $now < $close_time && !$close_tomorow)
        )
            return 'open';
        else
            return 'close';
    }
}
