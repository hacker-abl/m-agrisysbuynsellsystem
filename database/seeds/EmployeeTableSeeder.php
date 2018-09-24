<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'fname' => 'Cashier',
                'mname' => 'mCashier',
                'lname' => 'BFJAX',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role_id' => 1
            )
        );

        DB::table('employee')->insert($data);
    }
}
