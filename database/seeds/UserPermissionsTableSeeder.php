<?php

use Illuminate\Database\Seeder;

class UserPermissionsTableSeeder extends Seeder
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
                'user_id' => '2',
                'permission_id' => '1',
                'permit' => 1
            ),
            array(
                'user_id' => '2',
                'permission_id' => '2',
                'permit' => 1
            ),
            array(
                'user_id' => '2',
                'permission_id' => '3',
                'permit' => 1
            ),
            array(
                'user_id' => '2',
                'permission_id' => '4',
                'permit' => 1
            ),
            array(
                'user_id' => '2',
                'permission_id' => '5',
                'permit' => 1
            ),
            array(
                'user_id' => '2',
                'permission_id' => '6',
                'permit' => 1
            ),
            array(
                'user_id' => '2',
                'permission_id' => '7',
                'permit' => 1
            )
        );
        
        DB::table('user_permissions')->insert($data);
    }
}
