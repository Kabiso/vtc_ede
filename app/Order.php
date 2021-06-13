<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders'; // Define the table name
    protected $primaryKey = 'orderid'; // Define the primary key column name
    public $timestamps = false; // Disable Eloquent timestamps function
    protected $fillable = ['custid', 'receid', 'receCompanyname', 'recename', 'recephone', 'recepostcode', 'receaddress', 'custname', 'custphone', 'custpostcode','custaddress','tax','paymemt','cardtype','vaDate','totalweight','cardnum','totalcost','totalamount','createddate','finalizeddate','orderstatus']; // Mass assignment white-list
    
    // Retrieve the order details of the order
public function orderdetails()
{
        return $this->hasMany('App\OrderDetail', 'orderid', 'orderid');
}

public function booking()
{
        return $this->hasMany('App\Booking', 'orderid', 'orderid');
}

}
