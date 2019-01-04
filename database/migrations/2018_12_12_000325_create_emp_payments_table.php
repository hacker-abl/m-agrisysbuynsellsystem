<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('logs_id')->unsigned();
            $table->foreign('logs_id')
                ->references('id')
                ->on('employee')
                ->onDelete('cascade');
            $table->string('paymentmethod');
            $table->string('checknumber');
            $table->integer('paymentamount');
            $table->string('remarks')->nullable();
            $table->integer('r_balance');
            $table->integer('dtr_id')->nullable();
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
        Schema::dropIfExists('emp_payments');
    }
}
