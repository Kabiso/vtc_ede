@extends((Auth::guard('web')->check())? 'layouts.app':'layouts.staffhead')

@section('content')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Print / Export PDF button -->
   <div class="pull-right hidden-print"><a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5" style="font-size: 30px"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i>Print / Export PDF</a></div><br><br>

   <hr>

   <div style="text-align: center; font-size: 60px; font-style: italic"><b>Weekly Shipment Reports</b></div>

   <!-- Show / Hide function -->
   <div style="text-align: center">
   <a style="font-size: 15px" id="more1" href="#" onclick="$('#last1week').slideToggle(function(){$('#more1').html($('#last1week').is(':visible')?'Hide {{$last1Week7Day}} ~ {{$last1Week1Day}}':'Show {{$last1Week7Day}} ~ {{$last1Week1Day}}');});">Hide {{$last1Week7Day}} ~ {{$last1Week1Day}}</a> |
   <a style="font-size: 15px" id="more2" href="#" onclick="$('#last2week').slideToggle(function(){$('#more2').html($('#last2week').is(':visible')?'Hide {{$last2Week7Day}} ~ {{$last2Week1Day}}':'Show {{$last2Week7Day}} ~ {{$last2Week1Day}}');});">Hide {{$last2Week7Day}} ~ {{$last2Week1Day}}</a>
   </div>

    <table id="last1week" class="table table-bordered table-striped" style="font-size: 14px; text-align: center">
      <thead>
     <!-- Report heading info. -->
        <tr style="font-size:17px">
        <th colspan="3">Total <span style="color: red">{{$count1}}</span> orders from {{$last1Week7Day}} to {{$last1Week1Day}}</th>
        <th colspan="2">Total weight: <span style="color: red">{{$week1TotalWeight}}</span></th>
        <th colspan="2">Total shipment fee: <span style="color: red">{{$week1TotalShipfee}}</span></th>
        </tr>
        <tr class="thead-dark">
        <th scope="col">Order ID</th>
          <th scope="col">Origin</th>
          <th scope="col">Destination</th>
          <th scope="col">Total Weight</th>
          <th scope="col">Shipment Fee</th>
          <th scope="col">Shipment Type</th>
          <th scope="col">Created Date</th>
        </tr>
      </thead>
      <tbody>
        <!-- first week -->
        @foreach ($last1WeekData as $last1Week)
        <tr><td>{{$last1Week->orderid}}</td>
            <td>{{$last1Week->custarea}}</td>
            <td>{{$last1Week->recearea}}</td>
            <td>{{$last1Week->totalweight}}</td>
            <td>{{$last1Week->shipfee}}</td>
            <td>{{$last1Week->shiptype}}</td>
            <td>{{$last1Week->createddate}}</td>
        </tr>
        @endforeach
      </tbody>
</table>

<table id="last2week" class="table table-bordered table-striped" style="font-size: 14px; text-align: center">
      <thead>
        <!-- Report heading info. -->
        <tr style="font-size:17px">
        <th colspan="3">Total <span style="color: red">{{$count2}}</span> orders from {{$last2Week7Day}} to {{$last2Week1Day}}</th>
        <th colspan="2">Total weight: <span style="color: red">{{$week2TotalWeight}}</span></th>
        <th colspan="2">Total shipment fee: <span style="color: red">{{$week2TotalShipfee}}</span></th>
        </tr>
        <tr class="thead-dark">
        <th scope="col">Order ID</th>
          <th scope="col">Origin</th>
          <th scope="col">Destination</th>
          <th scope="col">Total Weight</th>
          <th scope="col">Shipment Fee</th>
          <th scope="col">Shipment Type</th>
          <th scope="col">Created Date</th>
        </tr>
      </thead>
      <tbody>
        <!-- Second week -->
        @foreach ($last2WeekData as $last2Week)
        <tr><td>{{$last2Week->orderid}}</td>
            <td>{{$last2Week->custarea}}</td>
            <td>{{$last2Week->recearea}}</td>
            <td>{{$last2Week->totalweight}}</td>
            <td>{{$last2Week->shipfee}}</td>
            <td>{{$last2Week->shiptype}}</td>
            <td>{{$last2Week->createddate}}</td>
        </tr>
        @endforeach
      </tbody>
</table>

@endsection
