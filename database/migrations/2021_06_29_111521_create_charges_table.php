<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
              //   $table->id();
          //  $table->timestamps();
                // Create auto increment integer primary key
                $table->bigIncrements('chargeid');
                $table->string('shiptype', 255);
                // Create a string column for order item description
                $table->string('shiparea', 255);
                $table->double('shipweight', 10, 2);
                // Create a double for the order item cost
                $table->double('shipfee', 10, 2);
                
               // Create both nullable created at and updated at columns to store the created and last updated time stamp
                $table->timestamps(0);
                
                // Create column orderid as foreign key of order
           //     $table->unsignedBigInteger('orderid');
                
                // Create foreign key index
            //    $table->foreign('orderid')->references('orderid')->on('orders');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charges');
    }
}
