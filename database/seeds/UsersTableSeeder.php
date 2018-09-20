<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
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
                'username' => 'admin',
                'cashOnHand' => 0,
                'emp_id' => null,
                'name' => 'Admin BFJAX',
                'access_id' => 1,
                'password' => bcrypt('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ),
            array(
                'username' => 'cashier',
                'cashOnHand' => 0,
                'emp_id' => null,
                'name' => 'Cashier BFJAX',
                'access_id' => 2,
                'password' => bcrypt('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ),
        );

        DB::table('users')->insert($data);
    }
}
