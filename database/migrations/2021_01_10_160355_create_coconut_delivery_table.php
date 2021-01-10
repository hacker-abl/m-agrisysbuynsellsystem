<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoconutDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coconut_delivery', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('od_id');
            $table->foreign('od_id')->references('id')->on('deliveries')->onDelete('cascade');
            $table->decimal('gross_weight', 10, 2);
            $table->decimal('moisture', 10, 2);
            $table->decimal('net_weight', 10, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('amount', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('unloading', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
        });

        Schema::create('nuts_reject', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('coconut_delivery_id');
            $table->foreign('coconut_delivery_id')->references('id')->on('coconut_delivery')->onDelete('cascade');
            $table->decimal('reject', 10, 2);
            $table->decimal('copra', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coconut_delivery');
    }
}
