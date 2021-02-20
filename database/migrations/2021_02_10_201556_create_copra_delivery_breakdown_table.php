<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopraDeliveryBreakdownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copra_delivery', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('od_id');
            $table->foreign('od_id')->references('id')->on('deliveries')->onDelete('cascade');
            $table->string('wr');
            $table->decimal('net_weight', 10, 2);
            $table->decimal('dust', 10, 2)->nullable();
            $table->decimal('moist', 10, 2)->nullable();
            $table->decimal('resicada', 10, 2);
            $table->timestamps();
        });
 
        Schema::create('copra_breakdown', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('copra_id');
            $table->foreign('copra_id')->references('id')->on('copra_delivery')->onDelete('cascade');
            $table->decimal('resicada', 10, 2);
            $table->decimal('price', 10, 2);
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
        //
    }
}
