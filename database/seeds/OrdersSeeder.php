<?php

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
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
    DB::table('orders')->insert([
              'custid'=> Str::random(10),
              'receid'=> Str::random(10),
            'receCompanyname'=> Str::random(30),
            'recename'=> Str::random(15),
            'recephone' =>rand(88888888, 99999999),
            'recepostcode'=>Str::random(4),
            'receaddress'=>Str::random(30),
            'custname'=> Str::random(15),
            'custphone' =>rand(88888888, 99999999),
            'custpostcode'=>Str::random(4),
            'custaddress'=>Str::random(30),
                'tax'=> rand(2000, 3000),
                'paymemt'=>Str::random(30),
                'cardtype'=>Str::random(30),
                'vaDate'=>Str::random(30),
                'totalweight'=> rand(1000, 4000),
                'cardnum' =>Str::random(30),
                'totalcost' =>rand(1000, 5000),
                'totalamount' =>rand(4000, 9000),
                'orderstatus' => 0,
 
    ]);
}

        
    }
}
