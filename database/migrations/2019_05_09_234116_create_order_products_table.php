<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('cart_product_id');
            $table->double('price');
            $table->double('quantity');
            $table->unsignedBigInteger('custom_id')->nullable();
            $table->enum('type',['cart','order'])->default('cart'); // cart => initial add product to cart in order to make order, order => add product to order directly
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
//            $table->foreign('cart_product_id')->references('id')->on('cart_products')->onDelete('cascade');
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
        Schema::dropIfExists('order_products');
    }
}
