@extends('layouts.staffhead')

@section('content')

<script>
    $(document).ready(function () {
                            $("#myInput").on("keyup", function () {
                                var value = $(this).val().toLowerCase();
                                $("#tb tr").filter(function () {
                                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                });
                            });
                        });
 
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session('message'))
            <div class="alert alert-success mb-2">
             {{ session()->get('message') }}
            </div>  
            @endif
           
            <div class="card">
                <div class="card-header text-white font-weight-bold sloginbar">{{ __('View System Log') }}</div>
                <input id="myInput" type="text" placeholder="Search"></div>
                <div class="card-body">
                   
                    
                    <table class="table" id='table'>
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">User Id</th>
                              <th scope="col">User Name</th>
                              <th scope="col">Order ID /Booking ID/Shipment Fee ID</th>
                              <th scope="col">Action Code</th>
                              <th scope="col">Action</th>
                                                
                            </tr>
                          </thead>

                          <tbody id="tb">
                            @foreach($syslog as $sys)
                            <tr>
                                <td>{{$sys->syslogid }}</td>
                                <td>{{$sys->userid}}</td>
                                <td>{{$sys->username}}</td>
                                <td>{{$sys->oid}}</td>
                                <td>{{$sys->actioncode}}</td>
                                <td>{{$sys->action}}</td>
                                                                   </form>
                                </td>
                            </tr>
                            @endforeach
                            
                          </tbody>
                         
                    </table>
                    {{$syslog->links()}}
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>


















<!-----------
<script>
   $(document).ready(function(){
   fetch_customer_data();

function fetch_customer_data(query = '')
{
 $.ajax({
  url:"/staff/action",
  method:'GET',
  data:{query:query},
  dataType:'json',
  success:function(data)
  {
   $('tbody').html(data.table_data);
  }
 })
}

$(document).on('keyup', '#search', function(){
 var query = $(this).val();
 fetch_customer_data(query);
});
});
</script>
---->
@endsection
