<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationReceiver extends Model
{
    //
    use SoftDeletes;

    protected $casts = ['notification_id' => 'integer', 'receiver_id' => 'integer'];

}
