<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeCasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_cas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employee')
                    ->onDelete('cascade');
            $table->string('reason');
            $table->decimal('amount', 14,2);
            $table->decimal('balance', 14,2);
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
        Schema::dropIfExists('employee_cas');
    }
}
