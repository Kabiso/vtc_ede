@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session('message'))
            <div class="alert alert-success mb-2">
             {{ session()->get('message') }}
            </div>
            @endif
            <div class="input-group">
            
            </div>
            <div class="card">
                <div class="card-header text-white font-weight-bold cloginbar">{{ __('View Monthly Payment') }}</div>
                <div class="d-flex justify-content-between">
                    <input type="month"  id=myy class="form-control mt-3 col-md-2 ml-3" value="{{Carbon\Carbon::now()->format('Y-m')}}">
                    <div class="mt-3" id="gminvoice" ><button  class="btn btn-primary ">Generate Monthly Invoice</button> </div>
                    <div class="col-md-3  text-right font-weight-bold mt-4 text-primary" style="font-size: 16px;" id="tshipfee"></div>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Order Payment Status</th>
                              <th scope="col">Order Number</th>
                              <th scope="col">Date</th>
                              <th scope="col">Shipment Fee</th>
                              <th scope="col">View Order Payment</th>
                              <th scope="col">View Order Invoice</th>
                            </tr>
                          </thead>

                          <tbody id="tbb">
                            
                           

                          </tbody>

                    </table>
                   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

$(document).ready(function(){
    

    getMonthlypay($("#myy").val());

    $('#myy').on('change', function() {
    var searchdate = $("#myy").val();

    getMonthlypay(searchdate);

});


 function getMonthlypay(searchdate){
    $.ajax({
   url:"{{ route('monthlypay.searchdate') }}",
   method:'GET',
   data:{date:searchdate},
   dataType:'json',
   success:function(data)
   {
    $('#tbb').html(data.output);
    $('#tshipfee').html('Total Shipment Fee: ' + data.totalshipfee);
    
    console.log(data.showbtnflag);

    data.showbtnflag == 0 ? $("#gminvoice").show() : $("#gminvoice").hide();


   }

})

 }

    

 $('#gminvoice').click(function(){
        window.location= "monthlyinvoice/"+ $("#myy").val();
    });


});

</script>
