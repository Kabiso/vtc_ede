@extends('layouts.staffhead')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            @if (session('message'))
            <div class="alert alert-success mb-2">
             {{ session()->get('message') }}
            </div>  
            @endif
            
            <div class="card">
                <div class="card-header text-white font-weight-bold sloginbar">Orders</div>
                <div class="card-body ">
                    <table class="table">
                        <thead>
                            <tr>
                            
                              <th scope="col">Order Number</th>
                              <th scope="col">User ID</th>

                              <th scope="col">Shipment Type</th>
                              
                              <th scope="col">Shipment Fee</th>
                              <th scope="col">Payment Status</th>
                              <th scope="col">View Detail</th>
                              <th scope="col">Edit</th>
                              
                              
                              
                            </tr>
                          </thead>

                          <tbody>
                            @foreach($orders as $order)
                            <tr>
                               
                                <td>{{$order->orderid}}</td>
                                <td>{{$order->custid}}</td>

                                <td>{{$order->shiptype}}</td>
                                <td>{{$order->shipfee}}</td>
                                <td>{{$order->paymentstatus}}</td>
                                <td><button class="btn btn-info text-white" onclick="window.location='/viewOrderDetail/{{$order->orderid}}'" >View Detail</button></td>
                                <td>
                                    @if (isset(App\Trackshipment::where('orderid', $order->orderid)->orderBy('created_at', 'DESC')->first()->status) )
                                         @if(App\Trackshipment::where('orderid', $order->orderid)->orderBy('created_at', 'DESC')->first()->status == 'Complete')
                                        <button class="btn btn-secondary text-white"  >Completed</button>
                                        @elseif(App\Trackshipment::where('orderid', $order->orderid)->orderBy('created_at', 'DESC')->first()->status == 'Cancel')
                                        <button class="btn btn-secondary text-white"  >Canceled</button>
                                        @else
                                        <button class="btn btn-success text-white" onclick="window.location='/staff/orderedit/{{$order->orderid}}'" >Edit</button> 
                                        @endif
                                    @else
                                    <button class="btn btn-success text-white" onclick="window.location='/staff/orderedit/{{$order->orderid}}'" >Edit</button>   
                                    @endif
                                </td>
                               

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


@endsection
