<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'customer';
    protected $fillable = [
        'custname',
        'email',
        'password',
        'contactNo',
        'creditLimit',
        'custGender',
        'custAddress'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
       
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function Order()
    {
       return $this->hasMany(Order::class);      
    }
   
    
}
