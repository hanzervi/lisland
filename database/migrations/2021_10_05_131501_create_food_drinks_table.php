<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_drinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->default('noimage.png');
            $table->string('name');
            $table->string('description');
            $table->string('category');
            $table->string('price');
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->unsigned();
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
        Schema::dropIfExists('food_drinks');
    }
}
