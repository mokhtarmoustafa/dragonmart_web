<?php

/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\DeviceToken;
use App\Notification;
use App\NotificationReceiver;
//use App\Reason;
use App\User;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;

class NotificationSystemEloquent
{

    private $devices_id;


    public function sendNotification($sender_id, $receiver_id, $action_id, $action, $other = null) //$object
    {
        if ($sender_id != $receiver_id) {

            $tokens = DeviceToken::getReceiverToken($receiver_id); //

            $this->devices_id = DeviceToken::getDevices($receiver_id);

            if (count($tokens) > 0 || count($tokens) > 0) {

                $attributes = [
                    'sender_id' => $sender_id,
                    'receiver_id' => $receiver_id,
                    'action_id' => $action_id,
                    'action' => $action
                ];
                $notification = Notification::where('action_id', $action_id)->where('action', $action)->first();
                if (!isset($notification))
                    $notification = $this->create($attributes);

                //send fcm message
                $receiver_notification = NotificationReceiver::where('notification_id', $notification->id)->where('receiver_id', $receiver_id)->first();
                if (!isset($receiver_notification))
                    $receiver_notification = new NotificationReceiver();
                $receiver_notification->notification_id = $notification->id;
                $receiver_notification->receiver_id = $receiver_id;
                $receiver_notification->save();
                $receiver = User::find($receiver_id);
                app()->setLocale($receiver->lang);

                $message = $this->getAction($action, $other);

                if (request()->segment(1) == 'api')
                    app()->setLocale(request()->header('lang'));
                else
                    app()->setLocale(session()->get('lang'));

                $object = new \stdClass();
                $object->message = $message;
                $notification->message = $object;

                $notification = Notification::find($notification->id);
                $notification->text = $message;
                $notification->save();
                $badge = $this->getCountUnseen($receiver_id);

                $notification = Notification::find($notification->id);
                try {
                    if (count($tokens[0]) > 0 || count($tokens[1]) > 0 || count($this->devices_id) > 0)
                        $fcm_object = $this->FCM(config('app.name'), $message, $notification, $tokens, $badge, $action);
                } catch (\Throwable $e) { // For PHP 7
                    // handle $e
                } catch (\Exception $e) { // For PHP 5
                    // handle $e

                }
            }
        }
    }

    public function FCM($title, $body, $data, $tokens, $badge)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default')->setBadge($badge);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['data' => $data]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $notification->click_action = 'OPEN_NOTIFICATION_ACTIVITY';

        $data = $dataBuilder->build();


        //android
        if (count($tokens[0]) > 0) {
            // You must change it to get your tokens
            $downstreamResponse = FCM::sendTo($tokens[0], $option, $notification, $data);
        }
        //ios
        if (count($tokens[1]) > 0) {

            $downstreamResponse = FCM::sendTo($tokens[1], $option, $notification, $data);
        }


        //return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        //return Array (key : oldToken, value : new token - you must change the token in your database )
        $downstreamResponse->tokensToModify();

        //return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
        $downstreamResponse->tokensWithError();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $object = [
            'numberSuccess' => $downstreamResponse->numberSuccess(),
            'numberFailure' => $downstreamResponse->numberFailure(),
            'numberModification' => $downstreamResponse->numberModification(),
        ];

        return $object;
    }

    public function FCM_Topic($body)
    {
        $notificationBuilder = new PayloadNotificationBuilder(config('app.name'));
        $notificationBuilder->setBody($body)->setSound('default');

        $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic('DragonMartNotification');

        $topicResponse = FCM::sendToTopic($topic, null, $notification, null);

        $object = [
            'numberSuccess' => $topicResponse->isSuccess(),
            'numberFailure' => $topicResponse->shouldRetry(),
            'numberModification' => $topicResponse->error(),
        ];

        return response_api(true, 200, null, $object);
    }

    public function getAction($action, $other)
    {

        switch ($action) {
            case 'user_approved':
                return trans('app.notifications.user_approved');
            case 'user_disabled':
                return trans('app.notifications.user_disabled');
            case 'new_order':
                return trans('app.notifications.new_order');
            case 'in_progress_order':
                return trans('app.notifications.in_progress_order');
            case 'send_order':
                return trans('app.notifications.send_order');
            case 'accept_order':
                return trans('app.notifications.accept_order');
            case 'reject_order':
                return trans('app.notifications.reject_order', ['message' => $other]);
            case 'canceled_order':
                return trans('app.notifications.canceled_order');
            case 'start_navigation':
                return trans('app.notifications.start_navigation');
            case 'finished_order':
                return trans('app.notifications.finished_order');
            case 'rate_product':
                return trans('app.notifications.rate_product');
            case 'rate_service':
                return trans('app.notifications.rate_service');
            case 'order_delivered':
                return trans('app.notifications.order_delivered');
            case 'send_service':
                return trans('app.notifications.send_service');
            case 'accepted_request':
                return trans('app.notifications.accepted_request');
            case 'rejected_request':
                return trans('app.notifications.rejected_request');
            case 'canceled_request':
                return trans('app.notifications.canceled_request');
            case 'finished_request':
                return trans('app.notifications.finished_request');
            case 'accepted_driver':
                return trans('app.notifications.accepted_driver');
            case 'rejected_driver':
                return trans('app.notifications.rejected_driver', ['message' => $other]);
            case 'pickup_driver':
                return trans('app.notifications.pickup_driver');
            case 'drop_off_driver':
                return trans('app.notifications.drop_off_driver');
            case 'assign_driver':
                return trans('app.notifications.assign_driver');
            case 'notify_merchant_assign_driver':
                return trans('app.notifications.notify_merchant_assign_driver', ['driver_name' => $other]);
            case 'store_arrival_driver':
                return trans('app.notifications.store_arrival_driver');
            case 'client_arrival_driver':
                return trans('app.notifications.client_arrival_driver');
            case 'product_deleted':
                return trans('app.notifications.product_deleted', ['product_name' => $other]);
            default:
                return trans('app.notifications.chat');
        }
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.

        $notification = new Notification();
        $notification->sender_id = $attributes['sender_id'];
        $notification->action = $attributes['action'];
        $notification->action_id = $attributes['action_id'];
        if ($notification->save()) {

            return $notification;
        }

        return null;
    }

    public function getCountUnseen($receiver_id)
    {
        $notifications_id = NotificationReceiver::where('receiver_id', $receiver_id)->pluck('notification_id');
        return Notification::whereIn('id', $notifications_id)->where('seen', 0)->count();
    }
}
