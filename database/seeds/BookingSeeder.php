<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 10; $i++) {
            DB::table('booking')->insert([
                'location' => Str::random(50),
                'bookingtime' => Carbon::create('2000', '01', '01') ,
               
                'orderid' => rand(1,10)

            ]);
        
    }
}
}