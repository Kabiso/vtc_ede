
@extends((Auth::guard('web')->check())? 'layouts.app':'layouts.staffhead')

@section('content')
<style>

#map{
    display: none;
    }
    #hidden{
    display: none;
    }
    #checkcom{
    display: none;
    }
    #map {
      height: 40vh;
      /* The height is 400 pixels */
      width: 100%;
      /* The width is the width of the web page */
      z-index:1;
    }

#locationbar
    {
      display: none;
      position: absolute;
      z-index:2;
      background-color: white; 
      height:100px;
      opacity: 0.8;

    }
 
    
    </style>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV6UAXsaWu9zMGu8cLg-NB1j3t6XAmN7o&callback=initMap&libraries=&v=weekly"
    async
  ></script>

    <script>
        let p1='';
        let p2 ='';
        let zoomval='';
        const aus = { lat: -25.344, lng: 131.036 };
        const hk = {lat:22.318376482273358, lng:114.16408230263161};
        const japan = {lat:36.72132626802466, lng:138.30421946306942 };
        const ShangHai = {lat:31.25437006090978, lng:121.4590966426913}
        let  loc =[];
            loc['HONG KONG'] = hk;
            loc['JAPAN'] = japan;
            loc['AUSTRALIA'] =aus;
            loc['CHINA'] = ShangHai;
        
        // Initialize and add the map
      $(document).ready(function(){
        
        
 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
      if(data.checkid>0)
      {
        
        $("#map").show();   
        $("#locationbar").show();
        $("#orderid").html(data.orderid); 
        $("#p1").html(data.p1);
        $("#p2").html(data.p2);
        data.acceptanceTime == null ? $("#time").html('TBC'):$("#time").html(data.acceptanceTime);
        p1 = loc[data.p1];
        p2 = loc[data.p2];
        console.log(data.p2);
        if(data.p1 == 'AUSTRALIA' || data.p2 == 'AUSTRALIA')
        {
          zoomval = 2;
        }
        if(data.p1 == 'CHINA' || data.p2 == 'CHINA')
        {
          zoomval = 4;
        }
        if(data.p1 == 'JAPAN' || data.p2 == 'JAPAN')
        {
          zoomval = 3;
        }




      let map = new google.maps.Map(document.getElementById("map"), {
          zoom: zoomval,
          center: p1,
        });
        var polylinePathPoints = [
          p1,
          p2,
        
        ];
      var polylinePath = new google.maps.Polyline({
          path: polylinePathPoints,
          geodesic: true,
          strokeColor: 'red',
          strokeOpacity: 0.8,
          strokeWeight: 3,
          editable: false,
          geodesic: false,
          draggable: false
      });

  polylinePath.setMap(map);


        // The marker, positioned at Uluru
        let marker = new google.maps.Marker({
          position: p1,
          map: map,

        });

        let marker2 = new google.maps.Marker({
          position: p2,
          map: map,

        });
        
      }else{
        $("#map").hide();   
        $("#locationbar").hide(); 
      }
   
    $('tbody').html(data.table_data);
    $('#a').html(data.table_data1);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
 
});



      </script>
    
  <div class="container">
  
   <div class="card">
    <div class="card-header font-weight-bold text-white bg-info">Track Shipment</div>
    <div class="card-body">
     <div class="form-group">
      <input type="text" name="search" id="search" class="form-control" placeholder="Please Enter the Order ID" />
     </div>
    
  
 
     <div class="d-flex mb-5">
       <div id="locationbar" class ="col-md-8 offset-md-2">
         <div class="row">
           <div class="col-md-6">
              <h5 class="mt-2 font-weight-bold" id="orderid">Order ID. 123</h5>
              <h4 class="font-weight-bold mt-4" > <span id="p1">Hong Kong</span>  
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
              </svg> 
               <span id="p2">Australia</span>  
            </h4>
           </div> 
        <div class="col-md-6 text-right">
          <h4 class="font-weight-bold mt-4" >Time for acceptance</h4>
          <h4 class="font-weight-bold" style="color:red;" id="time">TBC</h4>
        </div>
         </div>
      </div>
    <div id="map"></div>
    
     </div>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    
 
     <div class="table-responsive">
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>Status</th>
         <th>Date</th>
         <th>Loction</th>
         
        </tr>
       </thead>
       <tbody>

       </tbody>
     <p id="a">

     </div>
      </table>
     </div>
    </div>    
   </div>
  </div>
 

<script>

</script>

@endsection
