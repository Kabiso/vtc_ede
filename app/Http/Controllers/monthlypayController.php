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

        $matchThese = ['paymemt' => 'Monthly Pay', 'custid' => $user_id];

        $order = Order::Where($matchThese)->orderBy('orderid', 'desc')->paginate(15);

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
        return redirect("viewOrderDetail/$order->orderid")->with('message', 'Payment Settled');
    }


    public function staffview()
    {
        $this->authorize('acct');
        $order = Order::Where('paymemt', 'Monthly Pay')->orderBy('orderid', 'desc')->paginate(15);

        return view('staff.viewMonthlypay')->with('orders', $order);
    }


    public function paymentconfirm(Order $order)
    {

        $order->paymentstatus = 'Paid';
        $order->save();
        return redirect("staff/viewMonPay")->with('message', 'Payment Confirmed');
    }


    public function searchdate(Request $request)
    {
        
        $user_id = Auth::user()->id;

        $matchThese = ['paymemt' => 'Monthly Pay', 'custid' => $user_id ];

        if($request->ajax())
        {
        
        $date = $request->get('date');

        


        $orders = Order::Where($matchThese)->where('createddate','like',$date.'%')->get();
        $totalorder = $orders->count();
        $paidorder = Order::Where($matchThese)->where('createddate','like',$date.'%')->where('paymentstatus', 'Paid')->count();
        $totalshipfee = Order::Where($matchThese)->where('createddate','like',$date.'%')->sum('shipfee');
        $output = "";
       foreach($orders as $order)
       {
        $output .= '
        <tr>
        <td>'.$order->paymentstatus.'</td>
         <td>'.$order->orderid.'</td>
         <td>'.$order->createddate->format("Y/m/d").'</td>
         <td>'.$order->shipfee.'</td>
         <td><a class="btn btn-info text-white" href="/viewOrderDetail/'.$order->orderid.'"  >View Order</a></td>
         <td><a class="btn btn-success text-white" href="#" >View Order Invoice</a></td>
         </tr>
        ';
    
        }
        $data = array(
            'output' => $output,
            'totalshipfee' => $totalshipfee,
            'showbtnflag'=> $totalorder - $paidorder

    
        );
       
        echo json_encode($data);

        }
    }

    public function invoice ($month)
    {
        $user_id = Auth::user()->id;

        $matchThese = ['paymemt' => 'Monthly Pay', 'custid' => $user_id ];

        $order = Order::Where($matchThese)->where('createddate','like',$month.'%')->get();

        return view('invoicemonthly')->with('order', $order);
    }
}
