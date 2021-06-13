<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
         //   $table->id();
          //  $table->timestamps();
                // Create auto increment integer primary key
                $table->bigIncrements('bookingid');
            
                // Create a string column for order item description
                $table->string('location', 255);
                
                // Create a double for the order item cost
                $table->dateTime('bookingtime');
                
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
        Schema::dropIfExists('booking');
    }
}
