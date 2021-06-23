<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;
use App\OrderDetail;
use App\Booking;
use App\User;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Mail;


class staffOrderController extends Controller
{
    
    public function view()
    {
        $orders = Order::orderBy('orderid','desc')->paginate(15);

        return View::make('staff.orderindex')->with('orders', $orders);
    }

    public function edit(Order $order)
    {   
        
        return View::make('staff.editorder')->with('order',$order);
    }

    public function changestatus(request $request, Order $order)
    {
        $data = request()->validate([

            'status' => ['required', 'string', 'max:255']
            
        ]);

       


        $order->orderstatus = $request['status'];
        
        $order->save();


        if( $request['status'] == 'Complete')
        {
            $data = 
            [
            'orderid'=>$order->orderid,
            'custname'=>$order->custname
            ];

            $to =[ 
                
             'email' =>  user::find($order->custid)->email,
            'name' =>$order->custname
            ];

//寄出信件
        Mail::send('emails.post', $data, function($message)use ($to) {
    
         $message->to($to['email'], $to['name'])->subject('Order Complete');
        });

        }



        return back()->with('message', 'Order status is Updated!');
    }

    public function viewbooking()
    {
        $bookings = Booking::orderBy('bookingid','desc')->paginate(15);
        return View::make('staff.viewbooking')->with('bookings',$bookings);
    }


    public function editbooking(booking $booking)
    {
        return View::make('staff.editbooking')->with('booking',$booking);
    }


    public function updatebooking(request $request, booking $booking)
    {
            
            $booking->location = $request->location;
            $booking->bookingtime = $request->bookingtime;
            $booking->save();
        
        return redirect('staff/viewbooking')->with('message', 'Pickup Booking is Updated!');  
    }

    public function updateorder(Request $request, order $order)
    {
        $input = $request->all();

        // Create validation rules, please refer to https://laravel.com/docs/7.x/validation#available-validationrules for more details
        $rules = array(
      
           //customer   
           'custid' => 'required',
           'custname' => ['required', 'string', 'max:255'],
           'custpostcode' => ['required', 'max:4'],
           'custaddress' => ['required', 'max:255'],
          
          //Receiver
           'receCompanyname' =>  ['required', 'max:255'],
           'recename' => ['required', 'string', 'max:255'],
           'recephone' =>  ['required', 'max:255'],
           'recepostcode' => ['required', 'max:4'],
           'receaddress' => ['required', 'max:255'],
           
           //payment
            'paymemt' => 'required',
            'totalweight' => 'required|numeric',
            'totalcost' => 'required|numeric',
           'totalamount' => 'required|numeric',
  
          //shipment 
           'shiptype' => 'required',
           'shipcountries' => 'required',
           'paymentstatus' => 'required',
  
  
           //shipment details
         
   //           'descs' => 'required',
   //           '$itemQtys'=>'required',
   //           'costs'      =>'required',
  //            'prices'     =>'required',
   //           'weights'     =>'required',
         
          );
  
          $messages = [
              //customer   
              'custid.required' => 'Please input the Customer ID',
              'custname.required' => 'Please input the Customer Name',
              'custpostcode.required'  => 'Please input the Customer Post Code',
              'custaddress.required' => 'Please input the Customer Address',
              
                  
               //Receiver
              'receCompanyname.required' => 'Please input the Receiver Company Name',
                'recename.required' => 'Please input the Receiver Name',
                'recephone.required' => 'Please input the Receiver Phone',
                'recepostcode.required' => 'Please input the Receiver Post Code',
                'receaddress.required' => 'Please input the Receiver Address',
  
             //shipment 
                'paymemt.required' =>  'Please select the Paymemt Method',
                'totalweight.numeric' =>  'Please input Total Weight',
                'totalcost.numeric' =>  'Please input the Total Cost',
  
  
                 //shipment details
            
            //  'descs.required'  =>  'Please input the full description',
          //    '$itemQtys.required' =>'Please input the No of Qty',
         //     'costs.required'      =>'Please input the Unit cost',
       //       'prices.required'     =>'Please input the Unit price',
      //        'weights.required'    =>'Please input the Unit weigth',
           
          ];
        

        $validator = Validator::make($input, $rules, $messages );
        // Perform insert order action when validation pass or return to the index page if validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            // Create a Order instance and configure the values before insert action
            
            $order->custid = $request->custid;
            $order->custarea = $request->custarea;
            $order->receid = $request->receid;
            $order->recearea = $request->recearea;
            $order->receCompanyname = $request->receCompanyname;
            $order->recename = $request->recename;
            $order->recephone = $request->recephone;
            $order->recepostcode = $request->recepostcode;
            $order->receaddress = $request->receaddress;
            $order->custname = $request->custname;
            $order->custphone = $request->custphone;
            $order->custpostcode = $request->custpostcode;
            $order->custaddress = $request->custaddress;
            $order->tax = $request->tax;
            $order->paymemt =  $request->paymemt;
            $order->cardtype =  $request->cardtype;
            $order->vaDate = $request->vaDate;
            $order->chequednum = $request->chequednum;
            $order->shiptype = $request->shiptype;
            $order->shipcountries = $request->shipcountries;
            $order->shipfee = $request->shipfee;

            $order->totalweight = $request->totalweight;
            $order->cardnum =  $request->cardnum;
            $order->totalqty =  $request->totalqty;
            $order->totalcost =  $request->totalcost;
            $order->totalamount =   $request->totalamount;
            $order->paymentstatus =   $request->paymentstatus;
            $order->remark =   $request->remark;
            $order->save();
   
            // Insert order item detail based on the inserted order
            $itemHamoCodes = $request->input('itemHamoCode', []);
            $descs = $request->input('desc', []);
            $itemQtys  = $request->input('itemQty', []);
            $costs = $request->input('cost', []);
            $linecosts = $request->input('linecost', []);
            $prices = $request->input('price', []);
            $lineprices = $request->input('lineprice', []);
            $weights = $request->input('weight', []);
            $lineweights = $request->input('lineweight', []);

            for ($item = 0; $item < count($itemHamoCodes); $item++) {
               $orderdetail = $order->orderdetails->first();
                if ($itemHamoCodes[$item] != '') {
                    $orderdetail->itemHamoCode = $itemHamoCodes[$item];
                    $orderdetail->desc = $descs[$item];
                    $orderdetail->itemQty = $itemQtys[$item];
                    $orderdetail->cost = $costs[$item];
                    $orderdetail->price = $prices[$item];
                    $orderdetail->weight = $weights[$item];
                    $orderdetail->linecost = $linecosts[$item];
                    $orderdetail->lineprice = $lineprices[$item];
                    $orderdetail->lineweight = $lineweights[$item];


                    $order->orderdetails()->save($orderdetail);
                }
            }
        }
      
        return redirect('/staff/orderindex')->with('message', 'Order is Updated!');  
    }
}
