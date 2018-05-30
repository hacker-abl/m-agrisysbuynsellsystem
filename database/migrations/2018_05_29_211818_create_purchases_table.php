<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
             $table->increments('id');
            $table->string('trans_no');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')
                    ->references('id')
                    ->on('customer')
                    ->onDelete('cascade');
          $table->integer('commodity_id')->unsigned();
          $table->foreign('commodity_id')
                    ->references('id')
                    ->on('commodity')
                    ->onDelete('cascade');
           $table->integer('sacks');
           $table->integer('ca_id')->unsigned();
           $table->foreign('ca_id')
                     ->references('customer_id')
                     ->on('cash_advance')
                     ->onDelete('cascade');
          $table->integer('balance_id')->unsigned();
          $table->foreign('balance_id')
                    ->references('customer_id')
                    ->on('cash_advance')
                    ->onDelete('cascade');
            $table->decimal('partial');
            $table->integer('kilo');
            $table->decimal('price');
            $table->decimal('total');
            $table->decimal('amtpay');
            $table->string('remarks');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
