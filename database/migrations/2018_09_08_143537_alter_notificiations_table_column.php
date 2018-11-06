<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNotificiationsTableColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table){
            $table->unsignedInteger('cash_advance_id')->nullable()->change();
            $table->unsignedInteger('expense_id')->nullable()->after('cash_advance_id');
            $table->foreign('expense_id')->references('id')->on('expenses')->onDelete('cascade');;
            $table->unsignedInteger('trip_expense_id')->nullable()->after('cash_advance_id');
            $table->foreign('trip_expense_id')->references('id')->on('trip_expense')->onDelete('cascade');;
            $table->unsignedInteger('dtr_expense_id')->nullable()->after('cash_advance_id');
            $table->foreign('dtr_expense_id')->references('id')->on('dtr_expense')->onDelete('cascade');;
            $table->string('table_source')->after('cashier_id');
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
            $table->dropForeign(['expense_id']);
            $table->dropForeign(['trip_expense_id']);
            $table->dropForeign(['dtr_expense_id']);
            $table->dropColumn('expense_id');
            $table->dropColumn('trip_expense_id');
            $table->dropColumn('dtr_expense_id');
            $table->dropColumn('table_source');
        });
    }
}
