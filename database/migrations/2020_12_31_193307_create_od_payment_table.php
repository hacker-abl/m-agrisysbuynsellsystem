<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('od_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('od_id');
            $table->foreign('od_id')->references('id')->on('deliveries')->onDelete('cascade');
            $table->date('date');
            $table->decimal('amount', 10, 2);
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
        Schema::dropIfExists('od_payment');
    }
}
