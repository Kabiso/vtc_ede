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
                <div class="card-header text-white font-weight-bold sloginbar">{{ __('View Customer Monthly Payment') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">Order ID</th>
                              <th scope="col">Date</th>
                              <th scope="col">Payment status</th>
                             
                              <th scope="col">Shipment Fee</th>
                              <th scope="col">View Order Payment</th>
                              <th scope="col">Confirm Payment</th>
                            </tr>
                          </thead>

                          <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->orderid}}</td>
                                <td>{{$order->createddate->format('Y/m/d')}}</td>
                                <td>{{$order->paymentstatus}}</td>
                                
                                <td>{{$order->shipfee}}</td>
                                <td><button class="btn btn-info text-white" onclick="window.location='/viewOrderDetail/{{$order->orderid}}'"  >View Order</button></td>
                                <td><form action="/staff/viewMonPay/{{$order->orderid }}" method="POST" onsubmit="return confirm('Payment Confirm ?')">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Confirm Payment</button>
                                </form>
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



