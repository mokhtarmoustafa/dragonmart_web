<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    //
    use SoftDeletes;
    protected $appends = [ 'service_provider_name', 'category'];
    protected $casts = ['user_id' => 'integer','category_id' => 'integer','price' => 'double'];

    public function Category()
    {
        return $this->belongsTo(ProviderCategory::class, 'category_id');
    }

    public function ServiceProvider()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getCategoryAttribute()
    {
        return $this->Category()->first();
    }

    public function getServiceProviderNameAttribute()
    {
//        if (request()->segment(3) != 'profile' && request()->segment(3) != 'service_request' && request()->segment(3) != 'service_providers' && request()->segment(3) != 'service_requests'&& request()->segment(3) != 'user')
        $service_provider = $this->ServiceProvider()->first();
        return (isset($service_provider)) ? $service_provider->username : null;
    }


}
