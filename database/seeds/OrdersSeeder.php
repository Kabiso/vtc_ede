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
            'custarea'=>Str::random(30),
            'recearea'=>Str::random(30),
            'recepostcode'=>Str::random(4),
            'receaddress'=>Str::random(30),
            'custname'=> Str::random(15),
            'custphone' =>rand(88888888, 99999999),
            'custpostcode'=>Str::random(4),
            'custaddress'=>Str::random(30),
            'custarea'=>Str::random(30),
           'remark'=> Str::random(30),
             'tax'=> rand(2000, 3000),
                'paymemt'=>Str::random(30),
                'cardtype'=>Str::random(30),
                'cardnum' =>Str::random(30),
                'chequednum'=>Str::random(30),
                'vaDate'=>Str::random(30),
                'paymentstatus' => Str::random(15),
                'totalweight'=> rand(1000, 4000),
                'totalqty' =>rand(1000, 5000),
                'totalcost' =>rand(1000, 5000),
                'totalamount' =>rand(4000, 9000),
                'shiptype' => Str::random(20),
                'shipfee' => rand(1000, 4000),
                'shipcountries' => Str::random(10),
                'orderstatus' => 'Ready for delivery',
 
    ]);
}

        
    }
}
