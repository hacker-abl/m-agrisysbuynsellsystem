<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dtr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employee')
                    ->onDelete('cascade');
            $table->string('role');
            $table->decimal('overtime');
            $table->decimal('num_hours');
            $table->decimal('rate', 14,2);
            $table->decimal('salary');
            $table->decimal('dtr_balance');
            $table->decimal('r_balance');
            $table->decimal('p_payment');
            $table->decimal('bonus');
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
        Schema::dropIfExists('dtr');
    }
}
