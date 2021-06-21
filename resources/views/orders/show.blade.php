@extends((Auth::guard('web')->check())? 'layouts.app':'layouts.staffhead')

@section('content')

<div class="container col-md-10">
<h1>Showing Shippment Order Number:                       {{ $order->orderid }}</h1>

<div class="card">
   <div class="card-header text-white cloginbar">Customer Information</div>
   
  
   <div class="row mt-3 ">
      <div class="col-4 text-right ">Shippment Order Number:</div>
         <div class="col-4"> {{ $order->orderid }}</div>
      </div>
      <div class="row mt-3">
              <div class="col-4 text-right">Customer Name:</div>
         <div class="col-4">{{ $order->custname }}</div>
       </div>
       <div class="row mt-3">
         <div class="col-4 text-right">Customer Phone / Fax Number:</div>
         <div class="col-4">{{  $order->custphone  }}</div>
       </div>

       <div class="row mt-3">
         <div class="col-4 text-right">Customer Post Code:</div>
         <div class="col-4">{{  $order->custpostcode   }}</div>
       </div>
       <div class="row mt-3">
         <div class="col-4 text-right">Customer Address:</div>
         <div class="col-4">{{  $order->custaddress   }}</div>
       </div>
       <div class="row mt-3">
         <div class="col-4 text-right">Customer Country:</div>
         <div class="col-4">{{  $order->custarea   }}</div>
       </div>


   <div class="card ">
      <div class="card-header text-white cloginbar">Pick up Booking</div>

   @foreach ($order->booking as $bk)
  
      <div class="row mt-3">
         <div class="col-4 text-right">Pickup Location:</div>
         <div class="col-4">{{  $bk->location   }}</div>
       </div>
       <div class="row mt-3">
         <div class="col-4 text-right">Pickup Time:</div>
         <div class="col-4">{{  $bk->bookingtime   }}</div>
       </div>
      </div>
     @endforeach 
       <div class="card">
         <div class="card-header text-white cloginbar">Receiver Information</div>
         
         <div class="row mt-3">
            <div class="col-4 text-right">Receiver Company Name:</div>
            <div class="col-4">{{  $order->receCompanyname   }}</div>
          </div>
          <div class="row mt-3">
            <div class="col-4 text-right">Receiver Name:</div>
            <div class="col-4">{{  $order->recename   }}</div>
          </div>
          <div class="row mt-3">
            <div class="col-4 text-right">Receiver Phone Number/Fax Number:</div>
            <div class="col-4">{{  $order->recephone   }}</div>
          </div>
          <div class="row mt-3">
            <div class="col-4 text-right">Receiver Post Code:</div>
            <div class="col-4">{{  $order->recepostcode   }}</div>
          </div>
          <div class="row mt-3">
            <div class="col-4 text-right">Receiver Address:</div>
            <div class="col-4">{{  $order->receaddress   }}</div>
          </div>


          <div class="card">
            <div class="card-header text-white cloginbar">Payment Information</div>
            <div class="row mt-3">
               <div class="col-4 text-right">Payment Method:</div>
            <div class="col-4">{{  $order->paymemt   }}</div>
          </div>
          <div class="row mt-3">
            <div class="col-4 text-right">Total Weight:</div>
         <div class="col-4">{{  $order->totalweight   }}</div>
       </div>
       <div class="card">
         <div class="card-header text-white cloginbar">Shipment Information</div>
       
         
         <div class="row mt-3">
            <div class="col-4 text-right">Shipment Type:</div>
            <div class="col-4">{{   $order->shiptype    }}</div>
          </div>
   
          <div class="row mt-3">
            <div class="col-4 text-right">Shipment Countries:</div>
            <div class="col-4">{{   $order->shipcountries     }}</div>
          </div>
          <div class="row mt-3">
            <div class="col-4 text-right">Shipment Fee:</div>
            <div class="col-4">{{   $order->shipfee     }}</div>
          </div>
          <div class="row mt-3">
            <div class="col-4 text-right">Total Qty:</div>
            <div class="col-4">{{   $order->totalqty    }}</div>
          </div>
          <div class="row mt-3">
            <div class="col-4 text-right">Total Cost:</div>
            <div class="col-4">{{  $order->totalcost    }}</div>
          </div>
          <div class="row mt-3">
            <div class="col-4 text-right">Total Amount:</div>
            <div class="col-4">{{   $order->totalamount     }}</div>
          </div>
         </div>            
     <!-- Detail Form -->
<div class="card">
   <div class="card-header text-white cloginbar">Shipment Items</div>
   <table class="order-list mt-4">
       <thead >
       <tr>                          
         <th ><p style="font-size:10px">Harmonized Code </p></th>
         <th><p style="font-size:10px">Full Description of Goods</p></th>
         <th><p style="font-size:10px">No of items</p></th>
         <th><p style="font-size:5px">Unit Weight</p></th>
         <th><p style="font-size:5px">Unit Cost</p></th>
         <th><p style="font-size:5px">Unit Price</p></th>
         <th><p style="font-size:5px">Wiegth total</p></th>
         <th><p style="font-size:5px">Price total</p></th>
         <th><p style="font-size:5px">Cost total</p></th>
      </tr>
      </thead>

      <tr>
         @foreach ($order->orderdetails as $od)
         <td>{{  $od->itemHamoCode  }}</td>
         <td>{{  $od->desc  }} </td>
               <td>{{  $od->itemQty  }} </td>
                <td>{{  $od->weight  }} </td>
                    <td>{{  $od->cost  }} </td>
                   <td>{{  $od->price  }}</td>
                        <td>{{  $od->lineweight  }}</td>
                           <td>{{  $od->lineprice  }}</td>
                             <td>{{  $od->linecost  }}</td>
     </tr>
@endforeach

</table>

</div>
</div>

<!--<a href="{{ url('/showairwaybill/' . $order->orderid) }}" class="btn btn-xs btn-info pull-right">Edit</a>-->
<!--<button type="button" onclick="window.location='{{ url("orders/airwaybill/".$order->orderid) }}'">Button</button>-->

<div class="row my-4">
   <div class="col-4"></div>
   <a class="p-3 mb-2 bg-danger text-white text-center"  href="{{URL::to('airwaybill',$order)  }}">Print Airway Bill</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a class="p-3 mb-2 bg-primary text-white text-center" styple="background-color: blue; "href="{{URL::to('commercialinvoice',$order)}}">Print Commercial Invoice</a>
   </div>
   </div>
@endsection
