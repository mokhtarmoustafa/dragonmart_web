<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class OrderStatus extends Model
{
    //
    use SoftDeletes;
    protected $casts = ['order_id' => 'integer'];
    protected $appends = ['duration'];

    public function Order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getDurationAttribute(){
        $totalDuration = Carbon::now()->diffInSeconds($this->created_at);
        return gmdate('H:i:s', $totalDuration);
    }

    
}
