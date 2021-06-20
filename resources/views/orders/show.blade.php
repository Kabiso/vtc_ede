@extends( (Auth::guard('web')->check()) ? 'layouts.app' : 'layouts.staffhead')
@section('content')


<h1>Showing {{ $order->orderid }}</h1>
<div class="container">
<div class="jumbotron text-center">

<table class="table table-striped">
<tr>
<thead>
<tr>
</tr>
</thead>
<tbody>
<tr>
<td><p>order Number:</td>
 <td>{{ $order->orderid }}</p></td>
</tr>
<tr>
<td><p>custid:</td>
<td>{{ $order->custid }}</p></td>
</tr>
<tr>
   @foreach($order->booking as $booking)
   <tr>
      <td><p>Pickup ID:</td><td>{{$booking ->bookingid}}</td>
      </tr>
      <tr>      
         <td><p>Pickup Location:</td><td>{{$booking ->location}}</td>
         </tr> 
         <tr> 
         <td><p>Pickup Time:</td><td>{{$booking ->bookingtime}}</td>
    </tr>
            @endforeach

   <td><p>custname:</td><td> {{ $order->custname }}</p></td>
</tr>
<tr>
<td><p>custpostcode :</td><td> {{ $order->custpostcode  }}</p></td>
  </tr>
  <tr>
  <td><p>custaddress:</td><td> {{ $order->custaddress   }}</p></td>
  </tr>


<td><p>receid  : </td>
<td>{{ $order->receid }}</p></td>
</tr>
<tr>
<td><p>receCompanyname:</td>
<td> {{ $order->receCompanyname }}</p></td>
</tr>
<tr>
<td><p>recename:</td> <td>{{ $order->recename }}</p></td>
</tr>
<tr>
<td><p>recephone:</td>
<td>{{ $order->recephone }}</p><td>
</tr>
<tr>
<td><p>recepostcode:</td>
<td>{{ $order->recepostcode }}</p></td>
<tr>   
<td><p>receaddress:</td> <td>{{ $order->receaddress }}</p></td>
 <tr> 

    <tr>
    <td> <p> tax: </td><td>{{ $order->tax }}</p></td>
    </tr>
    <tr>
    <td> <p>paymemt :</td><td> {{ $order->paymemt}}</p></td>
    </tr>
    <tr>
    <td> <p>cardtype:</td><td> {{ $order->cardtype}}</p></td>
    </tr>

    <tr>
      <td> <p>cardnum:</td><td> {{ $order->cardnum}}</p></td>
      </tr>
      <tr>
         <td> <p>vaDate:</td><td> {{ $order->vaDate}}</p></td>
         </tr>
         <tr>
            <td> <p>chequednum:</td><td> {{ $order->chequednum}}</p></td>
            </tr>
            <tr>
               <td> <p>paymentstatus:</td><td> {{ $order->paymentstatus}}</p></td>
               </tr>
    </tbody>
    </table>

    

<table class="table">
<thead>
<th>itemHamoCode</th>
<th>desc</th>
<th>itemQty</th>
<th>cost</th>
<th>price</th>
<th>weight</th>
<thead>
<tbody>
   @foreach($order->orderdetails as $od)
<tr>
<td>{{$od ->itemHamoCode}}</td>
<td>{{$od ->desc}}</td>
<td>{{$od ->itemQty}}</td>
<td>{{$od ->cost}}</td>
<td>{{$od ->weight}}</td>
<td>{{$od ->price}}</td>
</tr>
@endforeach
</div>
</tbody>
</table>

<!--<a href="{{ url('/showairwaybill/' . $order->orderid) }}" class="btn btn-xs btn-info pull-right">Edit</a>-->
<!--<button type="button" onclick="window.location='{{ url("orders/airwaybill/".$order->orderid) }}'">Button</button>-->


<a class="btn btn-small btn-success" href="{{URL::to('airwaybill',$order)  }}">Print Airway Bill</a>
<a class="btn btn-small btn-success" href="{{URL::to('commercialinvoice',$order)  }}">Print Commercial Invoice</a>
@endsection
