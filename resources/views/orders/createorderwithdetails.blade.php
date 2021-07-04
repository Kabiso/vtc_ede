@extends( (Auth::guard('web')->check()) ? 'layouts.app' : 'layouts.staffhead')

   
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

    //AUTO FILL IN CUSETOMER DATA FOR STAFF SIDE

    $("#custid").on('change',function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    var value=$(this).val();
    
    $.ajax({
    type : 'get',
    url : '{{URL::to('staff/ordersearch')}}',
    data:{search: value,

    },
    success:function(arr){

        $("#custname").val(arr.cname);
        $("#custphone").val(arr.cphone);
        $("#custaddress").val(arr.caddress);
        
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
  
                  
           }else if(opt == 'Monthely Pay'){
            var pay ='Waiting to Pay';
            $('#creditcard').hide();
            $('#cheque').hide();
  
          
        $("#paystatust select").val(pay);
           }else if(opt == 'Pay Pal'){
            var pay ='Paid';
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






$(function(){
    var pay ='';
    var pay2 ='Waiting to Pay';
    $('#cpayment .form-control').change(function(){
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
  
                  
           }else if(opt == 'Monthely Pay'){
            var pay ='Waiting to Pay';
            $('#creditcard').hide();
            $('#cheque').hide();
  
          
        $("#paystatust select").val(pay);
           }else if(opt == 'Pay Pal'){
            var pay ='Paid';
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



$(function(){
    var pay ='Paid';
    var pay2 ='Waiting to Pay';
    $('#cpayment1 .form-control').change(function(){
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
  
                  
           }else if(opt == 'Monthely Pay'){
            var pay ='Waiting to Pay';
            $('#creditcard').hide();
            $('#cheque').hide();
  
          
        $("#paystatust select").val(pay);
           }else if(opt == 'Pay Pal'){
            var pay ='Paid';
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







</script>




@if((Auth::guard('web')->check()))
<div class="container col-md-10">

@else
<h1>Staff Page</h1>
<div class="container col-md-10">
@endif
<h1>Create a Shipment Order</h1>

{!! Form::open(['action' =>'OrderController@storewithdetails', 'method' => 'POST','files'=>true])!!}
@csrf
<div class="card">
<div class="card-header text-white cloginbar">Customer Information</div>


<div class="row mt-3 ">    
    <div class="col-4 text-right ">{{ Form::label('custid', 'Customor Account No.') }}</div>
    @if((Auth::guard('web')->check()))
    <div class="col-4">{{ Form::text('custid', Auth::user()->id, array('class' => 'form-control','readonly')) }}</div>
    @else
    <div class="col-4" id="cid">{{ Form::text('custid',old('custid'),array('class' => 'form-control')) }}</div>
    @endif
</div>

<!-----
<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('creditLimit', 'Customer Credit Limit') }}</div>
    <div class="col-4">{{ Form::text('creditLimit', Auth::user()->creditLimit, array('class' => 'form-control','readonly')) }}</div>

</div> --->




<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('custname', 'Customer Name') }}</div>
    <div class="col-4" >{{ Form::text('custname', Auth::user()->custname, array('class' => 'form-control')) }}</div>

</div>




<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('custphone', 'Customer Phone Number') }}</div>
    <div class="col-4" >{{ Form::text('custphone',  Auth::user()->contactNo, array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('custpostcode', 'Customer Post Code') }}</div>
    <div class="col-4">{{ Form::text('custpostcode', '0000', array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('cutarea', 'Customer Country') }}</div>
    <div class="col-4">{{ Form::select('custarea', array('AUSTRALIA' => 'AUSTRALIA', 'JAPAN' => 'JAPAN','CHINA' => 'CHINA', 'HONG KONG' => 'HONG KONG'), 'HONG KONG', array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3 mb-3">

    <div class="col-4 text-right">{{ Form::label('custaddress', 'Customer Address') }}</div>
    <div class="col-4" >{{ Form::text('custaddress', Auth::user()->custAddress, array('class' => 'form-control')) }}</div>

</div>


</div>




<div class="card ">
<div class="card-header text-white cloginbar">Pick up Booking</div>
<div class="card-body">
<div class="row">

    <div class="col-4 text-right ">{{ Form::label('location', 'Pickup Location') }}</div>
    <div class="col-4 ">{{ Form::text('location', old('location'), array('class' => 'form-control')) }}</div>

</div>


<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('bookingtime', 'Pickup Time') }}</div>
   
    <div class="col-4">{{ Form::input('datetime-local','bookingtime',old('bookingtime'), array('class' => 'form-control')) }}</div>

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
    <div class="col-4">{{ Form::text('receCompanyname', old('receCompanyname'), array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('recename', 'Receiver Name') }}</div>
    <div class="col-4">{{ Form::text('recename', old('recename'), array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('receEmail', 'Receiver Email') }}</div>
    <div class="col-4">{{ Form::text('receEmail', old('receEmail'), array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('recephone', 'Receiver Phone Number/Fax Number') }}</div>
    <div class="col-4">{{ Form::text('recephone', old('recephone'), array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('recepostcode', 'Receiver Post Code') }}</div>
    <div class="col-4">{{ Form::text('recepostcode', old('recepostcode'), array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('recearea', 'Receiver Country') }}</div>
    <div class="col-4">{{ Form::select('recearea', array('AUSTRALIA' => 'AUSTRALIA', 'JAPAN' => 'JAPAN','CHINA' => 'CHINA', 'HONG KONG' => 'HONG KONG'), 'HONG KONG', array('class' => 'form-control')) }}</div>

</div>

<div class="row my-3">

    <div class="col-4 text-right">{{ Form::label('receaddress', 'Receiver Address') }}</div>
    <div class="col-4">{{ Form::text('receaddress', old('receaddress'), array('class' => 'form-control')) }}</div>

</div>

<div class="row my-3">

    <div class="col-4 text-right">{{ Form::label('remark', 'Remark') }}</div>
    <div class="col-4">{{ Form::text('remark', old('remark'), array('class' => 'form-control')) }}</div>

</div>






</div>







<div class="card">
<div class="card-header text-white cloginbar">Payment Information</div>
<!--<div class="row">

    <div class="col-4 text-right">{{ Form::label('tax', 'tax') }}</div>
    <div class="col-4">{{ Form::number('tax', old('tax'), array('class' => 'form-control')) }}</div>

</div> -->


<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('paymemt', 'Payment Mothed') }}</div>
    @if((Auth::guard('web')->check()))
   
    <div class="col-4" id = "cpayment"> {!! Form::select('paymemt', array('Wait to Calculate the Weight of the goods' => 'Wait to Calculate the Weight of the goods',  'Monthely Pay' => 'Monthely Pay'), 'Wait to Calculate the Weight of the goods', array('class' => 'form-control')); !!}</div>
    <div class="col-4" id = "cpayment1"> {!! Form::select('paymemt', array('Wait to Calculate the Weight of the goods' => 'Wait to Calculate the Weight of the goods'), 'Wait to Calculate the Weight of the goods', array('class' => 'form-control')); !!}</div>
    @else
    <div class="col-4" id = "payment"> {!! Form::select('paymemt', array('Wait to Calculate the Weight of the goods' => 'Wait to Calculate the Weight of the goods', 'Cash' => 'Cash', 'Cheque' => 'Cheque', 'Pay Pal' => 'Pay Pal','Credit Card' => 'Credit Card', 'Monthely Pay' => 'Monthely Pay'), 'Wait to Calculate the Weight', array('class' => 'form-control')); !!}</div>
 
     @endif
</div>


<div id="creditcard">
<div class="row mt-3 ">

    <div class="col-4 text-right"  >{{ Form::label('cardtype', 'Credit Card Type') }}</div>
    <div class="col-4" >{!! Form::select('cardtype', array('Visa' => 'Visa', 'Master' => 'Master', 'AE' => 'AE', 'UniPay' => 'UniPay'), 'Visa', array('class' => 'form-control')); !!}</div>

</div>
<div class="row mt-3">

    <div class="col-4 text-right" >{{ Form::label('cardnum', 'Credit Card Numnber') }}</div>
    <div class="col-4" >{{ Form::text('cardnum', old('cardnum'), array('class' => 'form-control')) }}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('vaDate', 'Valid Thru Date') }}</div>
    <div class="col-4"  >{{ Form::input('date','vaDate', old('vaDate'), array('class' => 'form-control')) }}</div>

</div>
</div>

<div id="cheque">
<div class="row mt-3 ">

    <div class="col-4 text-right">{{ Form::label('chequednum', 'Cheque Number') }}</div>
    <div class="col-4" >{{ Form::text('chequednum', old('chequednum'), array('class' => 'form-control')) }}</div>

</div>
</div>

<div id="paymentstatus">
<div class="row mt-3">

    <div class="col-4 text-right" >{{ Form::label('paymentstatus', 'Payment Status') }}</div>
    <div class="col-4" id = 'paystatust'>{!! Form::select('paymentstatus', array('Paid' => 'Paid', 'Waiting to Pay' => 'Waiting to Pay','Wait to Calculate the Weight' => 'Wait to Calculate the Weight'), 'Wait to Calculate the Weight', array('class' => 'form-control')); !!}</div>

</div>
</div>


<div class="row my-3">

    <div class="col-4 text-right">{{ Form::label('totalweight', 'Total Weight') }}</div>
    <div class="col-4" id="tweight">{{ Form::number('totalweight', old('totalweight'), array('class' => 'form-control','readonly')) }}</div>

</div>


<div class="card">
<div class="card-header text-white cloginbar">Shipment Information</div>
<div class="card-body">
  
<div class="row">

    <div class="col-4 text-right">{{ Form::label('shiptype', 'Shipment Type') }}</div>
    <div class="col-4">{!! Form::select('shiptype', array('Global Service' => 'DOCUMENT ENVELOPE GLOBAL Service', 'EDE EXPRESS FREIGHT Service' => 'EDE EXPRESS FREIGHT Service'), 'DOCUMENT ENVELOPE Global Service', array('class' => 'form-control') ); !!}</div>

</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('shipcountries', 'Shipment Countries') }}</div>
    <div class="col-4">{!! Form::select('shipcountries', array('AUSTRALIA' => 'AUSTRALIA', 'JAPAN' => 'JAPAN','CHINA' => 'CHINA'), 'JAPAN', array('class' => 'form-control')); !!}</div>

</div>

<div >
<div class="row mt-3">
    <div class="col-4 text-right">{{ Form::label('shipfee', 'Shipment Fee') }}</div>
   
  @if((Auth::guard('web')->check()))
    <div class="col-4">{{ Form::text('shipfee',old('shipfee'), array('class' => 'form-control','readonly')) }}</div>
    @else
    <div class="col-4" >{{ Form::number('shipfee', old('shipfee'), array('class' => 'form-control')) }}</div>
    @endif

 </div>
</div>

<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('totalqty', 'Total Qty') }}</div>
    <div class="col-4" id="tqty">{{ Form::number('totalqty', old('totalqty'), array('class' => 'form-control','readonly')) }}</div>

</div>
<div class="row mt-3">

    <div class="col-4 text-right">{{ Form::label('totalcost', 'Total Cost') }}</div>
    <div class="col-4" id="tcost">{{ Form::number('totalcost', old('totalcost'), array('class' => 'form-control','readonly')) }}</div>

</div>


<div class="row my-3">

    <div class="col-4 text-right">{{ Form::label('totalamount', 'Total Amount') }}</div>
    <div class="col-4" id="tprice">{{ Form::number('totalamount', old('totalamount'), array('class' => 'form-control','readonly')) }}</div>

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
        <tr>
            <td><input type="text" size="10" name="itemHamoCode[]" /></td>
            <td><input type="text" size="13" name="desc[]" /></td>
            <td><input type="number" size="3" step="1" name="itemQty[]" /></td>
            <td><input type="number" size="5" name="weight[]" /></td>
            <td><input type="number" size="3" name="cost[]" /></td>
            <td><input type="number" size="5" name="price[]" /></td>
            <td><input type="text" size="5" name="lineweight[]" readonly="readonly" /></td>
            <td><input type="text" size="5" name="lineprice[]" readonly="readonly" /></td>
            <td><input type="text" size="5" name="linecost[]" readonly="readonly" /></td>
            <td><a class="deleteRow"> x </a></td>
        </tr>
    </tbody>

    <tfoot >
        <tr>
            <td colspan="9" style="text-align: center;">
                <input type="button" id="addrow" value="Add Item" />
            </td>
        </tr>

        <tr>
            <td colspan="5">
                Weight Total:<span id="grandtotal"></span>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                Grand Total: $<span id="pricetotal"></span>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                Cost Total: $<span id="costtotal"></span>
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


<div class="row my-3">
    <div class="col-2"></div>
    <div class="col-8 text-center">{{ Form::submit('Create the Order!', array('class' => 'btn btn-primary')) }}</div>
    <div class="col-2"></div>
</div>
</div>
{{ Form::close() }}

@endsection
