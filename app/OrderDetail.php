<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails'; // Define the table name
    protected $primaryKey = "detailid";
    public $incrementing = false;
    protected $fillable = ['itemHamoCode', 'desc','itemQty', 'cost', 'price', 'weight',' created_at','updated_at'];
    
    // Retrieve the order that belongs to the order detail
    public function order()
    {
        return $this->belongsTo('App\Order', 'orderid');
    }
}
