@extends((Auth::guard('web')->check())? 'layouts.app':'layouts.staffhead')

@section('content')




<style>
#hidden{
display: none;
}
#checkcom{
display: none;
}


</style>

  @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
  @elseif(session('message')) 
  <div class="alert alert-success mb-2">
    {{ session()->get('message') }}
   </div>
        @endif
        @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> Some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
     
      <div class="container col-md-10">
<h1>Showing Shippment Order Number: {{ $order->orderid }}</h1>

<div class="card">
   <div class="card-header text-white cloginbar">Sender  Information</div>
   
  
   <div class="row mt-3 ">
      <div class="col-4 text-right ">Shippment Order Number:</div>
         <div class="col-4"> {{ $order->orderid }}</div>
      </div>
      <div class="row mt-3">
              <div class="col-4 text-right">Sender  Name:</div>
         <div class="col-4">{{ $order->custname }}</div>
       </div>
       <div class="row mt-3">
         <div class="col-4 text-right">Sender  Phone / Fax Number:</div>
         <div class="col-4">{{  $order->custphone  }}</div>
       </div>

       <div class="row mt-3">
         <div class="col-4 text-right">Sender  Post Code:</div>
         <div class="col-4">{{  $order->custpostcode   }}</div>
       </div>
       <div class="row mt-3">
         <div class="col-4 text-right">Sender  Address:</div>
         <div class="col-4">{{  $order->custaddress   }}</div>
       </div>
       <div class="row mt-3">
         <div class="col-4 text-right">Sender  Country:</div>
         <div class="col-4">{{  $order->custarea   }}</div>
       </div>


  

   @foreach ($order->booking as $bk)
   <div class="card ">
    <div class="card-header text-white cloginbar">Pick up Booking</div>
  
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
            <div class="col-4 text-right">Receiver Email:</div>
            <div class="col-4">{{  $order->receEmail   }}</div>
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




<!--<a href="{{ url('/showairwaybill/' . $order->orderid) }}" class="btn btn-xs btn-info pull-right">Edit</a>-->
<!--<button type="button" onclick="window.location='{{ url("orders/airwaybill/".$order->orderid) }}'">Button</button>-->

<div class="row my-4 justify-content-center">
   <div class="col-2 mt-3 text-center">
   <a class="p-3 mt-2 bg-danger text-white text-center"  href="{{URL::to('airwaybill',$order)  }}">Print Airway Bill</a>
   <!--   <a class="p-3 mb-2 bg-primary text-white text-center" styple="background-color: blue; "href="{{URL::to('commercialinvoice',$order)}}">Print Commercial Invoice</a>
-->   
   </div>
   <div class="col-2 mt-3 text-center">
  @if ($order->paymentstatus == 'Paid')

  <a class="p-3  bg-primary text-white text-center"  href="{{URL::to('invoicecust',$order)}}" >Print Invoice</a>
  
      
  @elseif($order->paymentstatus == 'Pay Online')
  <a class="p-3 mb-2 " id="paypal-payment-button" href=# ></a>  
  <div class="row mt-3 " style="display: hidden;">
    <form action="/settlepayment/{{$order->orderid}}/success" method="POST" id="payform">
        @csrf
    </form>
  </div>    
  @endif
</div>
</div>
    <div class="row my-4 justify-content-center">
    
      <form class="upload" method="post" action="{{url('preview-image-upload')}}" enctype="multipart/form-data"  >
        @csrf
      
       
          <input type="file" name="profile_image" id="profile_image" onchange="loadPreview(this);" class="form-control">
          <div id='hidden'>{{ Form::text('uploadoid1', $order->orderid , array('class' => 'form-control')) }}
          {{ Form::input('text','uploadoid', $order->orderid, array('class' => 'form-control')) }}</div>
          <div id='checkcom'>{{ Form::input('text','checkcom', $order->checkcom, array('class' => 'form-control')) }}</div>
          <label for="profile_image"  ></label>
            <img id="preview_img"  src="http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png" class="" width="120" height="100"/>
        

        
       
          <button type="submit" class="p-3 mb-2 bg-primary text-white text-center" style="margin-top:10px">Please Upload the Commercial Invoice</button>  
          @foreach ($order->Photo as $ph)

          <div class="row my-4">
        
        Download Invoice<a  style="float:right;" download name href={{ asset("/profile_images/$ph->photo_name") }}><img  width=150  name = 'filename'  class="pic">{{$ph->photo_name}}</a>
        </div>

          @endforeach
        </form>
          </div>
          </div>
   </div>

          </div>
        </div>


        <script src="https://www.paypal.com/sdk/js?client-id=AR7Vf-XUMn_oyA8oi5gBDnhDs_KCdG0p9MeqvmLlM4-7QJhT8eaKSsHmiqmFJruXv21NboNhicAvehET&currency=HKD&disable-funding=credit"></script>
        <script>
        paypal.Buttons({
            style: {
                shape: 'pill'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: {{$order->shipfee}}
                        }
                    }]
                });
            },
    
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                   // console.log(details)
                    //indow.location.replace("/settlepayment/{{$order->orderid}}/success")
                    $('#payform').submit();
                })
            },
    
            onCancel: function(data) {
                return;
            }
        }).render('#paypal-payment-button');
        </script>

<script>
  function loadPreview(input, id,oid) {
    id = id || '#preview_img';

    if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $(id)
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
        };
 
        reader.readAsDataURL(input.files[0]);
    }
 }

</script>

</div>
@endsection
