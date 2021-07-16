<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class staffac extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            'stfName' => 'System Admin',
            'email' => 'sys_admin@ede.com',
            'password' => Hash::make('123456789'),
            'stfConactNo' => '23232323',
            'stfGender' => 'M',
            'jobtitles_id' =>'1',

        ]);
        DB::table('staff')->insert([
            'stfName' => 'Online Customer',
            'email' => 'online_customer@ede.com',
            'password' => Hash::make('%$$^%and31'),
            'stfConactNo' => '00000000',
            'stfGender' => 'M',
            'jobtitles_id' => '99',

        ]);
    }
}
