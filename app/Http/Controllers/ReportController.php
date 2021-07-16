<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Weekly shipment report
    public function weeklyReport()
    {   //get and change date format
        $last1Week1Day = Carbon::now()->subDay()->format('Y-m-d');
        $last1Week2Day = Carbon::now()->subDay(2)->format('Y-m-d');
        $last1Week3Day = Carbon::now()->subDay(3)->format('Y-m-d');
        $last1Week4Day = Carbon::now()->subDay(4)->format('Y-m-d');
        $last1Week5Day = Carbon::now()->subDay(5)->format('Y-m-d');
        $last1Week6Day = Carbon::now()->subDay(6)->format('Y-m-d');
        $last1Week7Day = Carbon::now()->subDay(7)->format('Y-m-d');

        $last2Week1Day = Carbon::now()->subDay(8)->format('Y-m-d');
        $last2Week2Day = Carbon::now()->subDay(9)->format('Y-m-d');
        $last2Week3Day = Carbon::now()->subDay(10)->format('Y-m-d');
        $last2Week4Day = Carbon::now()->subDay(11)->format('Y-m-d');
        $last2Week5Day = Carbon::now()->subDay(12)->format('Y-m-d');
        $last2Week6Day = Carbon::now()->subDay(13)->format('Y-m-d');
        $last2Week7Day = Carbon::now()->subDay(14)->format('Y-m-d');

        //filter the date range with one week
        $last1WeekData = Order::where('createddate', 'like', $last1Week1Day.'%')->orWhere('createddate', 'like', $last1Week2Day.'%')
                              ->orWhere('createddate', 'like', $last1Week3Day.'%')->orWhere('createddate', 'like', $last1Week4Day.'%')
                              ->orWhere('createddate', 'like', $last1Week5Day.'%')->orWhere('createddate', 'like', $last1Week6Day.'%')
                              ->orWhere('createddate', 'like', $last1Week7Day.'%')->orderBy('createddate', 'desc')->get();

        $last2WeekData = Order::where('createddate', 'like', $last2Week1Day.'%')->orWhere('createddate', 'like', $last2Week2Day.'%')
                              ->orWhere('createddate', 'like', $last2Week3Day.'%')->orWhere('createddate', 'like', $last2Week4Day.'%')
                              ->orWhere('createddate', 'like', $last2Week5Day.'%')->orWhere('createddate', 'like', $last2Week6Day.'%')
                              ->orWhere('createddate', 'like', $last2Week7Day.'%')->orderBy('createddate', 'desc')->get();

        // Count the number of orders
        $count1 = $last1WeekData->count();
        $count2 = $last2WeekData->count();

        // get the sum of the total shipment fee
        $week1TotalShipfee = $last1WeekData->sum('shipfee');
        $week2TotalShipfee = $last2WeekData->sum('shipfee');

        // get the sum of the total weight
        $week1TotalWeight = $last1WeekData->sum('totalweight');
        $week2TotalWeight = $last2WeekData->sum('totalweight');

        // Pass the needed data to view
        return View::make('weeklyShipmentReport')->with('last1Week1Day', $last1Week1Day)->with('last1Week7Day', $last1Week7Day)
                                                 ->with('last2Week1Day', $last2Week1Day)->with('last2Week7Day', $last2Week7Day)
                                                 ->with('last1WeekData', $last1WeekData)->with('count1', $count1)
                                                 ->with('last2WeekData', $last2WeekData)->with('count2', $count2)
                                                 ->with('week1TotalShipfee', $week1TotalShipfee)->with('week1TotalWeight', $week1TotalWeight)
                                                 ->with('week2TotalShipfee', $week2TotalShipfee)->with('week2TotalWeight', $week2TotalWeight);
    }

    // Statistical report
    public function fourYearReport()
    {
      // Retrieve all needed data for the report
       $totalweight18 = Order::where('createddate', 'like', '2018%')->sum('totalweight');
       $totalweight19 = Order::where('createddate', 'like', '2019%')->sum('totalweight');
       $totalweight20 = Order::where('createddate', 'like', '2020%')->sum('totalweight');
       $totalweight21 = Order::where('createddate', 'like', '2021%')->sum('totalweight');
       $totalshipfee18 = Order::where('createddate', 'like', '2018%')->sum('shipfee');
       $totalshipfee19 = Order::where('createddate', 'like', '2019%')->sum('shipfee');
       $totalshipfee20 = Order::where('createddate', 'like', '2020%')->sum('shipfee');
       $totalshipfee21 = Order::where('createddate', 'like', '2021%')->sum('shipfee');
         // Load the view and pass the retrieved data to the view for further processing
         return View::make('statisticalReport')->with('totalweight18', $totalweight18)->with('totalweight19', $totalweight19)
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
