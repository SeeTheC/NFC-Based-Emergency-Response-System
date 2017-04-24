@extends("im.layout.Common")
@section("content")
 <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datatables.css') }}"/> 
<script type="text/javascript" src="{{ URL::asset('assets/js/datatables.js') }}"></script>
<div class="row">		    			
		<div class="col-sm-12 page-header text-primary" style="margin-top: 10px">
 				<h1 style="margin-top: 1px;margin-top: 0px">Control Panel</h1> 							
  		</div>
</div>
<div class="row">
	<div class="col-sm-12">
		@foreach($info as $row)            
                <strong> <label> Name of Victim:</label>
                	<label style="color:red">
                 		{{$row->people->first_name}} {{$row->people->last_name}}
                 	</label>                 
                <label> Type: </label><label style="color:red"> {{$row->nfcType->type}}</label>
                <label> Mode: </label><label style="color:red"> {{$row->vehicalType->type}} </labe> 
                </strong>                                                                               
        @endforeach
	</div>
	<div class="col-sm-12" style="color:red">
		Incident Location
	</div>
	<div class="col-sm-12">
		<div id="map"></div>
	    <script>
	      function initMap() {
	        var uluru = {lat: {{$row->lattitude}}, lng: {{$row->longitude}}};
	        var map = new google.maps.Map(document.getElementById('map'), {
	          zoom: 18,
	          center: uluru
	        });
	        var marker = new google.maps.Marker({
	          position: uluru,
	          map: map
	        });
	      }
	    </script>
	    <script async defer
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVUGMqtPN8k1ss7ElmXYWqLhyhOyzJ5sI&callback=initMap">
	    </script>
		<!-- distance
https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=19.1334302,72.9132679&destinations=19.8336772,72.9132879&key=AIzaSyCoQwOy8tUmBgJ8PVy-Lbn9yogOPy4kzpo
		-->	  
	</div> 
</div>

@stop