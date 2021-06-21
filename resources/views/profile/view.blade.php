@extends('layouts.staffhead')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header text-white font-weight-bold sloginbar">{{ $user-> custname}} Profile </div>

                <div class="card-body ">

                    <div class="row">
                    <label class="col-md-4 ">Customer Name</label>
                    
                    <span class="inline-block col-md-8"> {{ $user -> custname}}</span>
                    </div>

                    <div class="row">
                        <label class="col-md-4">Email</label>
                        
                        <span class="inline-block col-md-8"> {{ $user -> email}}</span>
                    </div>

                    <div class="row">
                        <label class="col-md-4">Gender</label>
                        
                        <span class="inline-block col-md-8"> {{ $user -> custGender == 'M' ?  'Male': 'Female'}}</span>
                    </div>

                    <div class="row">
                        <label class="col-md-4">Contact Number</label>
                        
                        <span class="inline-block col-md-8"> {{ $user -> contactNo}}</span>
                    </div>

                    <div class="row">
                        <label class="col-md-4">Address</label>
                        
                        <span class="inline-block col-md-8"> {{ $user -> custAddress}}</span>
                    </div>

                    <div class="row">
                        <label class="col-md-4">Credit</label>
                        
                        <span class="inline-block col-md-8"  id="credit">{{ $user->creditLimit - App\Order::WHERE('custid', $user->id)->where('paymentstatus', 'Waiting to Pay') ->sum('shipfee')}}</span>
                    </div>

                    <div class="row">
                        <label class="col-md-4">Credit Limit</label>
                        
                        <span class="inline-block col-md-8"  id="credit">{{$user -> creditLimit}}</span>
                    </div>


            </div>  
            </div>

            <div class="card mt-5">
                <div class="card-header text-white font-weight-bold sloginbar">Orders </div>
                <div class="card-body ">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">Order Number</th>
                              <th scope="col">Receiver Name</th> 
                              <th scope="col">Shipment Type</th>
                              <th scope="col">Shipment Countries</th>
                              <th scope="col">Shipment Fee</th>
                              <th scope="col">View Order Detail</th>
                              
                            </tr>
                          </thead>

                          <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->orderid}}</td>
                                <td>{{$order->recename}}</td>
                                <td>{{$order->shiptype}}</td>
                                <td>{{$order->shipcountries}}</td>
                                <td>${{$order->shipfee}}</td>
                                <td><button class="btn btn-info text-white" onclick="window.location='/viewOrderDetail/{{$order->orderid}}'"  >View Order Detail</button></td>
                                

                            </tr>
                            @endforeach
                            
                          </tbody>
                         
                    </table>
                    {{ $orders->links() }}
                </div>

        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

       var credit =  $('#credit').html();
        console.log(credit);
       if(credit < 0 )
       {
           $('#credit').css("color","red");
       }

    });
</script>
@endsection
