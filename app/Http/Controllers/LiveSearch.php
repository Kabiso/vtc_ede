<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LiveSearch extends Controller
{
    function index()
    {
     return view('live_search');
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $checkid='';
      $orderid='';
      $acceptanceTime='';
      $p1='';
      $p2='';
      $query = $request->get('query');
      if($query != '')
      {
      $data = DB::table('trackshipments')
         ->where('orderid', $query)
         ->orderBy('id', 'desc')
         ->get();
      $checkid = Order::where('orderid', $query)->count();
      }
      else{
         return;
      }

      if($checkid > 0 )
      {
         $p1 = Order::where('orderid', $query)->first()->custarea;
         $p2 = Order::where('orderid', $query)->first()->recearea;
         $orderid = $query;
         $acceptanceTime = Order::where('orderid', $query)->first()->acceptanceTime;
      }
     
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
       $output .= '
        <tr>
         <td>'.$row->status.'</td>
         <td>'.$row->created_at.'</td>
         <td>'.$row->location.'</td>
         
         </tr>
        ';
       }
     
       }
       
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
    //  'table_data1'  => $output1,
       'total_data'  => $total_row,
       'checkid' => $checkid,
       'p1' => $p1,
       'p2' => $p2,
       'orderid' => 'Order ID: '.$orderid,
       'acceptanceTime' => $acceptanceTime
      );

      echo json_encode($data);
     }
    }
}