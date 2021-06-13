<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Garage Management System</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    
  <!-- JavaScript for Bootstrap -->
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    
    <!-- Start of navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <!-- Menu bar title -->
      <a class="navbar-brand" href="#">GMS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <!-- Home button -->
          <li class="nav-item active">
            <a class="nav-link" href="{{ URL::to('orders/') }}">Home<span class="sr-only">(current)</span></a>
          </li>
          
          <!-- View all Orders button -->
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('orders/') }}">View All Orders</a>
          </li>
          
          <!-- View all Order Detail button -->
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('orderdetails/') }}">View All Order Details</a>
          </li>
          
          <!-- Dropdown menu with toggle for create new order -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manipulate Orders</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ URL::to('orders/create') }}">Create New Order</a>
            </div>
          </li>
          
          <!-- Dropdown menu without toggle for create new order details -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manipulate Order Detail</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ URL::to('orderdetails/create') }}">Create New Order Detail</a>
              <!-- Dropdown menu item for create new order with details -->
<a class="dropdown-item" href="{{ URL::to('orders/createorderwithdetails') }}">Create New Order with Details</a>

            </div>
          </li>
        </ul>
      </div>
    </nav>
  <!-- End of navigation bar -->
  
  <!-- Start of show message -->
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

  <!-- End of show message -->
  
  <!-- Start of child content -->
  @yield('content')
  <!-- End of child content -->
  
  </div>

</body>
</html>
