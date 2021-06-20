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
        return view('orders.edit', compact('order'));
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

        $rules = array(
            'custid' => 'required',
            'receid' => 'required',
            'receCompanyname' => 'required',
            'recename' => 'required',
            'recephone' => 'required|numeric',
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

        if ($validator->fails()) {
            return Redirect::to('orders/create')->withErrors($validator);
        } else {
            $order = Order::find($id);

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

            // Either one of the following can save the order
            $order->save();
            //$order->whereId($id)->update($input);


            // Redirect
            return redirect('orders')->with('success', 'Successfully updated order!');
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
            //  'custid' => 'required',
         //   'receid' => 'required',
            'receCompanyname' => 'required',
            'recename' => 'required',
            'recephone' => 'required',
            'recepostcode' => 'required',
            'receaddress' => 'required',
            // 'custname' => 'required',
            //  'custphone' => 'required|numeric',
            'custpostcode' => 'required',
            //  'custaddress' => 'required',
          //  'tax' => 'required|numeric',
            'paymemt' => 'required',
       //     'cardtype' => 'required',
      //      'vaDate' => 'required',

     //       'chequednum' => 'required',
            'totalweight' => 'required|numeric',
      //      'cardnum' => 'required',
            'totalcost' => 'required|numeric',
            'totalamount' => 'required|numeric',

            'shiptype' => 'required',
            'shipcountries' => 'required',
            'shipfee' => 'required',
            'paymentstatus' => 'required'
            
        );
        // Create customized validation messages
        $messages = [
            'custid.required' => 'Please input the customer id',
          //  'receid.required' => 'Please input the receid',
            'receCompanyname.required' => 'Please input the receCompanyname',
            'recename.required' => 'Please input the recename',
            'recephone.required' => 'Please input the recephone',
            'recepostcode.required' => 'Please input the recepostcode',
            'receaddress.required' => 'Please input the receaddress',
            'custname.required' => 'Please input the custname',
         //   'tax.numeric' => 'Please input the tax',
            'custaddress.required' => 'Please input the custaddress',
            'paymemt.required' =>  'Please input the paymemt',
         //   'cardtype.required' =>  'Please input the Vehicle Serial Nnumber',
            'vaDate.required' =>  'Please input vaDate',
            'totalweight.numeric' =>  'Please input totalweight',
        //    'cardnum.required' =>  'Please input the cardnum',
            'totalcost.numeric' =>  'Please input the totalcost',
            'totalamount.numeric' =>  'Please input totalamount'
        ];

        $validator = Validator::make($input, $rules, $messages);
        // Perform insert order action when validation pass or return to the index page if validation fails
        if ($validator->fails()) {
            return Redirect::to('orders/createorderwithdetails')->withInput()->withErrors($validator);
        } else {
            // Create a Order instance and configure the values before insert action
            $order = new Order;
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
            $order->totalcost =  $request->totalcost;
            $order->totalamount =   $request->totalamount;
            $order->paymentstatus =   $request->paymentstatus;
            $order->remark =   $request->remark;
            $order->createddate = Carbon::now();

            $order->save();
            $booking = new Booking;
            $booking->location = $request->location;
            $booking->bookingtime = $request->bookingtime;
            $order->booking()->save($booking);

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
        //  }

        // Redirect 'data', $data
        //  return redirect('orders/show1')->with('data', $order);

        //   return redirect('orders/show1')->with('order',$order);
        return view('orders.show')->with('order', $order);

        // Route::view('/welcome', 'welcome', ['name' => 'Taylor']);
        // return redirect('orders')->with('success','Successfully inserted order with details!');
        //    return redirect('views/show/'.$order->id);
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


    
}
