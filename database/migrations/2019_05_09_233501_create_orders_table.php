<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_order_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('merchant_id');
            $table->enum('driver_source', ['my_driver', 'any_driver', 'third_part'])->nullable(); //my_driver => merchant's drivers, any_driver => any freelancer will accept the order, third_part => Aramex
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->double('products_price')->default(0);
            $table->double('shipment_price')->default(0);
            $table->enum('last_status', ['pending','new', 'accepted', 'progress', 'finished', 'canceled', 'rejected'])->nullable();// pending => client submit order and wait to pay. // new => client send order but merchant not accepted,accepted => merchant accepted order,progress => merchant send order to driver,finish => client received his order, canceled => client can cancel order if status = new, rejected => merchant can reject order if status = new
            $table->longText('reject_reason')->nullable();
            $table->enum('driver_status', ['pending', 'new', 'accepted', 'rejected','pickup'])->default('pending');// pending => not sent to driver, new => sent but not accept, accepted => sent and accept, reject => sent and reject, pickup => confirm pickup from merchant
            $table->longText('driver_reject_reason')->nullable();
            $table->timestamp('actual_received_date')->nullable();
            $table->double('commission_rate')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_order_id')->references('id')->on('order_users')->onDelete('cascade');
            $table->foreign('merchant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
