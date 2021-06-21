@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
           
            <div class="card">
                <div class="card-header text-white font-weight-bold cloginbar">Orders </div>
                <div class="card-body ">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order Status</th>
                              <th scope="col">Order Number</th>
                              <th scope="col">Receiver Name</th> 
                              <th scope="col">Shipment Type</th>
                              <th scope="col">Shipment Countries</th>
                              <th scope="col">Shipment Fee</th>
                              <th scope="col">Payment Status</th>
                              <th scope="col">View Order Detail</th>
                              
                            </tr>
                          </thead>

                          <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->orderstatus}}</td>
                                <td>{{$order->orderid}}</td>
                                <td>{{$order->recename}}</td>
                                <td>{{$order->shiptype}}</td>
                                <td>{{$order->shipcountries}}</td>
                                <td>{{$order->shipfee}}</td>
                                <td>{{$order->paymentstatus}}</td>
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

@endsection
