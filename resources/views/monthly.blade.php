@extends('layouts.app')

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
                <div class="card-header text-white font-weight-bold cloginbar">{{ __('View Monthly Payment') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">Order Number</th>
                              <th scope="col">Shipment Fee</th>
                              <th scope="col">View Order Payment</th>
                              <th scope="col">By Credit Card</th>
                              <th scope="col">By PayPal</th>
                            </tr>
                          </thead>

                          <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->orderid}}</td>
                                <td>{{$order->shipfee}}</td>
                                <td><button class="btn btn-info text-white" onclick="window.location='viewOrderDetail/{{$order->orderid  }}'"  >View Order </button></td>
                                <td>
                                    <button class="btn btn-success" onclick="window.location=''"  >Credit Card</button>
                                </td>
                                <td>
                                    <button class="btn btn-success" onclick="window.location=''"  >PayPal</button>
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
</div>
@endsection
