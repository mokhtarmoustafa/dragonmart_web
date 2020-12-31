<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceClient extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['rate', 'is_rate','client_name', 'type', 'services'];
    protected $casts = ['user_id' => 'integer','total_price' => 'double'];

    public function Client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ServiceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'service_client_id');
    }

    public function Services()
    {
        return $this->belongsToMany(Service::class, ServiceRequest::class, 'service_client_id', 'service_id', 'id', 'id');
    }

    public function Rates()
    {
        return $this->hasMany(ServiceRate::class, 'service_request_id', 'id');
    }


    public function getClientNameAttribute()
    {
        $client = $this->Client()->first();
        return isset($client) ? $client->username : null;
    }

    public function getServicesAttribute()
    {
        return $this->Services()->get();
    }

    public function getTypeAttribute()
    {
        return 'service_request';
    }

    public function getRateAttribute()
    {
        $avg_rate = $this->Rates()->avg('rate');
        return (isset($avg_rate)) ? (double)$avg_rate : 0;
    }

    public function getIsRateAttribute()
    {
        if (auth()->check()) {
            $is_rate = $this->Rates()->where('user_id', auth()->user()->id)->first();
            return isset($is_rate);
        }
        return false;
    }
}
