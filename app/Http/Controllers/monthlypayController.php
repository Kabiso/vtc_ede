<?php

namespace App\Http\Controllers;
use app\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class monthlypayController extends Controller
{
    public function view(User $user)
    {
        $user_id = Auth::user()->id;

        $matchThese = ['orderstatus' => '0', 'custid' => $user_id];

        $order = Order::Where($matchThese)->orderBy('orderid','desc')->paginate(15);

        return view('monthly')->with('orders', $order);
            
        
        
    }

}
