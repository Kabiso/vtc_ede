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
                <div class="card-header text-white font-weight-bold sloginbar">Orders </div>
                <div class="card-body ">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order Status</th>
                              <th scope="col">Order Number</th>
                              <th scope="col">User ID</th>

                              <th scope="col">Shipment Type</th>
                              
                              <th scope="col">Shipment Fee</th>
                              <th scope="col">Payment Status</th>
                              <th scope="col">View Detail</th>
                              <th scope="col">Edit</th>
                              <th scope="col">Change Status</th>
                              
                              
                            </tr>
                          </thead>

                          <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->orderstatus}}</td>
                                <td>{{$order->orderid}}</td>
                                <td>{{$order->custid}}</td>

                                <td>{{$order->shiptype}}</td>
                                <td>{{$order->shipfee}}</td>
                                <td>{{$order->paymentstatus}}</td>
                                <td><button class="btn btn-info text-white" onclick="window.location='/viewOrderDetail/{{$order->orderid}}'" >View Detail</button></td>
                                <td>
                                    @if ($order->orderstatus == 'Complete')
                                    <button class="btn btn-secondary text-white"  >Completed</button>
                                    @elseif ($order->orderstatus == 'Cancel')
                                    <button class="btn btn-secondary text-white"  >Canceled</button>
                                    @else
                                    <button class="btn btn-success text-white" onclick="window.location='/staff/orderedit/{{$order->orderid}}'" >Edit</button>   
                                    @endif
                                </td>
                                <td><form action="/staff/changestatus/{{$order->orderid}}" method="post" onsubmit="return confirm('Do you want to Change the order status?') ;">
                                    @csrf
                                    <select class="custom-select" id="status" name="status">
                                        <option selected>Select status </option>
                                        <option value="Ready for delivery">Ready for delivery</option>
                                        <option value="Delivery in progress">Delivery in progress</option>
                                        <option value="Delivery within 24 hours">Delivery within 24 hours</option>
                                        <option value="Delivery within 12 hours">Delivery within 12 hours</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Received">Received</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Cancel">Cancel</option>
                                    </select>
                                    <button type="submit" class="btn btn-warning " style="width: 100%">Change</button>
                                </form></td>

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
