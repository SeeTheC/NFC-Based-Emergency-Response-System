@extends("im.layout.Common")
@section("content")
<?php 
use App\Http\Controllers\ControlPanel\Crypt; 
$crypt = new Crypt();
?>


<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datatables.css') }}"/> 
<script type="text/javascript" src="{{ URL::asset('assets/js/datatables.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/highchart/highcharts.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/highchart/modules/exporting.js') }}"></script>

<!-- script src="https://code.highcharts.com/highcharts.js"></script -->
<!-- script src="https://code.highcharts.com/modules/exporting.js"></script -->

<div class="row">		    			
		<div class="col-sm-12 page-header text-primary" style="margin-top: 10px">
 				<h1 style="margin-top: 1px;margin-top: 0px">Control Panel</h1> 	
                <h3> 
                    <label> <a href="/">View </a> </label> |
                    <label style="color: #129c26;text-decoration: underline;">Analysis</label> 
                </h3>						
  		</div>
</div>
<div class="row">
    <div class="col-sm-12 panel-group">
    
	<div id="containerPiechart" class="chart" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>	
    </div>
</div>
<hr style="border-top: 2px solid #eee"/>
<div class="row">
    <div class="col-sm-12 panel-group">
    
	<div id="linegraph" class="chart" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>	
    </div>
</div>

<script type="text/javascript">					
		var piechart=Highcharts.chart('containerPiechart', {
		    chart: {
		        plotBackgroundColor: null,
		        plotBorderWidth: null,
		        plotShadow: false,
		        type: 'pie'
		    },
		    title: {
		        text: 'Accident Data since Jan 2017'
		    },
		    tooltip: {
		        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    },
		    plotOptions: {
		        pie: {
		            allowPointSelect: true,
		            cursor: 'pointer',
		            dataLabels: {
		                enabled: true,
		                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                style: {
		                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                }
		            },
		            showInLegend: true
		        }
		    },
		    series: [{
		        name: 'Accident',
		        colorByPoint: true,
		        data:[]
		    }]
		});
		var linegraph=Highcharts.chart('linegraph', {
		    chart: {
		        type: 'line'
		    },
		    title: {
		        text: 'Emergenices in Year 2016'
		    },
		    subtitle: {
		        text: 'Type: Accident'
		    },
		    xAxis: {
		        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		    },
		    yAxis: {
		        title: {
		            text: 'Number of Accident'
		        }
		    },
		    plotOptions: {
		        line: {
		            dataLabels: {
		                enabled: true
		            },
		            enableMouseTracking: false
		        }
		    },
		    series: [{"name":"Bike","data":[]},{"name":"Car","data":[]},{"name":"Truck","data":[]},{"name":"Goods Carrier","data":[]},{"name":"Cycle","data":[]}]
		});
		function loadAccidentData(){			
			$.get("analyse/accidentstatus/",null,function(data,e){	
				data=JSON.parse(data);	
				console.log(data);		
				piechart.series[0].setData(data,true);
			});
		}
		$(function(){
			loadAccidentData();
			loadAccidentMonthlyStatus();
		});

		function loadAccidentMonthlyStatus(){			
			$.get("analyse/accidentmonthlystatus/",null,function(data,e){	
				data=JSON.parse(data);	
				console.log(data);		
				linegraph.series[0].setData(data[0]["data"],true);
				linegraph.series[1].setData(data[1]["data"],true);
				linegraph.series[2].setData(data[2]["data"],true);
				linegraph.series[3].setData(data[3]["data"],true);
				linegraph.series[4].setData(data[4]["data"],true);

			});
		}
		

</script>

@stop