<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminNotification extends Model
{
    //
    use SoftDeletes;
    protected $casts = ['sender_id' => 'integer'];


    public function Sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

}
