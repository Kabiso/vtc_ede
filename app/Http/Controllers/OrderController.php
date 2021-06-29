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

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Retrieve all the orders
        $orders = Order::all();

        // Load the view and pass the retrieved orders to the view for further processing
        return View::make('orders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // Redirect the user to the create order view for order creation
        return View::make('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Get the submitted input
        $input = $request->all();

        // Create validation rules, please refer to https://laravel.com/docs/7.x/validation#available-validation-rules for more details
        $rules = array(
            'custid' => 'required',
            'receid' => 'required',
            'receCompanyname' => 'required',
            'recename' => 'required',
            'recephone' => 'required',
            'recepostcode' => 'required',
            'receaddress' => 'required',
            'custname' => 'required',
            'custphone' => 'required|numeric',
            'custpostcode' => 'required',
            'custaddress' => 'required',
            'tax' => 'required|numeric',
            'paymemt' => 'required',
            'cardtype' => 'required',
            'vaDate' => 'required',
            'totalweight' => 'required|numeric',
            'cardnum' => 'required',
            'totalcost' => 'required|numeric',
            'totalamount' => 'required|numeric'

        );

        // Create customized validation messages
        $messages = [
            'custid.required' => 'Please input the customer id',
            'receid.required' => 'Please input the receid',
            'receCompanyname.required' => 'Please input the receCompanyname',
            'recename.required' => 'Please input the recename',
            'recephone.numeric' => 'Please input the recephone',
            'recepostcode.required' => 'Please input the recepostcode',
            'receaddress.required' => 'Please input the receaddress',
            'custname.required' => 'Please input the custname',
            'tax.numeric' => 'Please input the tax',
            'serialno.required' => 'Please input the Vehicle Serial Nnumber',
            'custaddress.required' => 'Please input the Vehicle Serial Nnumber',
            'tax.numeric' =>  'Please input the Vehicle Serial Nnumber',
            'paymemt.required' =>  'Please input the Vehicle Serial Nnumber',
            'cardtype.required' =>  'Please input the Vehicle Serial Nnumber',
            'vaDate.required' =>  'Please input vaDate',
            'totalweight.numeric' =>  'Please input totalweight',
            'cardnum.required' =>  'Please input the cardnum',
            'totalcost.numeric' =>  'Please input the totalcost',
            'totalamount.numeric' =>  'Please input totalamount'




        ];

        $validator = Validator::make($input, $rules, $messages);

        // Perform insert order action when validation pass or return to the index page if validation fails
        if ($validator->fails()) {
            return Redirect::to('orders/create')->withErrors($validator);
        } else {
            // Create a Order instance and configure the values before insert action
            $order = new Order;
            $order->regno = $request->regno;
            $order->regstate = $request->regstate;
            $order->custname = $request->custname;
            $order->custphone = $request->custphone;
            $order->vehbrand = $request->vehbrand;
            $order->vehmodel = $request->vehmodel;
            $order->vehyear = $request->vehyear;
            $order->serialno = $request->serialno;

            $order->tax = $request->tax;
            $order->serialno = $request->serialno;
            $order->custaddress = $request->custaddress;
            $order->tax =  $request->tax;
            $order->paymemt =  $request->paymemt;
            $order->cardtype =  $request->cardtype;
            $order->vaDate = $request->vaDate;
            $order->totalweight = $request->totalweight;
            $order->cardnum =  $request->cardnum;
            $order->totalcost =  $request->totalcost;
            $order->totalamount =   $request->totalamount;




            $order->createddate = Carbon::now();
            $order->save();

            return back()->with('success', 'Successfully created order!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // Retrieve the order
        $order = Order::find($id);
        // $orderdetail = Orderdetail::find($id);

        // Load the view and pass the retrieved order to the view for further processing
        return View::make('orders.show')->with('order', $order);
    }

    public function show1($id)
    {
        //
        // Retrieve the order
        $order = Order::find($id);

        // Load the view and pass the retrieved order to the view for further processing
        return View::make('orders.airwaybill')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // Retrieve the order
        $order = Order::find($id);

        // show the edit form and pass the order
 //       return view('orders.edit', compact('order'));
 return View::make('orders.edit')->with('order', $order);   
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        
        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return Redirect::to('orders/create')->withErrors($validator);
        } else {
            $order = Order::find($id);
            $order = new Order;
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
            $order->totalcost =  $request->totalcost;
            $order->totalamount =   $request->totalamount;
            $order->paymentstatus =   $request->paymentstatus;
            $order->remark =   $request->remark;
            $order->createddate = Carbon::now();

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
                $orderdetail = new OrderDetail;
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
            //$order->whereId($id)->update($input);


            // Redirect
            return redirect('/staff/orderindex')->with('success','Successfully updated order detail!');
        }
    }
}
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // Retrieve the order
        $order = Order::find($id);

        // Delete the retrieved order
        $order->delete();

        return redirect('orders')->with('success', 'Successfully deleted order!');
    }

    public function createorderwithdetails()
    {
        // Redirect the user back to the create order with details view
        return View::make('orders.createorderwithdetails');
    }




    public function storewithdetails(Request $request)
    {
        // Get the submitted input
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
        

        $validator = Validator::make($input, $rules, $messages);
        // Perform insert order action when validation pass or return to the index page if validation fails
        if ($validator->fails()) {
            return Redirect::to('orders/createorderwithdetails')->withErrors($validator)->withInput();
        } else {
            // Create a Order instance and configure the values before insert action
            $order = new Order;
            $order->custid = $request->custid;
            $order->custarea = $request->custarea;
            $order->receid = $request->receid;
            $order->recearea = $request->recearea;
            $order->receCompanyname = $request->receCompanyname;
            $order->recename = $request->recename;
            $order->receEmail = $request->recenEmail;
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
            $order->createddate = Carbon::now();

            $order->save();

            if($request->location ?? $request->bookingtime !== null){
            $booking = new Booking;
            $booking->location = $request->location;
            $booking->bookingtime = $request->bookingtime;
            $order->booking()->save($booking);
            }

            

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
                $orderdetail = new OrderDetail;
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
      

       return View::make('orders.show')->with('order', $order);

    }
    public function airwaybill($id)
    {
        //
        // Retrieve the order
        $order = Order::find($id);

        // Load the view and pass the retrieved order to the view for further processing
        return View::make('orders.airwaybill')->with('order', $order);
    }

    public function viewOrderDetail($id)
    {
        //
        // Retrieve the order
        $order = Order::find($id);

        // Load the view and pass the retrieved order to the view for further processing
        return View::make('orders.show')->with('order', $order);
    }

    
    public function viewOrderCust()
    {
        $orders = Order::Where('custid',Auth::user()->id)->orderBy('orderid','desc')->paginate(15);

        return view::make('orders.customerView',compact('orders'));
    }

    
}
