<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                Schema::create('orderdetails', function (Blueprint $table) {
            // Create auto increment integer primary key
            $table->bigIncrements('detailid');
            
            // Create a string column for order item description
            $table->string('itemHamoCode', 255);

            // Create a string column for order item description
             $table->string('desc',50);
                 // Create a string column for order item description
              $table->integer('itemQty');
            
            // Create a double for the order item cost
              // Create a double for the order item cost
              $table->double('cost', 10, 2);
              $table->double('linecost', 10, 2);
              // Create a double for the order item price
              $table->double('lineprice', 10, 2);
              $table->double('price', 10, 2);
               // Create a double for the order item price
               $table->double('lineweight', 10, 2);
               $table->double('weight', 10, 2);
              // Create both nullable created at and updated at columns to store the created and last updated time stamp
            // Create both nullable created at and updated at columns to store the created and last updated time stamp
            $table->timestamps(0);

             
            // Create column orderid as foreign key of order
            $table->unsignedBigInteger('orderid');
            
            // Create foreign key index
            $table->foreign('orderid')->references('orderid')->on('orders');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderdetails');
    }
}
