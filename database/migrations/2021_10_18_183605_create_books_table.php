<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->integer('customer_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->integer('adults');
            $table->integer('children')->default(0)->nullable();
            $table->integer('infants')->default(0)->nullable();
            $table->integer('add_person')->default(0)->nullable();
            $table->date('check_in');
            $table->date('check_out');
            $table->float('priceTotal');
            $table->tinyInteger('status')->default(1)->comment('-1 = delete; 0 = pending; 1 = reserved; 2 = checkout;');
            $table->string('remarks')->nullable()->default(null);
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
        Schema::dropIfExists('books');
    }
}
