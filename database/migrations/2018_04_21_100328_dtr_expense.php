<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DtrExpense extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr_expense', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dtr_id')->unsigned();
            $table->foreign('dtr_id')
                    ->references('id')
                    ->on('dtr')
                    ->onDelete('cascade');
            $table->string('description');
            $table->string('type');
            $table->decimal('amount');
            $table->string('status');
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
        Schema::dropIfExists('dtr_expense');
    }
}
