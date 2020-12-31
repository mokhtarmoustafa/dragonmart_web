<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequest extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['rate', 'is_rate', 'services', 'service_client'];
    protected $casts = ['service_client_id' => 'integer','service_id' => 'integer'];

    public function Service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function ServiceClient()
    {
        return $this->belongsTo(ServiceClient::class, 'service_client_id');
    }

    public function Rates()
    {
        return $this->hasMany(ServiceRate::class, 'service_request_id', 'id');
    }

    public function getServicesAttribute()
    {
        return $this->Service()->get();
    }

    public function getServiceClientAttribute()
    {
        return $this->ServiceClient()->first();
    }

    public function getRateAttribute()
    {
        $avg_rate = $this->Rates()->avg('rate');
        return (isset($avg_rate)) ? $avg_rate : 0;
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

