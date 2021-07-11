<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Retrieve all the orders
       $totalweight18 = DB::table('orders')->where('createddate', 'like', '2018%')->sum('totalweight');
       $totalweight19 = DB::table('orders')->where('createddate', 'like', '2019%')->sum('totalweight');
       $totalweight20 = DB::table('orders')->where('createddate', 'like', '2020%')->sum('totalweight');
       $totalweight21 = DB::table('orders')->where('createddate', 'like', '2021%')->sum('totalweight');
       $totalshipfee18 = DB::table('orders')->where('createddate', 'like', '2018%')->sum('shipfee');
       $totalshipfee19 = DB::table('orders')->where('createddate', 'like', '2019%')->sum('shipfee');
       $totalshipfee20 = DB::table('orders')->where('createddate', 'like', '2020%')->sum('shipfee');
       $totalshipfee21 = DB::table('orders')->where('createddate', 'like', '2021%')->sum('shipfee');
         // Load the view and pass the retrieved orders to the view for further processing
         return View::make('report')->with('totalweight18', $totalweight18)->with('totalweight19', $totalweight19)
                                    ->with('totalweight20', $totalweight20)->with('totalweight21', $totalweight21)
                                    ->with('totalshipfee18', $totalshipfee18)->with('totalshipfee19', $totalshipfee19)
                                    ->with('totalshipfee20', $totalshipfee20)->with('totalshipfee21', $totalshipfee21);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
}
