<?php

namespace App\Http\Controllers;

use App\AdminNotification;
use App\Http\Requests\Api\Notication\SendPublicRequest;
use App\Notification;
use App\NotificationReceiver;
use App\Repositories\Eloquents\NotificationEloquent;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    private $notification;

    public function __construct(NotificationEloquent $notificationEloquent)
    {
        parent::__construct();
        $this->notification = $notificationEloquent;
    }

    // Begin category operation
    public function index()
    {

        $data = [
            'main_title' => 'Notifications',
            'icon' => 'fa fa-bell',
        ];

        if (getAuth()->type == 'admin') {
            AdminNotification::where('seen', 0)->update(['seen' => 1]);
        } else {
            $notification_ids = NotificationReceiver::where('receiver_id', getAuth()->user_id)->pluck('notification_id');
            Notification::whereIn('id', $notification_ids)->where('seen', 0)->update(['seen' => 1]);
        }
        return view(current_view() . '.notifications', $data);
    }

    public function anyData()
    {
        return $this->notification->anyData();
    }

    public function delete($id)
    {
        return $this->notification->delete($id);
    }

    public function admin_delete($id)
    {
        return $this->notification->admin_delete($id);
    }

    public function sendPublicNotification(SendPublicRequest $request)
    {
        return $this->notification->sendPublicNotification($request->all());
    }
}
