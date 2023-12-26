<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('per_night');
            $table->string('checkin');
            $table->string('checkout');
            $table->string('amount');
            $table->string('room_id');
            $table->string('trx');
            $table->string('customer_id');
            $table->string('booking_option');
            $table->string('payment_type')->nullable();
            $table->string('duration');
            $table->boolean('status');
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