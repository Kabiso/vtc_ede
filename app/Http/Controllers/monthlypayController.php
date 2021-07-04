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

        $matchThese = ['paymentstatus' => 'Waiting to Pay', 'custid' => $user_id];

        $order = Order::Where($matchThese)->orderBy('orderid','desc')->paginate(15);

        return view('monthly')->with('orders', $order);
            
        
        
    }


    public function settlepay(Order $order)
    {
        return view('settlepayment')->with('order', $order);
    }


    public function success(Order $order)
    {

        $order->paymentstatus = 'Paid';
        $order->save();
        return redirect("monthlypay")->with('message', 'Payment Settled');
    }


    public function staffview()
    {
        $this->authorize('acct');
        $order = Order::Where('paymentstatus','Waiting to Pay')->orderBy('orderid','desc')->paginate(15);   
        
        return view('staff.viewMonthlypay')->with('orders',$order);
    }


    public function paymentconfirm(Order $order)
    {

        $order->paymentstatus = 'Paid';
        $order->save();
        return redirect("staff/viewMonPay")->with('message', 'Payment Confirmed');
    }


    


}
