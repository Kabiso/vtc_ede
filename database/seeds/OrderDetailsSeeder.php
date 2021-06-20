<?php

use Illuminate\Database\Seeder;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 50; $i++) {
    DB::table('orderdetails')->insert([
        'itemHamoCode' => Str::random(10),
        'desc' => Str::random(10),
        'itemQty' => rand(10,20),
        'cost' => rand(200, 1000),
        'price' => rand(200, 1000),
        'weight' => rand(200, 1000),
        'linecost' => rand(200, 1000),
        'lineprice' => rand(200, 1000),
        'lineweight' => rand(200, 1000),
        'orderid' => rand(1,10)
    ]);
}

    }
}
