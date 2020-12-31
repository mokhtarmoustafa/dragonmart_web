<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile');
            $table->string('new_mobile')->nullable();
            $table->integer('country_code_length')->default(4);
            $table->string('verification_code');
            $table->boolean('is_confirm_code')->default(false);
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('image')->nullable();
            $table->longText('bio')->nullable();
            $table->enum('type',['driver','client','merchant','service_provider']);
            $table->enum('lang',['en','ar'])->default('en');
            $table->boolean('is_active')->default(false);
            $table->boolean('has_delivery')->default(false);
            $table->boolean('is_driver_available')->default(true);
            $table->boolean('is_reset_password')->default(false);
            $table->unsignedBigInteger('driver_type_id')->nullable();
//            $table->double('min_order_amount')->nullable();
            $table->double('commission_rate')->default(0);
            $table->double('refund_commission_rate')->default(0); // %

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('driver_type_id')->references('id')->on('driver_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
