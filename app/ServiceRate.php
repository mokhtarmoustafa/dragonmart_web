<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRate extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['client_name'];
    protected $casts = ['service_request_id' => 'integer','user_id' => 'integer','rate' => 'double'];

    public function Client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getClientNameAttribute()
    {
        $client = $this->Client()->first();
        return isset($client) ? $client->username : null;
    }

}
