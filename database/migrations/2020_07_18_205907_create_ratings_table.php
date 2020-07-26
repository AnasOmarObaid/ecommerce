<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('rating');
            $table->string('features');
            $table->string('defects');
            $table->string('review');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');

            //   $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
