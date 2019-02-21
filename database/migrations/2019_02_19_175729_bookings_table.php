<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('bookings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('doctor_id')->unsigned();;
            $table->foreign('doctor_id')->references('id')->on('doctors')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_email');
            $table->string('client_comment');
            $table->string('booking');
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
        Schema::dropIfExists('bookings');
    }
}
