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
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>



</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light sloginbar shadow-sm ">
            <div class="container">


                <a class="navbar-brand text-white   " href="{{ url('staff/') }}">
                    EDE
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto ">

                        <li class="nav-item active ">
                            <a class="nav-link text-white" href="{{ URL::to('staff/') }}">Home<span class="sr-only">(current)</span></a>
                          </li>


                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Orders</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ URL::to('/staff/orderindex') }}">View All Orders</a>
                                <a class="dropdown-item" href="{{ URL::to('/staff/viewbooking') }}">View All Pick Up Booing</a>


                            @can('normalStaff')
                              <a class="dropdown-item " href="{{ URL::to('orders/createorderwithdetails') }}">Create New Order </a>
                            @endcan

                            </div>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shippment Control</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item " href="{{ URL::to('staff/charges/create') }}">Create Fee</a>
                              <!-- Dropdown menu item for create new order with details -->
                                <a class="dropdown-item" href="{{ URL::to('staff/charges') }}">View All Shipment Fee</a>
                                <a class="dropdown-item" href="{{ URL::to('staff/syslog') }}">View System Log</a>
                            </div>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link text-white" href="{{ URL::to('/live_search') }}">Track Shipment</a>
                          </li>

                          @can('acct')
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Payment</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ URL::to('/staff/viewMonPay') }}">View All Monthly Payment</a>
                            </div>
                          </li>
                          @endcan
                                
                          @can('acct')
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Report</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ URL::to('/weeklyShipmentReport') }}">Weekly Shipment Report</a>
                                <a class="dropdown-item" href="{{ URL::to('/statisticalReport') }}">Statistical Report</a>

                            </div>
                          </li>
                          @endcan

                          @can('sysAdmin')
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Staff Account</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item " href="{{ URL::to('staff/staffacct/create') }}">Create New Staff Account</a>
                              <!-- Dropdown menu item for create new order with details -->
                                <a class="dropdown-item" href="{{ URL::to('staff/staffacct') }}">View All Staff Account</a>
                            </div>
                          </li>
                          @endcan

                          @can('normalStaff')
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Customer Account</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item " href="{{ URL::to('staff/profile/create') }}">Create New Customer Account</a>
                              <!-- Dropdown menu item for create new order with details -->
                                <a class="dropdown-item" href="{{ URL::to('staff/profile/all') }}">View All Customer Account</a>
                            </div>
                          </li>
                          @endcan




                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                        @else


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->stfName }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                                    <a class="dropdown-item" href="{{ route('staff.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" class="d-none">
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
                <button type="button" class="close" data-dismiss="alert">??</button>
                <strong>{{ $message }}</strong>
                </div>
            @endif


            @yield('content')
        </main>

    </div>
</body>
</html>
