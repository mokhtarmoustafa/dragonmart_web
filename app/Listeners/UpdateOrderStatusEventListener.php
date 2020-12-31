<?php

namespace App\Listeners;

use App\Events\UpdateOrderStatusEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateOrderStatusEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UpdateOrderStatusEvent $event
     * @return void
     */
    public function handle(UpdateOrderStatusEvent $event)
    {
        //
        $event->order->update(['last_status' => $event->status, 'reject_reason' => $event->reject_reason]);

    }
}
