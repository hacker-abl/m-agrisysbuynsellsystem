<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OdExpense extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('od_expense', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('od_id')->unsigned();
            $table->foreign('od_id')
                    ->references('id')
                    ->on('deliveries')
                    ->onDelete('cascade');
            $table->string('description');
            $table->string('type');
            $table->decimal('amount', 14,2);
            $table->string('status');
            $table->string('released_by');          
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
        Schema::dropIfExists('od_expense');
    }
}
