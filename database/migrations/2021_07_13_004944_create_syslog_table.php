<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyslogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syslog', function (Blueprint $table) {
          
                       $table->bigIncrements('syslogid');
                   
                       // Create a string column for order item description
                       $table->string('userid', 20);

                       $table->string('oid', 20)->nullable();

                       // Create a double for the order item cost
                       $table->string('username', 255);
                      
                       $table->string('actioncode', 255);

                       $table->string('action', 255);
                       
                      // Create both nullable created at and updated at columns to store the created and last updated time stamp
                       $table->timestamps(0);
                       
                       // Create column orderid as foreign key of order
                                
               
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syslog');
    }
}
