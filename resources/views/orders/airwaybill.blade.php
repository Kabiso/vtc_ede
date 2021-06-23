<style>
body{
   margin-top:20px;
   background:#eee;
}

.invoice {
   background: #fff;
   padding: 20px
}

.invoice-company {
   font-size: 20px
}

.invoice-header {
   margin: 0 -20px;
   background: #f0f3f4;
   padding: 20px
}

.invoice-date,
.invoice-from,
.invoice-to {
   display: table-cell;
   width: 1%
}

.invoice-from,
.invoice-to {
   padding-right: 20px
}

.invoice-date .date,
.invoice-from strong,
.invoice-to strong {
   font-size: 16px;
   font-weight: 600
}

.invoice-date {
   text-align: right;
   padding-left: 20px
}

.invoice-price {
   background: #f0f3f4;
   display: table;
   width: 100%
}

.invoice-price .invoice-price-left,
.invoice-price .invoice-price-right {
   display: table-cell;
   padding: 20px;
   font-size: 20px;
   font-weight: 600;
   width: 75%;
   position: relative;
   vertical-align: middle
}

.invoice-price .invoice-price-left .sub-price {
   display: table-cell;
   vertical-align: middle;
   padding: 0 20px
}

.invoice-price small {
   font-size: 12px;
   font-weight: 400;
   display: block
}

.invoice-price .invoice-price-row {
   display: table;
   float: left
}

.invoice-price .invoice-price-right {
   width: 25%;
   background: #2d353c;
   color: #fff;
   font-size: 28px;
   text-align: right;
   vertical-align: bottom;
   font-weight: 300
}

.invoice-price .invoice-price-right small {
   display: block;
   opacity: .6;
   position: absolute;
   top: 10px;
   left: 10px;
   font-size: 12px
}

.invoice-footer {
   border-top: 1px solid #ddd;
   padding-top: 10px;
   font-size: 10px
}

.invoice-note {
   color: #999;
   margin-top: 80px;
   font-size: 85%
}

.invoice>div:not(.invoice-footer) {
   margin-bottom: 20px
}

.btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
   color: #2d353c;
   background: #fff;
   border-color: #d9dfe3;
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
   <div class="col-md-12">
      <div class="invoice">
         <!-- begin invoice-company -->
         <div class="invoice-company text-inverse f-w-600">
            <span class="pull-right hidden-print">
            <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
            </span>
            Eastern Delivery Express (EDE) Limited (EDE Express Document Envelope Airway Bill)
         </div>
         <!-- end invoice-company -->
         <!-- begin invoice-header -->
         <div class="invoice-header">
            <div class="invoice-from">
             <table> 
               <small>1. Sender</small>
               <address class="m-t-5 m-b-5">
                 <tr>
                  <td><strong class="text-inverse"><p style="font-size:10px">Account no:</p></strong>{{ $order->custid  }}</td>
               </tr>
               <tr>
                  <td> <strong class="text-inverse"><p style="font-size:10px">Sender Company Name:</p></strong>{{$order->custname  }}</strong></td>
               <tr>
                  <td><strong class="text-inverse"><p style="font-size:10px">Sender Name</p></strong>{{ $order->custname }}</td>
               </tr>  
               <tr>
                  <tr>
                     <td><strong class="text-inverse"  style="font-size:10px">Post Code</strong><br>{{ $order->custpostcode }}</td>
                     </tr>
                 </tr>
                  <td><strong class="text-inverse"><p style="font-size:10px">Address</p></strong><address style="font-size:15px">{{ $order->custaddress }}</address></td>
               </tr>
               <tr>
                  <td><strong class="text-inverse"></strong><p style="font-size:10px">Phone No / Fax No</p>{{ $order->custphone }}</td>
               </tr>    
              
               
               </table>  
            </address>
            </div>
            <div class="invoice-to">
           <table>   
               <small>2. To(Receiver)</small>
             
              <tr>
               <td><strong class="text-inverse" style="font-size:10px" ><p>Company Name:</p>{{ $order->receCompanyname}}</strong></td><br>
               </tr>
            <tr>
               <td> <strong class="text-inverse" style="font-size:10px"><p>Contact Person:</p>{{$order->recename  }}</strong></td><br>
               </tr>
            </tr>
            <tr>
            <td><strong class="text-inverse" ><address style="font-size:20px">Delivery address(No Delivery to PO Box):</p></strong>{{ $order->receaddress }}</address>
            </tr>    
            <tr>
               <td style="font-size:10px"><p>Phone No / Fax No</p>{{ $order->custphone }}</td>
             </tr>             
      </tr> 
      <td><strong class="text-inverse" ><p style="font-size:10px">Country</p></strong>{{ $order->shipcountries  }}</td>
      <tr>       
            </table>    
            </div>
            <div class="invoice-date">
               <small>EDE Express Document Envelope Airway Bill</small>
               <div class="date text-inverse m-t-5">{{ $order->createddate }}</div>
               <div class="invoice-detail">
                  <strong class="text-inverse"><p>Shipment no:</p>{{ $order->orderid }}</strong><br> <br>
                  <p>Shipment Type</p>{{ $order->shiptype }}
               </div>
            </div>
         </div>
         <!-- end invoice-header -->
         <!-- begin invoice-content -->
         <div class="invoice-content">
            <!-- begin table-responsive -->
            <p>3. Shipment Details</p>
            <div class="table-responsive">
               <table border='1' class="table table-invoice">
                  <thead>
                     <tr>
                        <th class="text-center" width="10%">Harmonized commodity code(if applies)</th>
                        <th class="text-center" width="10%">Full Description of contents</th>
                        <th class="text-center" width="10%">No of Item</th>
                        </tr>
                  </thead>
                  <tbody>
                     <tr>
                     @foreach($order->orderdetails as $od)
                   
                     <td>
                        <span class="text-inverse">{{$od ->itemHamoCode}}</span>
                     </td>
                     <td class="text-center">{{$od ->desc}}</td>
                     <td class="text-right">{{$od ->itemQty}}</td>
                    </tr>
                     @endforeach
       
                  </tbody>
               </table>
            </div>
            <!-- end table-responsive -->
            <!-- begin invoice-price -->
            <div class="invoice-price">
               <div class="invoice-price-left">
                  <div class="invoice-price-row">
                  
                  </div>
               </div>
               <div class="invoice-price-right">
                  <small style="color:white;font-size:20px;" >Declared value</small> <span class="f-w-600" style="color:white;font-size:40px;">${{$order ->totalamount}}</span>
               </div>
            </div>
            <!-- end invoice-price -->
         </div>
         <!-- end invoice-content -->
         <!-- begin invoice-note -->
         <div class="invoice-note">
            <strong  style="font-size:20px"class="text-inverse">
           4. Size and weight<br>
            Dimensins cm L x W x H<br> 
            {{$order ->remark}}
            </strong>
         </div>
         <!-- end invoice-note -->
         <!-- begin invoice-footer -->
         <div class="invoice-footer">
            <p class="text-center m-b-5 f-w-600">
               <strong  style="font-size:20px"class="text-inverse">5. Sender's authorization and signature  </strong><br><br>
               <strong  style="font-size:30px"class="text-inverse">______________________</strong>



            </p>
           
         </div>
         <!-- end invoice-footer -->
      </div>
   </div>
</div>

