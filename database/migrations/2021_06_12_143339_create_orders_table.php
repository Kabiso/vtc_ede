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
            $table->unsignedBigInteger('custid');
            $table->unsignedBigInteger('created_by');
       

            // Create a string column for customer name
             $table->string('custname', 255);
            
            // Create a integer column for customer phone
             $table->string('custphone',20);
                         
                 
            // Create a string column for vehicle model
             $table->string('custpostcode', 4);
                 
             $table->string('custaddress', 255); 

             $table->string('custarea', 255)->nullable();
            // Create a 3 characters column for vehicle registration state
            $table->string('receid', 10)->nullable();
            // Create a string column for vehicle brand

            // Create a integer column for vehicle manufactured year
            $table->string('receCompanyname', 255);

            $table->string('recename', 255);

            $table->string('receEmail', 255);

            // Create a integer column for customer phone
            $table->string('recephone',15);

             // Create a string column for vehicle model
            $table->string('recepostcode', 4);
            
            $table->string('receaddress', 255);
            
            $table->string('recearea', 255)->nullable();
            
             // Create a string column for vehicle model
         
             $table->integer('tax')->nullable();

             $table->string('paymemt',255);
             $table->string('cardtype',255)->nullable();
             $table->string('vaDate',40)->nullable();

             $table->integer('totalweight');

             $table->string('cardnum',40)->nullable();
             $table->string('chequednum',40)->nullable();   

             $table->string('shiptype', 255);
             $table->string('shipcountries',255);
             $table->double('shipfee', 10, 2)->nullable();
             $table->string('paymentstatus',255);
             
             $table->double('totalqty', 10, 2)->nullable();
            // Create a nullable double for the order total cost
            $table->double('totalcost', 10, 2)->nullable();
            
            // Create a nullable double for the order total amount
            $table->double('totalamount', 10, 2)->nullable();
            
            // Create a nullable datetime column for order created date
            $table->dateTime('createddate', 0)->nullable();
            $table->string('remark', 255)->nullable();
            // Create a nullable datetime column for order finalized date
            $table->dateTime('finalizeddate', 0)->nullable();
            
           
            $table->dateTime('acceptanceTime')->nullable();


            $table->foreign('custid')->references('id')->on('customer');
            $table->foreign('created_by')->references('id')->on('staff');
            $table->string('checkcom',5)->nullable();;
            $table->string('trackshipment',255)->nullable();;
            $table->string('ordertype',20)->nullable();;




            
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
