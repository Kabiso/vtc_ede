<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Eastern Delivery Express Limited</title>

    
     <!-- JavaScript for Bootstrap -->
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>

        $(document).ready(function () {
            var limit = {{ Auth::user()->creditLimit}}; 
            
        
            var payment = {{ App\Order::WHERE('custid', Auth::user()->id)->where('paymentstatus', 'Waiting to Pay') ->sum('shipfee')}} ;
           var credit =  limit -  payment;

            //console.log(payment);
           if(credit < 0 )
           {
               $('#credit').css("color","red");
               $('#cpayment').hide();
               $('#cpayment1').show();
           }else{
            $('#cpayment1').hide();
           $('#cpayment').show();
           }
                $('#credit').html(credit);
        });
    </script>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light cloginbar shadow-sm ">
            <div class="container">

                
                <a class="navbar-brand text-white   " href="{{ url('/') }}">
                    EDE
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto ">
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View Orders</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       
                            <a class="dropdown-item" href="{{ URL::to('orders/viewAll') }}">View All Orders</a>
                         
                            <a class="dropdown-item" href="{{ URL::to('orders/orderindex') }}">View Copy Orders & Edit</a>
                            </div>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create Orders</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item" href="{{ URL::to('orders/createorderwithdetails') }}">Create Export Order</a>
                                 <a class="dropdown-item" href="{{ URL::to('orders/createorderwithdetailsb') }}">Create Import Order</a>
                                 </div>
                        
                          
                          <li class="nav-item">
                            <a class="nav-link text-white" href="{{ URL::to('monthlypay/') }}">Monthly Payment Orders</a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link text-white" href="{{ URL::to('/live_search') }}">Track Shipment</a>
                          </li>
                      

                    </ul>
                   
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                  
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            
                        @else  
                            <li class="nav-item mr-5">
                                <span class="nav-link text-white">
                                    <span>Credit :</span>
                                    <span id="credit"></span>
                                    <span>/ {{Auth::user()->creditLimit}}</span>
                                </span>
                            </li>
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->custname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a href="{{ route('change.password') }}" class="dropdown-item">
                                    {{ __('Change Password') }}    
                                    </a> 

                                    <a href="/profile/{{ Auth::user()->id }}/edit" class="dropdown-item">
                                        {{ __('Edit Profile ') }}    
                                    </a> 
                                  
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                             
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf

                                    </form>
                                </div>
                            </li>
                         @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        <main class="py-4">


            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
                </div>
            @endif

            @yield('content')
        </main>
    </div>


</body>
</html>
