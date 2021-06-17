@extends('layouts.app')

@section('content')

<script>
$(document).ready(function () {
    var counter = 1;

    $("#addrow").on("click", function () {
        counter++;

        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><input type="text"  style="width:250px" name="itemHamoCode[]' + counter + '"/></td>';
        cols += '<td><input type="text"  style="width:50px" name="desc[]' + counter + '"/></td>';
        cols += '<td><input type="number"  style="width:50px" name="itemQty[]' + counter + '"/></td>';
        cols += '<td><input type="number"  style="width:100px" name="weight[]' + counter + '"/></td>';
        cols += '<td><input type="number"  style="width:100px" name="cost[]' + counter + '"/></td>';
        cols += '<td><input type="number"  style="width:100px" name="price[]' + counter + '"/></td>';
        cols += '<td>$<input type="text" name="linetotal[]' + counter + '" readonly="readonly"/></td>';
        cols += '<td>$<input type="text" name="pricetotal[]' + counter + '" readonly="readonly"/></td>';
        cols += '<td>$<input type="text" name="costtotal[]' + counter + '" readonly="readonly"/></td>';
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
        calculateCostTotal();
    });









});

function calculateRow(row) {
    var cost = +row.find('input[name^="cost[]"]').val();
    var price = +row.find('input[name^="price[]"]').val();
    var weight= +row.find('input[name^="weight[]"]').val();
    var qty = +row.find('input[name^="itemQty[]"]').val();
    row.find('input[name^="linetotal[]"]').val((weight * qty).toFixed(2));
    row.find('input[name^="pricetotal[]"]').val((price * qty).toFixed(2));
    row.find('input[name^="costtotal[]"]').val((cost * qty).toFixed(2));
    row.find('input[name^="totalweight[]"]').val((weight * qty).toFixed(2));



}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="linetotal[]"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
    $(".col-4 totalweight").val(grandTotal.toFixed(2));
}

function calculatePriceTotal() {
    var priceTotal = 0;
    $("table.order-list").find('input[name^="pricetotal[]"]').each(function () {
        priceTotal += +$(this).val();
    });
    $("#pricetotal").text(priceTotal.toFixed(2));

}
function calculateCostTotal() {
    var costTotal = 0;
    $("table.order-list").find('input[name^="costtotal[]"]').each(function () {
        costTotal += +$(this).val();
    });
    $("#costtotal").text(costTotal.toFixed(2));
}



</script>
<h1>Create a Order</h1>

{!! Form::open(['action' =>'OrderController@storewithdetails', 'method' => 'POST','files'=>true])!!}
@csrf
<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('custid', 'Cust number') }}</div>
    <div class="col-4">{{ Form::text('custid', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>

<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('receid', 'receier id') }}</div>
    <div class="col-4">{{ Form::text('receid', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>

<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('receCompanyname', 'rece Company Name') }}</div>
    <div class="col-4">{{ Form::text('receCompanyname', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>

<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('recename', 'rece name') }}</div>
    <div class="col-4">{{ Form::text('recename', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>

<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('recephone', 'rece phone') }}</div>
    <div class="col-4">{{ Form::text('recephone', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>

<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('recepostcode', 'rece postcode') }}</div>
    <div class="col-4">{{ Form::text('recepostcode', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>

<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('receaddress', 'rece address') }}</div>
    <div class="col-4">{{ Form::text('receaddress', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>

<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('custname', 'cust name') }}</div>
    <div class="col-4">{{ Form::text('custname', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>


<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('custphone', 'cust phone') }}</div>
    <div class="col-4">{{ Form::text('custphone', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>

<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('custpostcode', 'cust postcode') }}</div>
    <div class="col-4">{{ Form::text('custpostcode', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>



<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('custaddress', 'cust address') }}</div>
    <div class="col-4">{{ Form::text('custaddress', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>


<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('tax', 'tax') }}</div>
    <div class="col-4">{{ Form::number('tax', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>


<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('paymemt', 'paymemt') }}</div>
    <div class="col-4"> {!! Form::select('paymemt', array('Cash' => 'Cash', 'Cheque' => 'Cheque', 'Credit Card' => 'Credit Card', 'Monthely Pay' => 'Monthely Pay'), 'C水redit Card', array('class' => 'form-control')); !!}</div>
    <!--<div class="col-4">{{ Form::text('paymemt', null, array('class' => 'form-control')) }}</div> -->
    <div class="col-2"></div>
</div>



<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('cardtype', 'cardtype') }}</div>
    <div class="col-4">{{ Form::text('cardtype', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>


<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('vaDate', 'vaDate') }}</div>
    <div class="col-4">{{ Form::text('vaDate', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>


<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('totalweight', 'totalweight') }}</div>
    <div class="col-4">{{ Form::number('totalweight', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>



<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('cardnum', 'cardnum') }}</div>
    <div class="col-4">{{ Form::text('cardnum', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>

<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('totalcost', 'totalcost') }}</div>
    <div class="col-4">{{ Form::number('totalcost', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>


<div class="row">
    <div class="col-2"></div>
    <div class="col-4 text-right">{{ Form::label('totalamount', 'totalamount') }}</div>
    <div class="col-4">{{ Form::number('totalamount', null, array('class' => 'form-control')) }}</div>
    <div class="col-2"></div>
</div>



<br/><br/>

<!-- Detail Form -->
<div class="card">
<div class="card-header">Order Items</div>
<table class="order-list">
    <thead>
    <th>itemHamoCode</th>
                        <th>Desc</th>
                        <th>item QTY</th>
                        <th>weight</th>
                        <th>Cost</th>
                        <th>Price</th>
                        <th>wiegth total</th>
                        <th>price total</th>
                        <th>cost total</th>
    </thead>

    <tbody>
        <tr>
            <td><input type="text" name="itemHamoCode[]" /></td>
            <td><input type="text" name="desc[]" /></td>
            <td><input type="number" name="itemQty[]" /></td>
            <td><input type="number" name="weight[]" /></td>
            <td><input type="number" name="cost[]" /></td>
            <td><input type="number" name="price[]" /></td>
            <td><input type="text" name="linetotal[]" readonly="readonly" /></td>
            <td><input type="text" name="pricetotal[]" readonly="readonly" /></td>
            <td><input type="text" name="costtotal[]" readonly="readonly" /></td>
            <td><a class="deleteRow"> x </a></td>
        </tr>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="5" style="text-align: center;">
                <input type="button" id="addrow" value="Add Product" />
            </td>
        </tr>

        <tr>
            <td colspan="5">
                Weight Total: $<span id="grandtotal"></span>
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
            <td colspan="5" style="btn btn-default pull-left;">
                <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" />
            </td>
        </tr>
        <tr>
        </tr>
    </tfoot>
    <div id="grandtotal"></div>
   <!--            <div class="row">
                <div class="col-md-12">
                    <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                    {{ Form::button('+ Add Row', array('class' => 'btn btn-default pull-left','type'=>'button')) }}
                    <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                </div>
            </div>
        </div>-->
</div>

<br/><br/>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8 text-center">{{ Form::submit('Create the Order!', array('class' => 'btn btn-primary')) }}</div>
    <div class="col-2"></div>
</div>

{{ Form::close() }}

@endsection
