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
                <div class="card-header text-white font-weight-bold sloginbar">{{ __('View Shipment Fee') }}</div>

                <div class="card-body">
                   
                    
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Shipment Type</th>
                              <th scope="col">Shipment Area</th>
                              <th scope="col">Shipment Weight</th>
                              <th scope="col">Shipment Fee</th>
                              <th scope="col" class="pl-3">Edit</th>
                              <th scope="col">Delete</th>
                            </tr>
                          </thead>

                          <tbody id="tb">
                            @foreach($charges as $charge)
                            <tr>
                                <td>{{$charge->chargeid }}</td>
                                <td>{{$charge->shiptype}}</td>
                                <td>{{$charge->shiparea}}</td>
                                <td>{{$charge->shipweight}}</td>
                                <td>{{$charge->shipfee}}</td>
                                <td><button class="btn btn-success" onclick="window.location='/staff/charges/{{ $charge->chargeid }}/edit'"  >Edit</button></td>
                                <td>
                                    <form action="/staff/charges/{{ $charge->chargeid }}" method="POST" onsubmit="return confirm('Confirm to delete? ')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            
                          </tbody>
                         
                    </table>
                    {{$charges->links()}}
                   
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
