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

class AirwaybillController extends Controller
{
    public function index()
    {
        //
        // Retrieve all the orders
        $orders = Order::all();

        // Load the view and pass the retrieved orders to the view for further processing
        return view('airwaybill.index')->with('order', $orders);
    }


    public function show($id)
    {
        //
        // Retrieve the order
        $order = Order::find($id);
        // $orderdetail = Orderdetail::find($id);

        // Load the view and pass the retrieved order to the view for further processing
        return View::make('orders.airwaybill')->with('order', $order);
    }
}
