@extends('layouts.staffhead')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white sloginbar">Pick up Booking</div>
                <div class="card-body">
                <form action="/staff/updatebooking/{{$booking->bookingid}}"  method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="bookingid" class="col-md-4 col-form-label text-md-right">{{ __('Booking ID') }}</label>

                        <div class="col-md-6">
                            <input id="bookingid" type="text" class="form-control @error('bookingid') is-invalid @enderror" name="booingid" value="{{ $booking->bookingid ?? old('bookingid') }}" readonly autocomplete="name" autofocus>     
                        </div>
                    </div> 
                    
                    <div class="form-group row">
                        <label for="orderid" class="col-md-4 col-form-label text-md-right">{{ __('Order ID') }}</label>

                        <div class="col-md-6">
                            <input id="orderid" type="text" class="form-control @error('orderid') is-invalid @enderror" name="orderid" value="{{ $booking->orderid ?? old('orderid') }}" readonly autocomplete="name" autofocus>     
                        </div>
                    </div>  


                    <div class="form-group row">
                        <label for="bookingtime" class="col-md-4 col-form-label text-md-right">{{ __('Pickup Time') }}</label>

                        <div class="col-md-6">
                            <input id="bookingtime" type="datetime-local" class="form-control @error('bookingtime') is-invalid @enderror" name="bookingtime" value="{{ date('Y-m-d\TH:i', strtotime($booking->bookingtime)) }}" required autocomplete="name" autofocus>     
                        </div>
                    </div>  

                    <div class="form-group row">
                        <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                        <div class="col-md-6">
                            <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ $booking->location ?? old('location') }}" required autocomplete="name" autofocus>     
                        </div>
                    </div> 

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
