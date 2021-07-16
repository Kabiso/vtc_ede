@extends((Auth::guard('web')->check())? 'layouts.app':'layouts.staffhead')

@section('content')

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(shipfeeChart);
      google.charts.setOnLoadCallback(weightChart);

    //Prepare shipfeeChart
      function shipfeeChart() {
        var data1 = google.visualization.arrayToDataTable([
          ['Year', 'Curve of trend', { role: 'annotation'}],
          ['2018', {{$totalshipfee18}}, {{$totalshipfee18}}],
          ['2019', {{$totalshipfee19}}, {{$totalshipfee19}}],
          ['2020', {{$totalshipfee20}}, {{$totalshipfee20}}],
          ['2021', {{$totalshipfee21}}, {{$totalshipfee21}}]
        ]);

        var options1 = {
          title: 'Four years shipment fee trend',
          titleTextStyle: {fontSize: 40},
          hAxis: {title:'Year',
                  titleTextStyle: {
                    fontName: "sans-serif",
                    fontSize: 25,
                    bold: true,
                    italic: false}},
          vAxis: {title:'Total shipment fee(HKD)',
                  titleTextStyle: {
                    fontName: "sans-serif",
                    fontSize: 25,
                    bold: true,
                    italic: false}},
          curveType: 'function',
          legend: { position: 'bottom' },
          lineWidth: 5
        };

        var chart1 = new google.visualization.LineChart(document.getElementById('shipfee_chart'));

      //Allow to save the chart as PNG file by right click of browser
        google.visualization.events.addListener(chart1, 'ready', function () {
            shipfee_chart.innerHTML = '<img src="' + chart1.getImageURI() + '">';
            console.log(shipfee_chart.innerHTML);
        });

        chart1.draw(data1, options1);
      }

      //Prepare weightChart
         function weightChart() {
        var data2 = google.visualization.arrayToDataTable([
          ['Year', 'Curve of trend', { role: 'annotation'}],
          ['2018', {{$totalweight18}}, {{$totalweight18}}],
          ['2019', {{$totalweight19}}, {{$totalweight19}}],
          ['2020', {{$totalweight20}}, {{$totalweight20}}],
          ['2021', {{$totalweight21}}, {{$totalweight21}}]
        ]);

        var options2 = {
          title: 'Four years weight trend',
          titleTextStyle: {fontSize: 40},
          hAxis: {title:'Year',
                  titleTextStyle: {
                    fontName: "sans-serif",
                    fontSize: 25,
                    bold: true,
                    italic: false}},
          vAxis: {title:'Total weight(kg)',
                  titleTextStyle: {
                    fontName: "sans-serif",
                    fontSize: 25,
                    bold: true,
                    italic: false}},
          curveType: 'function',
          legend: { position: 'bottom' },
          lineWidth: 5,
          colors: ['#e2431e']
        };

        var chart2 = new google.visualization.LineChart(document.getElementById('weight_chart'));

      //Allow to save the chart as PNG file by right click of browser
        google.visualization.events.addListener(chart2, 'ready', function () {
            weight_chart.innerHTML = '<img src="' + chart2.getImageURI() + '">';
            console.log(weight_chart.innerHTML);
        });

        chart2.draw(data2, options2);
      }
    </script>
    <!-- Print / Export PDF button -->
    <div class="pull-right hidden-print"><a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5" style="font-size: 30px"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i>Print / Export PDF</a></div><br><br>

    <hr>

    <div style="text-align: center; font-size: 60px; font-style: italic"><b>Statistical Reports</b></div>

    <hr>
    <!-- Display chart -->
    <a title="save this chart as PNG file by right click"><div id="shipfee_chart" style="width: 1350px; height: 750px; margin: auto; box-shadow: 0px 0px 20px grey"></div></a>

    <hr>

    <a title="save this chart as PNG file by right click"><div id="weight_chart" style="width: 1350px; height: 750px; margin: auto; box-shadow: 0px 0px 20px grey"></div></a>

@endsection
