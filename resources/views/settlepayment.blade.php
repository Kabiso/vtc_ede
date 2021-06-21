@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header text-white font-weight-bold cloginbar">Settle Payment  </div>

                <div class="card-body ">

                    <div class="row text-center">
                    <label class="col-6 text-right">Order Number:</label>
                    
                    <span class="col-4 text-left"> {{ $order ->orderid}}</span>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6 text-right">Shipment Fee:</div>
                        <div class="col-4 text-left">{{   $order->shipfee     }}</div>
                      </div>
                     
                    
                    <div class="row mt-3 ">
                        <div class="col-4 mx-auto" id="paypal-payment-button"></div>
                    </div>
                     
                    <div class="row mt-3 " style="display: hidden;">
                        <form action="/settlepayment/{{$order->orderid}}/success" method="POST" id="form">
                            @csrf
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
                $('form').submit();
            })
        },

        onCancel: function(data) {
            return;
        }
    }).render('#paypal-payment-button');
    </script>

@endsection
