<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['title'];
    protected $casts = ['sender_id' => 'integer', 'action_id' => 'integer'];


    public function Sender()
    {
        return $this->belongsTo(User::class, 'sender_id')->withTrashed();
    }

    public function getTitleAttribute()
    {
        if ($this->action == 'user_approved' || $this->action == 'user_disabled') {
            return 'User';
        } elseif ($this->action == 'send_order' || $this->action == 'accept_order'
            || $this->action == 'reject_order' || $this->action == 'canceled_order'
            || $this->action == 'finished_order' || $this->action == 'accepted_driver'
            || $this->action == 'rejected_driver' || $this->action == 'start_navigation'
            || $this->action == 'pickup_driver' || $this->action == 'drop_off_driver') {
            return 'Order';
        } elseif ($this->action == 'send_service' || $this->action == 'accepted_request'
            || $this->action == 'rejected_request' || $this->action == 'canceled_request'
            || $this->action == 'finished_request') {
            return 'Request';
        } elseif ($this->action == 'chat') {
            return 'Chat';
        } elseif ($this->action == 'rate_service' || $this->action == 'rate_product') {
            return 'Rate';
        }

        return null;

    }

}
