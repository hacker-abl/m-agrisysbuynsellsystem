<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CashHistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getDate = Carbon::now();

        $data = array(
            array(
                'id' => 1,
                'user_id' => 1,
                'trans_no' => $getDate->year.$getDate->month.$getDate->day.'1',
                'previous_cash' => 0,
                'total_cash' => 0,
                'type' => 'Add Cash',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            )
        );

        DB::table('cash_histories')->insert($data);
    }
}
