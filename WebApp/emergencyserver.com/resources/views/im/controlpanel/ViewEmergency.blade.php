@extends("im.layout.Common")
@section("content")


<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datatables.css') }}"/> 
<script type="text/javascript" src="{{ URL::asset('assets/js/datatables.js') }}"></script>

<script type="text/javascript">
    $(function(){

        $("#table_id").DataTable();

    });

</script>
<style type="text/css">
    
    thead{
        background: #607D8B;
        color: #c3c3c3;
    }
</style>

<div class="row">		    			
		<div class="col-sm-12 page-header text-primary" style="margin-top: 10px">
 				<h1 style="margin-top: 1px;margin-top: 0px">Control Panel</h1> 							
  		</div>
</div>
<div class="row">
        <div class="col-sm-12 panel-group">
            <table id="table_id" class="display table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Victim</th>
                        <th>Type</th>
                        <th>Mode</th>
                        <th>Lattitude</th>
                        <th>Longitude</th>
                        <th>Reported_by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($info as $row)
                        <tr>
                            <td> {{$row->people->first_name}} {{$row->people->last_name}}</td> 
                            <td> {{$row->nfcType->type}} </td>
                            <td> {{$row->vehicalType->type}}</td>                            
                            <td> {{$row->lattitude}}</td>
                            <td> {{$row->longitude}}</td>
                            <td> {{$row->reportedBy->first_name}} {{$row->reportedBy->last_name}}</td>                             
                            <td> 
                                    <a href="#" target="_blank">Map</a>                                 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>




@stop
