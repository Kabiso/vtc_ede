<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all the order details
        $orderdetails = OrderDetail::all();
                
        // Load the view and pass the retrieved order details to the view for further processing
        return View::make('orderdetails.index')->with('orderdetails', $orderdetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('orderdetails.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get the submitted input
        $input = $request->all();
        
        // Create validation rules, please refer to https://laravel.com/docs/7.x/validation#available-validationrules for more details
        $rules = array(
            'desc' => 'required',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'orderid' => 'required|numeric',
        );
        
        // Create customized validation messages
        $messages = [
            'desc.required' => 'Please input the Description',
            'cost.required' => 'Please input the Cost',
            'cost.numeric' => 'Please input the Cost in correct format',
            'price.required' => 'Please input the Price',
            'price.numeric' => 'Please input the Price in correct format',
            'orderid.required' => 'Please input the Order ID',
            'orderid.numeric' => 'Please input the Order ID in correct format',
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        
        // Perform insert order action when validation pass or return to the index page if validation fails
        if ($validator->fails()) {
            return Redirect::to('orderdetails/create')->withErrors($validator);
        } else {
            // Create a Order instance and configure the values before insert action
            $orderdetail = new OrderDetail;
            $orderdetail->desc = $request->desc;
            $orderdetail->cost = $request->cost;
            $orderdetail->price = $request->price;
            $orderdetail->orderid = $request->orderid;
            $orderdetail->save();
            return back()->with('success','Successfully created order detail!');
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
        // Retrieve the order detail
        $orderdetail = OrderDetail::find($id);
        
        // Load the view and pass the retrieved order detail to the view for further processing
        return View::make('orderdetails.show')->with('orderdetail', $orderdetail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieve the order detail
        $orderdetail = OrderDetail::find($id);
        
        // Load the view and pass the retrieved order detail to the view for further processing
        return View::make('orderdetails.edit')->with('orderdetail', $orderdetail);
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
        // Get the submitted input
        $input = $request->all();
        
        // Create validation rules, please refer to https://laravel.com/docs/7.x/validation#available-validationrules for more details
        $rules = array(
            'desc' => 'required',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'orderid' => 'required|numeric',
        );
        
        // Create customized validation messages
        $messages = [
            'desc.required' => 'Please input the Description',
            'cost.required' => 'Please input the Cost',
            'cost.numeric' => 'Please input the Cost in correct format',
            'price.required' => 'Please input the Price',
            'price.numeric' => 'Please input the Price in correct format',
            'orderid.required' => 'Please input the Order ID',
            'orderid.numeric' => 'Please input the Order ID in correct format',
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        
        // Perform insert order action when validation pass or return to the index page if validation fails
        if ($validator->fails()) {
            return Redirect::to('orderdetails/create')->withErrors($validator);
        } else {
            // Create a Order instance and configure the values before insert action
            $orderdetail = OrderDetail::find($id);
            $orderdetail->desc = $request->desc;
            $orderdetail->cost = $request->cost;
            $orderdetail->price = $request->price;
            $orderdetail->orderid = $request->orderid;
            $orderdetail->save();
            return back()->with('success','Successfully updated order detail!');
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
        // Retrieve the order
        $orderdetail = OrderDetail::find($id);
         
        // Delete the retrieved order
        $orderdetail->delete();
        return redirect('orderdetailss')->with('success','Successfully deleted order detail!'); 
    }
}
