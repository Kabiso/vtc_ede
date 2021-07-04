<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class charges extends Model
{
    protected $table = 'charges'; // Define the table name
    protected $primaryKey = "chargeid";
    public $incrementing = false;
    protected $fillable = ['shiptype', 'shiparea','shipwieght','shiptfee'];
    
    // Retrieve the order that belongs to the order detail
 
}