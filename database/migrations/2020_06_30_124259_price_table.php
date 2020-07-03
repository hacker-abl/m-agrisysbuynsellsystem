<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commodity_id')->unsigned();
            $table->foreign('commodity_id')
                ->references('id')
                ->on('commodity')
                ->onDelete('cascade');
                $table->integer('company_id')->unsigned();
                $table->foreign('company_id')
                    ->references('id')
                    ->on('company')
                    ->onDelete('cascade');
            $table->string('price');
            $table->string('date');
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
        Schema::dropIfExists('prices');
    }
}
