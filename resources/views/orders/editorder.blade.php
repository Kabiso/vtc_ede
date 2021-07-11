@extends('layouts.app')

   
@section('content')


<style>

#creditcard{
    display: none;
}

#cheque
{
    display: none;
}

#paymentstatus
{
    display: none;
}


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


<script>
    
$(document).ready(function () {
    var counter = 1;

    $("#addrow").on("click", function () {
        counter++;

        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><input type="text"  size="10"  name="itemHamoCode[]' + counter + '"/></td>';
        cols += '<td><input type="text"   size="13"  name="desc[]' + counter + '"/></td>';
        cols += '<td><input type="number"  size="3"  name="itemQty[]' + counter + '"/></td>';
        cols += '<td><input type="number"   size="5" name="weight[]' + counter + '"/></td>';
        cols += '<td><input type="number"   size="3" name="cost[]' + counter + '"/></td>';
        cols += '<td><input type="number"     size="5" name="price[]' + counter + '"/></td>';
        cols += '<td><input type="text" size="5"  name="lineweight[]' + counter + '" readonly="readonly"/></td>';
        cols += '<td><input type="text" size="5" name="lineprice[]' + counter + '" readonly="readonly"/></td>';
        cols += '<td><input type="text"  size="5" name="linecost[]' + counter + '" readonly="readonly"/></td>';
        cols += '<td><a class="deleteRow"> x </a></td>';
        newRow.append(cols);

        $("table.order-list").append(newRow);
    });

    $("table.order-list").on("change", 'input[name^="weight[]"], input[name^="itemQty[]"]', function (event) {
        calculateRow($(this).closest("tr"));
        calculateGrandTotal();
    });

    $("table.order-list").on("click", "a.deleteRow", function (event) {
        $(this).closest("tr").remove();
        calculateGrandTotal();
    });
    $("table.order-list").on("change", 'input[name^="price[]"], input[name^="itemQty[]"]', function (event) {
        calculateRow($(this).closest("tr"));
        calculatePriceTotal();
    });

    $("table.order-list").on("click", "a.deleteRow", function (event) {
        $(this).closest("tr").remove();
        calculatePriceTotal();
    });

    $("table.order-list").on("change", 'input[name^="cost[]"], input[name^="itemQty[]"]', function (event) {
        calculateRow($(this).closest("tr"));
        calculateCostTotal();
    });
    $("table.order-list").on("click", "a.deleteRow", function (event) {
        $(this).closest("tr").remove();
        calculateQtyTotal();
    });
    $("table.order-list").on("change", 'input[name^="itemQty[]"]', function (event) {
        calculateRow($(this).closest("tr"));
        calculateQtyTotal();
    });

    $("table.order-list").on("click", "a.deleteRow", function (event) {
        $(this).closest("tr").remove();
        calculateCostTotal();
    });


// Calculate the  ship fee
$("#shipcountries, #totalweight").change(function(){
        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        
        var weight = $("#totalweight").val();
        var shipcou = $("#shipcountries").val();
        
        weight <= 3 ? $("#shiptype").val('Global Service') : $("#shiptype").val('EDE EXPRESS FREIGHT Service');
        
        
    
      
        $.ajax({
        type : 'get',
        url : '{{URL::to('orderdetails/calfee')}}',
        data:{
            weight: weight, 
            shipcou: shipcou,
    
        },
        success:function(arr){
            console.log(arr);
            $("#shipfee").val(arr.shipfee);
        }
        });
        
    });
    







});

function calculateRow(row) {
    var cost = +row.find('input[name^="cost[]"]').val();
    var price = +row.find('input[name^="price[]"]').val();
    var weight= +row.find('input[name^="weight[]"]').val();
    var qty = +row.find('input[name^="itemQty[]"]').val();
    row.find('input[name^="lineweight[]"]').val((weight * qty).toFixed(2));
    row.find('input[name^="lineprice[]"]').val((price * qty).toFixed(2));
    row.find('input[name^="linecost[]"]').val((cost * qty).toFixed(2));
    row.find('input[name^="lineqty[]"]').val((qty).toFixed(2));
  // row.find('input[name^="totalweight[]"]').val((weight * qty).toFixed(2));



}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="lineweight[]"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
    $("#tweight .form-control").val(grandTotal.toFixed(2));
    $("#totalweight").trigger('change');
    
}

