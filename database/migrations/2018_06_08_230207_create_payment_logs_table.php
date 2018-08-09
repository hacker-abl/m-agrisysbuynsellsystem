<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('logs_id')->unsigned();
          $table->foreign('logs_id')
                   ->references('id')
                   ->on('customer')
                   ->onDelete('cascade');
          $table->string('paymentmethod');
          $table->string('checknumber');

            $table->integer('paymentamount');
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
        Schema::dropIfExists('payment_logs');
    }
}
