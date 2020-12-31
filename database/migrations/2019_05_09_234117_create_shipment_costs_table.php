<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_costs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('merchant_id')->nullable();
            $table->double('price')->default(0);
            $table->double('from')->default(0);
            $table->double('to')->default(0);
            $table->enum('type',['admin','merchant']);
            $table->double('min_order_amount')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_costs');
    }
}
