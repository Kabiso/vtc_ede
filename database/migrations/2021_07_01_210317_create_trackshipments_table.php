<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackshipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackshipments', function (Blueprint $table) {
            $table->id();
            $table->integer('orderid')->nullable();
            $table->string('status')->nullable();
            $table->string('location', 255)->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('trackshipments');
    }
}