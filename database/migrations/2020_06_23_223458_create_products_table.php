<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //name , description , tag , pro&ins , raw and style in product translation
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('product_number')->nullable();
            $table->string('poster')->nullable();
            $table->boolean('gender')->nullable();
            //images in products_images table
            $table->double('purchase_price', 8, 2);
            // color table
            $table->double('curet_sale_price', 8, 2)->nullable();
            $table->double('new_sale_price', 8, 2)->nullable();
            $table->integer('stoke')->default(0);
            // size table
            $table->integer('number_sale')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
