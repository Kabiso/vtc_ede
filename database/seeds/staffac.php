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
            'stfName' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('123456789'),
            'stfConactNo' => rand(12345678, 999999999),
            'stfGender' => 'M',
            'jobtitles_id' =>'1',

        ]);
    }
}
