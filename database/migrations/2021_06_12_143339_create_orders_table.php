<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
             Schema::create('orders', function (Blueprint $table) {
     //$table->id();
            //$table->timestamps();
            
            // Create auto increment integer primary key
            $table->bigIncrements('orderid');
            
            // Create a string column for vehicle registration number
            $table->string('custid', 10);
            
            // Create a 3 characters column for vehicle registration state
            $table->string('receid', 10);
            // Create a string column for vehicle brand

            // Create a integer column for vehicle manufactured year
            $table->string('receCompanyname', 255);

            $table->string('recename', 255);

            // Create a integer column for customer phone
            $table->string('recephone',15);

             // Create a string column for vehicle model
            $table->string('recepostcode', 4);
            
            $table->string('receaddress', 255);
            
            // Create a string column for customer name
            $table->string('custname', 255);
            
            // Create a integer column for customer phone
            $table->string('custphone');
                    
            
            // Create a string column for vehicle model
            $table->string('custpostcode', 4);
            
            $table->string('custaddress', 255); 
            
             // Create a string column for vehicle model
         
             $table->integer('tax');

             $table->string('paymemt',40);
             $table->string('cardtype',40);
             $table->string('vaDate',40);

             $table->integer('totalweight');

             $table->string('cardnum',40);
            // Create a nullable double for the order total cost
            $table->double('totalcost', 10, 2)->nullable();
            
            // Create a nullable double for the order total amount
            $table->double('totalamount', 10, 2)->nullable();
            
            // Create a nullable datetime column for order created date
            $table->dateTime('createddate', 0)->nullable();
            
            // Create a nullable datetime column for order finalized date
            $table->dateTime('finalizeddate', 0)->nullable();
            
            // Create a integer column for order status
            $table->integer('orderstatus')->default(0);
            
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
