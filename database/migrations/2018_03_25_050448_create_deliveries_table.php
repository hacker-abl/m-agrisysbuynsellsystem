<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('outboundTicket');
            $table->integer('commodity_id')->unsigned();
            $table->foreign('commodity_id')
                    ->references('id')
                    ->on('commodity')
                    ->onDelete('cascade');
            $table->string('destination', 255);
            $table->integer('driver_id')->unsigned();
            $table->foreign('driver_id')
                    ->references('id')
                    ->on('employee')
                    ->onDelete('cascade');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')
                    ->references('id')
                    ->on('company')
                    ->onDelete('cascade');
            $table->integer('plateno')->unsigned();
            $table->foreign('plateno')
                    ->references('id')
                    ->on('trucks')
                    ->onDelete('cascade');
            $table->integer('fuel_liters');
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
        Schema::dropIfExists('deliveries');
    }
}
