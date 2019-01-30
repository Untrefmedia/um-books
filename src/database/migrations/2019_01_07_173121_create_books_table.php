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
            $table->increments('id');
            $table->integer('venue_id')->unsigned()->nullable();
            $table->dateTime('event_date_start')->nullable();
            $table->dateTime('event_date_end')->nullable();
            $table->text('detail');
            $table->integer('status')->default(1)->unsigned()->comment('[1: pendiente, 2: confirmado]');

            $table->timestamps();

            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade')->onUpdate('cascade');
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
