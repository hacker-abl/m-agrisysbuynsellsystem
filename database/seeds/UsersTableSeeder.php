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
            // array(
            //     'name' => 'Admin BFJAX',
            //     'username' => 'admin',
            //     'access_id' => 1,
            //     'password' => bcrypt('password'),
            //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            // ),
            array(
                'name' => 'Cashier BFJAX',
                'username' => 'cashier',
                'access_id' => 2,
                'password' => bcrypt('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            )
        );

        DB::table('users')->insert($data);
    }
}
