<?php

use Illuminate\Database\Seeder;

class BenefitsTableSeeder extends Seeder
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
                'name' => 'SSS', 
            ), 
            array(
                'name' => 'Philhealth', 
            ), 
            array(
                'name' => 'Pag-ibig', 
            ), 
        );

        DB::table('benefits')->insert($data);
    }
}