function calculatePriceTotal() {
    var priceTotal = 0;
    $("table.order-list").find('input[name^="lineprice[]"]').each(function () {
        priceTotal += +$(this).val();
    });
    $("#pricetotal").text(priceTotal.toFixed(2));
    $("#tprice .form-control").val( priceTotal.toFixed(2));
}
function calculateCostTotal() {
    var costTotal = 0;
    $("table.order-list").find('input[name^="linecost[]"]').each(function () {
        costTotal += +$(this).val();
    });
    $("#costtotal").text(costTotal.toFixed(2));
    $("#tcost .form-control").val( costTotal.toFixed(2));
}
function calculateQtyTotal() {
    var qtyTotal = 0;
    $("table.order-list").find('input[name^="itemQty[]"]').each(function () {
        qtyTotal += +$(this).val();
    });
    $("#tqty .form-control").val( qtyTotal);
}

//payment selection
$('#creditcard').hide();
$(function(){
    var pay ='Paid';
    var pay2 ='Waiting to Pay';
    $('#payment .form-control').change(function(){
       var opt = $(this).val();
        if(opt == 'Credit Card'){

            var pay ='Paid';
            $('#creditcard').show();
            $('#cheque').hide();
            

        $("#paystatust select").val(pay);
  
     
     
        }else if(opt == 'Cash'){
            var pay ='Paid';
            $('#creditcard').hide();
            $('#cheque').hide();
            $("#paystatust select").val(pay);
  
        }else if(opt == 'Cheque'){
            var pay ='Paid';
            $('#creditcard').hide();
            $('#cheque').show();
            $('#paystatust select').val(pay);
  
                  
           }else if(opt == 'Monthly Pay'){
            var pay ='Waiting to Pay';
            $('#creditcard').hide();
            $('#cheque').hide();
  
          
        $("#paystatust select").val(pay);
           }else if(opt == 'Pay Pal'){
            var pay ='Pay Online';
            $('#creditcard').hide();
            $('#cheque').hide();  
          
        $("#paystatust select").val(pay);
           }else if(opt == 'Wait to Calculate the Weight of the goods'){
            var pay ='Wait to Calculate the Weight';
            $('#creditcard').hide();
            $('#cheque').hide();
              
          
        $("#paystatust select").val(pay);
        }
    });
});
//end payment selection


//$(document).ready(function(){

 //fetch_customer_data();

 //function fetch_customer_data(query = '')
 //{
 /// $.ajax({
  // url:"",
  // method:'GET',
  // data:{query:query},
  // dataType:'json',
  // headers: {
   //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   //     },
   //success:function(data)
  // {
       
   // $('tbody').html(data.table_data);
   // $('#total_records').text(data);
  // }
  //})
// }

// $(document).on('keyup', '#search', function(){
 // var query = $(this).val();
  //fetch_customer_data(query);
// });
//});




</script>
@if((Auth::guard('web')->check()))
<div class="container col-md-10">

@else
<h1>Staff Page</h1>
<div class="container col-md-10">
@endif
<h1>Edit a Shipment Order</h1>

{!! Form::open(['action' =>['OrderController@updateorder',$order->orderid], 'method' => 'post','files'=>true])!!}
@csrf
<div class="card">
<div class="card-header text-white cloginbar">Sender  Information</div>


<div class="row mt-3 ">    
    <div class="col-4 text-right ">{{ Form::label('custid', 'Customor Account No.') }}</div>
   
    <div class="col-4">{{ Form::text('custid',old('custid') ?? $order->custid,array('class' => 'form-control')) }}</div>
    
</div>

<!-----
<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('creditLimit', 'Sender  Credit Limit') }}</div>
    <div class="col-4">{{ Form::text('creditLimit', Auth::user()->creditLimit, array('class' => 'form-control','readonly')) }}</div>

</div> --->




<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('custname', 'Sender  Name') }}</div>
    <div class="col-4">{{ Form::text('custname', old('custname') ?? $order->custname, array('class' => 'form-control')) }}</div>

</div>




