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
                <div class="card-header text-white font-weight-bold sloginbar">{{ __('View Pick Up Booking') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">Booking ID</th>
                              <th scope="col">Order ID</th>
                              <th scope="col">Pickup Time</th>
                              <th scope="col">Location</th>
                              <th scope="col">Edit</th>
                              <th scope="col">View order</th>
                              
                            </tr>
                          </thead>

                          <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{$booking->bookingid}}</td>
                                <td>{{$booking->orderid}}</td>
                                <td>{{$booking->bookingtime}}</td>
                                <td>{{$booking->location}}</td>
                                <td><button class="btn btn-success text-white" onclick="window.location='/staff/editbooking/{{$booking->bookingid}}'" >Edit</button>
                                </td>

                                <td><button class="btn btn-info text-white" onclick="window.location='/viewOrderDetail/{{$booking->orderid}}'"  >View Order</button></td>
                                
                            </tr>
                            @endforeach

                          </tbody>

                    </table>
                    {{ $bookings->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



