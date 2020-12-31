<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->enum('action', ['user_approved', 'user_disabled', 'send_order', 'accept_order', 'reject_order', 'canceled_order', 'accepted_driver', 'rejected_driver', 'start_navigation', 'pickup_driver', 'drop_off_driver', 'finished_order', 'rate_product', 'rate_service', 'send_service', 'accepted_request', 'rejected_request', 'canceled_request','assign_driver','notify_merchant_assign_driver', 'chat']);

            $table->unsignedInteger('action_id')->nullable();
            $table->string('text')->nullable();
            $table->boolean('seen')->default(false);

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}



/*
 *
 * merchant account has been approved.

merchant account has been disabled.

client account has been disabled.

service provider account has been approved

service provider account has been disabled.

client send a new request to merchant.

merchant accept the client order

merchant reject the client order (send the resaon in notification)

the client canceled the order

the driver starting the order delivery

the driver reached the pickup location

the driver reached the drop-off location

the client confirmed the procurement process (finished)

the client has rated the product

the client send service order

the service provider accept the request.

the service provider reject the request.

the driver has reject the request (between driver and merchant)

chats notifications



....................Notifications...............................

action              action_id        description

user_approved       user_id             merchant|client|driver|service_provider account has been approved.
user_disabled       user_id             merchant|client|driver|service_provider account has been disabled.
send_order          order_id            client send a new request to merchant.
accept_order        order_id            merchant accept the client order.
reject_order        order_id            merchant reject the client order.
canceled_order      order_id            client canceled the order.
finished_order      order_id            client confirmed the procurement process.
accepted_driver     order_id            driver accepted your request.
rejected_driver     order_id            driver rejected your request.
start_navigation    order_id            driver starting the order delivery.
pickup_driver       order_id            driver reached the pickup location.
drop_off_driver     order_id            driver reached the drop-off location.
rate_product        product_id          client has rated the product.
rate_service        service_request_id  client has rated the service.
send_service        request_id          client send service order.
accepted_request    request_id          provider accept the request.
rejected_request    request_id          provider reject the request.
canceled_request    request_id          client reject the request.
finished_request    request_id          provider finished the request.
chat                user_id             chats.
 */
