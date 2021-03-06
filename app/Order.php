<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders'; // Define the table name
    protected $primaryKey = 'orderid'; // Define the primary key column name
    public $timestamps = false; // Disable Eloquent timestamps function
    protected $dates = ['createddate'];
    protected $fillable = ['custid','created_by','custarea', 'receid','recearea', 'receCompanyname', 'recename','receEmail', 'recephone', 'recepostcode','remark', 'receaddress', 'custname', 'custphone', 'custpostcode','custaddress','tax','paymemt','cardtype','vaDate','totalweight','cardnum','totalcost','totalqty','totalamount','createddate','shiptype','shipfee','shipcountries','chequednum','finalizeddate','paymentstatus','acceptanceTime','checkcom','trackshipment','ordertype']; // Mass assignment white-list
    
    // Retrieve the order details of the order
public function orderdetails()
{
        return $this->hasMany('App\OrderDetail', 'orderid', 'orderid');
}

public function booking()
{
        return $this->hasMany('App\Booking', 'orderid', 'orderid');
}


public function Photo()
{
return $this->hasMany('App\Photo', 'orderid', 'orderid');
//    return $this->hasMany('App\Order', 'orderid', 'orderid');
}


}
