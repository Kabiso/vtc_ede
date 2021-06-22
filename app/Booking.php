<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $table = 'booking'; // Define the table name
    protected $primaryKey = "bookingid";
    public $incrementing = false;
    protected $fillable = ['location', 'bookingtime'];
    
    // Retrieve the order that belongs to the order detail
    public function order()
    {
        return $this->belongsTo('App\Order', 'orderid');
}



}