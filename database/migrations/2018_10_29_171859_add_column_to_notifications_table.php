<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table){
            $table->integer('od_expense_id')->unsigned()->nullable()->after('expense_id');
            $table->foreign('od_expense_id')
                ->references('id')
                ->on('od_expense')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table){
            $table->dropForeign(['od_expense_id']);
            $table->dropColumn('od_expense_id');
        });
    }
}
