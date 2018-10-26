<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
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
            //     'name' => 'Expenses',
            //     'middleware' => 'expenses',
            //     'icon' => 'show_cart',
            //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            // ),
            // array(
            //     'name' => 'Trips',
            //     'middleware' => 'trips',
            //     'icon' => 'directions_bus',
            //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            // ),
            // array(
            //     'name' => 'Daily Time Record',
            //     'middleware' => 'dtr',
            //     'icon' => 'access_time',
            //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            // ),
            // array(
            //     'name' => 'Outbound Deliveries',
            //     'middleware' => 'od',
            //     'icon' => 'arrow_upward',
            //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            // ),
            // array(
            //     'name' => 'Cash Advance',
            //     'middleware' => 'ca',
            //     'icon' => 'monetization_on',
            //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            // ),
            // array(
            //     'name' => 'Purchases',
            //     'middleware' => 'purchases',
            //     'icon' => 'bookmark_border',
            //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            // ),
            // array(
            //     'name' => 'Sales',
            //     'middleware' => 'sales',
            //     'icon' => 'shopping_cart',
            //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            // ),
            array(
                'name' => 'Company',
                'middleware' => 'manage_company',
                'icon' => 'business',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ),
            array(
                'name' => 'Employee',
                'middleware' => 'manage_employee',
                'icon' => 'supervisor_account',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ),
            array(
                'name' => 'Customer',
                'middleware' => 'manage_customer',
                'icon' => 'tag_faces',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ),
            array(
                'name' => 'Trucks',
                'middleware' => 'manage_trucks',
                'icon' => 'local_shipping',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ),
            array(
                'name' => 'Commodity',
                'middleware' => 'manage_commodity',
                'icon' => 'receipt',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            )
        );

        DB::table('permissions')->insert($data);
    }
}
