<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class charges extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('charges')->insert([
            'shiptype' => 'GC',
            'shiparea' => 'ALL',
            'shipweight' => 0.5,
            'shipfee' => 158,
        ]);

        DB::table('charges')->insert([
            'shiptype' => 'GC',
            'shiparea' => 'ALL',
            'shipweight' => 1.0,
            'shipfee' => 308,
        ]);




        DB::table('charges')->insert([
            'shiptype' => 'GC',
            'shiparea' => 'ALL',
            'shipweight' => 1.5,
            'shipfee' => 458,
        ]);

        DB::table('charges')->insert([
            'shiptype' => 'GC',
            'shiparea' => 'ALL',
            'shipweight' => 2.0,
            'shipfee' => 608,
        ]);

        DB::table('charges')->insert([
            'shiptype' => 'GC',
            'shiparea' => 'ALL',
            'shipweight' => 2.5,
            'shipfee' => 758,
        ]);

        DB::table('charges')->insert([
            'shiptype' => 'GC',
            'shiparea' => 'ALL',
            'shipweight' => 3.0,
            'shipfee' => 908,
        ]);

        //3-15


        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'AUSTRALIA',
            'shipweight' => 15,
            'shipfee' => 75,

        ]);


        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'JAPAN',
            'shipweight' => 15,
            'shipfee' => 75,

        ]);



        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'CHINA',
            'shipweight' => 15,
            'shipfee' => 45,

        ]);







        //16-29

        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'AUSTRALIA',
            'shipweight' => 29,
            'shipfee' => 70,

        ]);


        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'JAPAN',
            'shipweight' => 29,
            'shipfee' => 70,

        ]);



        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'CHINA',
            'shipweight' => 29,
            'shipfee' => 40,

        ]);


        //30-44

        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'AUSTRALIA',
            'shipweight' => 44,
            'shipfee' => 65,

        ]);


        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'JAPAN',
            'shipweight' => 44,
            'shipfee' => 65,

        ]);



        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'CHINA',
            'shipweight' => 44,
            'shipfee' => 37,

        ]);


        //45-69

        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'AUSTRALIA',
            'shipweight' => 69,
            'shipfee' => 62,

        ]);


        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'JAPAN',
            'shipweight' => 69,
            'shipfee' => 62,

        ]);



        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'CHINA',
            'shipweight' => 69,
            'shipfee' => 35,

        ]);




        //70-99

        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'AUSTRALIA',
            'shipweight' => 99,
            'shipfee' => 61,

        ]);


        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'JAPAN',
            'shipweight' => 99,
            'shipfee' => 61,

        ]);



        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'CHINA',
            'shipweight' => 99,
            'shipfee' => 33,

        ]);


        //100-499

        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'AUSTRALIA',
            'shipweight' => 499,
            'shipfee' => 58,

        ]);


        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'JAPAN',
            'shipweight' => 499,
            'shipfee' => 58,

        ]);



        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'CHINA',
            'shipweight' => 499,
            'shipfee' => 32,

        ]);


        //500-999

        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'AUSTRALIA',
            'shipweight' => 500,
            'shipfee' => 58,

        ]);


        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'JAPAN',
            'shipweight' => 500,
            'shipfee' => 58,

        ]);



        DB::table('charges')->insert([
            'shiptype' => 'EF',
            'shiparea' => 'CHINA',
            'shipweight' => 500,
            'shipfee' => 32,

        ]);
    }
}
