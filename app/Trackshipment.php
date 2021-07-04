<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trackshipment extends Model
{
    protected $table = 'trackshipments'; // Define the table name
    protected $primaryKey = "id";
    public $incrementing = false;
    protected $fillable = ['orderid', 'status', 'location'];

    // Retrieve the order that belongs to the order detail
    public function order()
    {
        return $this->belongsTo('App\Order', 'orderid');
    }
}
