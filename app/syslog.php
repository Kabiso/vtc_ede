<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class syslog extends Model
{
    protected $table = 'syslog'; // Define the table name
    protected $primaryKey = "syslogid";
    public $incrementing = false;
    protected $fillable = ['userid', 'oid','username','actioncode','action'];
    
   
  
}
