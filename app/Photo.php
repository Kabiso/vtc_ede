<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos'; // Define the table name
    protected $primaryKey = "id";
    public $incrementing = false;
    protected $fillable = ['photo_name'];

      // Retrieve the order that belongs to the order detail
      public function order()
      {
      return $this->belongsTo('App\Order', 'orderid');
      //    return $this->hasMany('App\Order', 'orderid', 'orderid');
  }
}
