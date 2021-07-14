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
use App\Trackshipment;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Mail;
use App\syslog;

class staffOrderController extends Controller
{
    
    public function view()
    {
        $orders = Order::orderBy('orderid','desc')->paginate(10);

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

//send email
        Mail::send('emails.post', $data, function($message)use ($to) {
    
         $message->to($to['email'], $to['name'])->subject('Order Complete');
        });

        }

//Delivered
        if( $request['status'] == 'Delivered')
        {
            $data = 
            [
            'orderid'=>$order->orderid,
            'recename'=>$order->recename
            ];

            $to =[ 
                
             'email' =>  Order::find($order->orderid)->receEmail,
            'name' =>$order->recename
            ];

//send email
        Mail::send('emails.delivered', $data, function($message)use ($to) {
    
         $message->to($to['email'], $to['name'])->subject('Order Delivered');
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
            $user_id = Auth::user()->id;
            $user_name1 = Auth::user()->custname;
            $user_name2 = Auth::user()->stfName;
            if(isset( $user_name1)){
        
               $user_name = $user_name1;
            }else{
              $user_name =$user_name2;
            }
        
                    
                     
                   
        
                    syslog::create([
                        'userid' =>   $user_id,
                        'username' => $user_name ,
                        'oid' => $booking->bookingid,
                        'action' => "Booking updated,staffOrderController.updatebookingr",
                        'actioncode' => '3',
                       
                
                
                    ]);
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
           'receEmail' => ['required', 'string', 'max:255'],
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
                'receEmail.required' => 'Please input the Receiver Email',
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
            $order->receEmail = $request->receEmail;
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
            $order->acceptanceTime =   $request->acceptanceTime;
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
                $orderdetail = $order->orderdetails;
                if ($itemHamoCodes[$item] != '') {
                    
                    $orderdetail[$item]->itemHamoCode = $itemHamoCodes[$item];
                    $orderdetail[$item]->desc = $descs[$item];
                    $orderdetail[$item]->itemQty = $itemQtys[$item];
                    $orderdetail[$item]->cost = $costs[$item];
                    $orderdetail[$item]->price = $prices[$item];
                    $orderdetail[$item]->weight = $weights[$item];
                    $orderdetail[$item]->linecost = $linecosts[$item];
                    $orderdetail[$item]->lineprice = $lineprices[$item];
                    $orderdetail[$item]->lineweight = $lineweights[$item];
                    $order->orderdetails()->save($orderdetail[$item]);
                }
            }
        }
            
        if($request->status != null || $request->status != ""){
            Trackshipment::create([
                'orderid' => $order->orderid,
                'status' => $request->status,
                'location' => $request->location,
               
        
        
            ]);
            $user_id = Auth::user()->id;
            $user_name1 = Auth::user()->custname;
            $user_name2 = Auth::user()->stfName;
            if(isset( $user_name1)){
        
               $user_name = $user_name1;
            }else{
              $user_name =$user_name2;
            }
        
                    
                     
                   
        
                    syslog::create([
                        'userid' =>   $user_id,
                        'username' => $user_name ,
                        'oid' => $order->orderid,
                        'action' => "Order updated,$request->status, OrderController.updateorder",
                        'actioncode' => '3',
                       
                
                
                    ]);
            
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

//send email
                Mail::send('emails.post', $data, function($message)use ($to) {
            
                $message->to($to['email'], $to['name'])->subject('Order Complete');
                });

            }

//Delivered
            if( $request['status'] == 'Delivered')
            {
                    $data = 
                    [
                    'orderid'=>$order->orderid,
                    'recename'=>$order->recename
                    ];

                    $to =[ 
                        
                    'email' =>  Order::find($order->orderid)->receEmail,
                    'name' =>$order->recename
                    ];
            
//send email
            Mail::send('emails.delivered', $data, function($message)use ($to) {
        
            $message->to($to['email'], $to['name'])->subject('Order Delivered');
            });

            }
        }   
        return redirect('/staff/orderindex')->with('message', 'Order is Updated!');  
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
           
           $detail= User::where('id',$request->search)->first();
            
            $data=array(
                'cname' => $detail->custname,
                'cphone' => $detail->contactNo,
                'caddress' => $detail->custAddress

            );
            
            return Response($data);
           
        }
    }

}

