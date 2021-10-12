<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('images');
            $table->string('image360');
            $table->float('price_wd');
            $table->float('price_we');
            $table->tinyInteger('adults')->default(0)->nullable();
            $table->tinyInteger('children')->default(0)->nullable();
            $table->tinyInteger('infants')->default(0)->nullable();
            $table->text('includes');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('rooms');
    }
}
