<?php

use Illuminate\Database\Seeder;

class jobtitle extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('jobtitles')->insert([
            'title' => 'System Admin',
            'salary' => '0',
        ]);

        DB::table('jobtitles')->insert([
            'title' => 'Operations Manager',
            'salary' => '30000',
        ]);

        DB::table('jobtitles')->insert([
            'title' => 'Operations Supervisor',
            'salary' => '15000',
        ]);

        DB::table('jobtitles')->insert([
            'title' => 'Account Executive',
            'salary' => '10000',
        ]);

        DB::table('jobtitles')->insert([
            'title' => 'Booking Clerk',
            'salary' => '8000',
        ]);

        DB::table('jobtitles')->insert([
            'title' => 'Shipment Clerk',
            'salary' => '8000',
        ]);

        DB::table('jobtitles')->insert([
            'title' => 'Van Driver',
            'salary' => '8000',
        ]);
    }
}
