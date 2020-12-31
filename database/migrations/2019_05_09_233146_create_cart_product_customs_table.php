<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_product_customs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cart_product_id');
            $table->unsignedBigInteger('custom_id');
            $table->double('price')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cart_product_id')->references('id')->on('cart_products')->onDelete('cascade');
            $table->foreign('custom_id')->references('id')->on('product_customizations')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_product_customs');
    }
}
