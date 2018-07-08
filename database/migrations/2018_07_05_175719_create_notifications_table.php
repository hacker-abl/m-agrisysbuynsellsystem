<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('notification_type')->default('request');
            $table->string('message');
            $table->string('status');
            $table->integer('admin_id')->unsigned();
            $table->integer('cashier_id')->nullable()->unsigned();
            $table->integer('cash_advance_id')->unsigned();
            $table->foreign('admin_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('cashier_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('cash_advance_id')
                ->references('id')
                ->on('cash_advance')
                ->onDelete('cascade');
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
        Schema::dropIfExists('notifications');
    }
}
