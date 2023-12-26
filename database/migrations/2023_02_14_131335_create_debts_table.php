<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('amount');
            $table->string('tracking_no');
            $table->string('user_id');
            $table->string('customer_id');
            $table->string('amount_paid');
            $table->timestamp('date_cleared');
            $table->string('cleared_by');
            $table->boolean('cleared')->default(false);
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
        Schema::dropIfExists('debts');
    }
}
