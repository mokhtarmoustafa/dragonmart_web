<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_rates', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id'); //client_id
            $table->unsignedBigInteger('service_request_id');
            $table->double('rate'); // 0 -> 5
            $table->longText('comment')->nullable();
            $table->softDeletes();
            $table->timestamps();

//            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('service_request_id')->references('id')->on('service_clients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_rates');
    }
}
