<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Trips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trip_ticket');
            $table->decimal('expense', 14,2);
            $table->integer('commodity_id')->unsigned();
            $table->foreign('commodity_id')
                    ->references('id')
                    ->on('commodity')
                    ->onDelete('cascade');
            $table->integer('truck_id')->unsigned();
            $table->foreign('truck_id')
                    ->references('id')
                    ->on('trucks')
                    ->onDelete('cascade');
            $table->integer('driver_id')->unsigned();
            $table->foreign('driver_id')
                    ->references('id')
                    ->on('employee')
                    ->onDelete('cascade');
            $table->string('destination');
            $table->decimal('num_liters', 14,2);
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
        Schema::dropIfExists('trips');
    }
}
