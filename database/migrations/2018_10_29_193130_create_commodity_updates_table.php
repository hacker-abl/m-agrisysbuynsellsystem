<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodity_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('commodity_id');
            $table->foreign('commodity_id')->references('id')->on('commodity')->onDelete('cascade');
            $table->enum('checked', [0, 1])->default(1);
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
        Schema::dropIfExists('commodity_updates');
    }
}
