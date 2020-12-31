<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('p_id');
            $table->string('reference_no');
            $table->string('payment_reference')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->double('amount');
            $table->string('currency');
            $table->enum('status', ['pending', 'paid', 'refund', 'cancel'])->default('pending');
            $table->enum('order_status', ['pending','new', 'accepted', 'canceled', 'rejected'])->nullable();// // new => client send order but merchant not accepted,accepted => merchant accepted order,progress => merchant send order to driver,finish => client received his order, canceled => client can cancel order if status = new, rejected => merchant can reject order if status = new

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