<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('custphone', 'Sender  Phone Number') }}</div>
    <div class="col-4">{{ Form::text('custphone',  old('custphone') ?? $order->custphone, array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('custpostcode', 'Sender  Post Code') }}</div>
    <div class="col-4">{{ Form::text('custpostcode', old('custpostcode') ?? $order->custpostcode, array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('cutarea', 'Sender  Country') }}</div>
    <div class="col-4">{{ Form::select('custarea', array('AUSTRALIA' => 'AUSTRALIA', 'JAPAN' => 'JAPAN','CHINA' => 'CHINA', 'HONG KONG' => 'HONG KONG'), old('custarea') ?? $order->custarea, array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3 mb-3">

    <div class="col-4 text-right">{{ Form::label('custaddress', 'Sender  Address') }}</div>
    <div class="col-4">{{ Form::text('custaddress', old('custaddress') ?? $order->custaddress, array('class' => 'form-control')) }}</div>

</div>


</div>







<div class="card">
<div class="card-header text-white cloginbar">Receiver Information</div>

<!--<div class="row">

    <div class="col-4 text-right">{{ Form::label('receid', 'Receiver Number') }}</div>
    <div class="col-4">{{ Form::text('receid', old('receid'), array('class' => 'form-control')) }}</div>

</div>
-->


<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('receCompanyname', 'Receiver Company Name') }}</div>
    <div class="col-4">{{ Form::text('receCompanyname', old('receCompanyname') ?? $order->receCompanyname, array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('recename', 'Receiver Name') }}</div>
    <div class="col-4">{{ Form::text('recename', old('recename') ?? $order->recename, array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('receEmail', 'Receiver Email') }}</div>
    <div class="col-4">{{ Form::text('receEmail', old('receEmail') ?? $order->receEmail, array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('recephone', 'Receiver Phone Number/Fax Number') }}</div>
    <div class="col-4">{{ Form::text('recephone', old('recephone') ?? $order->recephone, array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('recepostcode', 'Receiver Post Code') }}</div>
    <div class="col-4">{{ Form::text('recepostcode', old('recepostcode') ?? $order->recepostcode, array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('recearea', 'Receiver Country') }}</div>
    <div class="col-4">{{ Form::select('recearea', array('AUSTRALIA' => 'AUSTRALIA', 'JAPAN' => 'JAPAN','CHINA' => 'CHINA', 'HONG KONG' => 'HONG KONG'), old('custarea') ?? $order->recearea, array('class' => 'form-control')) }}</div>

</div>

<div class="row my-3">

    <div class="col-4 text-right">{{ Form::label('receaddress', 'Receiver Address') }}</div>
    <div class="col-4">{{ Form::text('receaddress', old('receaddress') ?? $order->receaddress, array('class' => 'form-control')) }}</div>

</div>

<div class="row my-3">

    <div class="col-4 text-right">{{ Form::label('remark', 'Remark') }}</div>
    <div class="col-4">{{ Form::text('remark', old('remark') ?? $order->remark, array('class' => 'form-control')) }}</div>

</div>






</div>







<div class="card">
<div class="card-header text-white cloginbar">Payment Information</div>
<!--<div class="row">

    <div class="col-4 text-right">{{ Form::label('tax', 'tax') }}</div>
    <div class="col-4">{{ Form::number('tax', old('tax')  , array('class' => 'form-control')) }}</div>

</div> -->


<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('paymemt', 'Payment Mothed') }}</div>
    <div class="col-4" id = "payment"> {!! Form::select('paymemt', array('Wait to Calculate the Weight of the goods' => 'Wait to Calculate the Weight of the goods', 'Cash' => 'Cash', 'Cheque' => 'Cheque', 'Pay Pal' => 'Pay Pal','Credit Card' => 'Credit Card', 'Monthly Pay' => 'Monthly Pay'), $order->paymemt ?? old('paymemt'), array('class' => 'form-control')); !!}</div>
    <!--<div class="col-4">{{ Form::text('paymemt', old('payment') , array('class' => 'form-control')) }}</div> -->

</div>


<div id="creditcard">
<div class="row mt-3 ">

    <div class="col-4 text-right"  >{{ Form::label('cardtype', 'Credit Card Type') }}</div>
    <div class="col-4" >{!! Form::select('cardtype', array('Visa' => 'Visa', 'Master' => 'Master', 'AE' => 'AE', 'UniPay' => 'UniPay'), old('cardtype') ?? $order->cardtype, array('class' => 'form-control')); !!}</div>

</div>
<div class="row mt-3">

    <div class="col-4 text-right" >{{ Form::label('cardnum', 'Credit Card Numnber') }}</div>
    <div class="col-4" >{{ Form::text('cardnum', old('cardnum') ?? $order->cardnum, array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('vaDate', 'Valid Thru Date') }}</div>
    <div class="col-4"  >{{ Form::input('date','vaDate', old('vaDate') ?? $order->vaDate, array('class' => 'form-control')) }}</div>

</div>
</div>

<div id="cheque">
<div class="row mt-3 ">

    <div class="col-4 text-right">{{ Form::label('chequednum', 'Cheque Number') }}</div>
    <div class="col-4" >{{ Form::text('chequednum', old('chequednum') ?? $order->chequednum, array('class' => 'form-control')) }}</div>

</div>
</div>

<div id="paymentstatus">
<div class="row mt-3">

    <div class="col-4 text-right" >{{ Form::label('paymentstatus', 'Payment Status') }}</div>
    <div class="col-4" id = 'paystatust'>{!! Form::select('paymentstatus', array('Paid' => 'Paid', 'Waiting to Pay' => 'Waiting to Pay','Wait to Calculate the Weight' => 'Wait to Calculate the Weight','Pay Online' => 'Pay Online'), old('paymentstatus') ?? $order->paymentstatus, array('class' => 'form-control')); !!}</div>

</div>
</div>


<div class="row my-3">

    <div class="col-4 text-right">{{ Form::label('totalweight', 'Total Weight') }}</div>
    <div class="col-4" id="tweight">{{ Form::number('totalweight', old('totalweight') ?? $order->totalweight, array('class' => 'form-control','readonly')) }}</div>

</div>


<div class="card">
<div class="card-header text-white cloginbar">Shipment Information</div>
<div class="card-body">

<div class="row">

    <div class="col-4 text-right">{{ Form::label('shiptype', 'Shipment Type') }}</div>
    <div class="col-4">{!! Form::select('shiptype', array('Global Service' => 'DOCUMENT ENVELOPE GLOBAL Service', 'EDE EXPRESS FREIGHT Service' => 'EDE EXPRESS FREIGHT Service'), old('shiptype') ?? $order->shiptype, array('class' => 'form-control')); !!}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('shipcountries', 'Shipment Countries') }}</div>
    <div class="col-4">{!! Form::select('shipcountries', array('AUSTRALIA' => 'AUSTRALIA', 'JAPAN' => 'JAPAN','CHINA' => 'CHINA'), old('shipcountries') ?? $order->shipcountries, array('class' => 'form-control')); !!}</div>

</div>

<div >
<div class="row mt-3">
    <div class="col-4 text-right">{{ Form::label('shipfee', 'Shipment Fee') }}</div>
   
  @if((Auth::guard('web')->check()))
    <div class="col-4">{{ Form::text('shipfee',old('shipfee') ?? $order->shipfee, array('class' => 'form-control','readonly')) }}</div>
    @else
    <div class="col-4" >{{ Form::text('shipfee', old('shipfee') ?? $order->shipfee, array('class' => 'form-control')) }}</div>
    @endif

 </div>
</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('totalqty', 'Total Qty') }}</div>
    <div class="col-4" id="tqty">{{ Form::number('totalqty', old('totalqty') ?? $order->totalqty, array('class' => 'form-control','readonly')) }}</div>

</div>
<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('totalcost', 'Total Cost') }}</div>
    <div class="col-4" id="tcost">{{ Form::number('totalcost', old('totalcost') ?? $order->totalcost, array('class' => 'form-control','readonly')) }}</div>

</div>


<div class="row my-3">

    <div class="col-4 text-right">{{ Form::label('totalamount', 'Total Amount') }}</div>
    <div class="col-4" id="tprice">{{ Form::number('totalamount', old('totalamount') ?? $order->totalamount, array('class' => 'form-control','readonly')) }}</div>

</div>
</div>
</div>



<!-- Detail Form -->
<div class="card">
<div class="card-header text-white cloginbar">Shipment Items</div>
<table class="order-list mt-3">
    <thead >
    <th ><p style="font-size:10px">Harmonized Code </p></th>
                        <th><p style="font-size:10px">Full Description of Goods</p></th>
                        <th><p style="font-size:10px">No of items</p></th>
                        <th><p style="font-size:5px">Unit Weight</p></th>
                        <th><p style="font-size:5px">Unit Cost</p></th>
                        <th><p style="font-size:5px">Unit Price</p></th>
                        <th><p style="font-size:5px">Wiegth total</p></th>
                        <th><p style="font-size:5px">Price total</p></th>
                        <th><p style="font-size:5px">Cost total</p></th>
    </thead>

    <tbody>
        @foreach($order->orderdetails as $od)
        <tr>
            <td><input type="text" size="10" name="itemHamoCode[]" value="{{$od->itemHamoCode}}" /></td>
            <td><input type="text" size="13" name="desc[]" value="{{$od->desc}}" /></td>
            <td><input type="number" size="3" step="1" name="itemQty[]" value="{{$od->itemQty}}" /></td>
            <td><input type="number" size="5" name="weight[]" value="{{$od->weight}}"/></td>
            <td><input type="number" size="3" name="cost[]" value="{{$od->cost}}" /></td>
            <td><input type="number" size="5" name="price[]" value="{{$od->price}}" /></td>
            <td><input type="text" size="5" name="lineweight[]" readonly="readonly"  value="{{$od->lineweight}}"/></td>
            <td><input type="text" size="5" name="lineprice[]" readonly="readonly"  value="{{$od->lineprice}}"/></td>
            <td><input type="text" size="5" name="linecost[]" readonly="readonly"  value="{{$od->linecost}}"/></td>
            <td><a class="deleteRow"> x </a></td>
        </tr>
        @endforeach
    </tbody>

    <tfoot >
        <tr>
            <td colspan="9" style="text-align: center;">
                <input type="button" id="addrow" value="Add Item" />
            </td>
        </tr>

        <tr>
            <td colspan="5">
                Weight Total:<span id="grandtotal">{{$order->totalweight}}</span>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                Grand Total: $<span id="pricetotal">{{$order->totalamount}}</span>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                Cost Total: $<span id="costtotal">{{$order->totalcost}}</span>
            </td>
        </tr>
    </tfoot>
</table>
     <!--       <td colspan="5" style="btn btn-default pull-left;">
                <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" />
            </td>-->
        </tr>
        <tr>
        </tr>
    </tfoot>
    <div id="grandtotal"></div>
   <!--            <div class="row">
                <div class="col-md-12">
                    <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
         /           {{ Form::button('+ Add Row', array('class' => 'btn btn-default pull-left','type'=>'button')) }}
                    <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                </div>
            </div>
        </div>-->
</div>

<!-- display tracking shipment -->
<div class="card" style="text-align: center">
    <div class="card-header text-white cloginbar">Update Tracking Shipment</div>

    

           <table class="table table-striped table-bordered" style="text-align: center">
               <thead>
                <tr>
                 <th class="col-4">{{ Form::label('status', 'Status') }}</th>
                 <th class="col-4">{{ Form::label('location', 'Location') }}</th>
                </tr>
                <tr>  
                 <th class="col-4">{!! Form::select('status', array( null=>'Please Select' , 'Cancel'=> 'Cancel' ), null, array('class' => 'form-control')); !!}</th>
                 <th class="col-4">{!! Form::select('location', array(null=>'Please Select','Cancel Order By Customer' => 'Cancel Order By Customer'),'Please Select', array('class' => 'form-control')); !!}</th>
               </tr>
               </thead>
              </table>


    <table class="table table-striped table-bordered">
        <thead>
         <tr>
            <th><p >Status</p></th>
            <th><p >Time</p></th>
            <th><p >Location</p></th>
        </tr>
        </thead>    
        <tbody>  
          @foreach (App\Trackshipment::where('orderid', $order->orderid)->orderBy('created_at', 'DESC')->get() as $trackshipment)
           <tr>
            <td >{{$trackshipment->status}}</td>
            <td >{{$trackshipment->created_at}}</td>
            <td >{{$trackshipment->location}}</td> 
           </tr>
          @endforeach
        </tbody>
       </table>
    </div>
   
 <!-- update tracking shipment --> 
 
</div>

<div class="row my-3">
    <div class="col-2"></div>
    <div class="col-8 text-center">{{ Form::submit('Update the Order!', array('class' => 'btn btn-primary')) }}</div>
    <div class="col-2"></div>
</div>
</div>
{{ Form::close() }}

@endsection
