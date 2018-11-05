<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
                'role' => 'CASHIER',
                'rate' => 52.5
            ),
            array(
                'role' => 'DRIVER',
                'rate' => 33.5
            ),
            array(
                'role' => 'LABOR',
                'rate' => 33.5
            ),
            array(
                'role' => 'MANAGER',
                'rate' => 70
            ),
            array(
                'role' => 'SECRETARY',
                'rate' => 380
            ),
            array(
                'role' => 'WEIGHER',
                'rate' => 52.5
            )
        );

        DB::table('roles')->insert($data);
    }
}
