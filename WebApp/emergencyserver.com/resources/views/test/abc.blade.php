@extends("im.layout.Common")

@section("content")
 	Hello Word sdfsdfsdf
 	<br/>
 	<h1>People</h1><br/>
 	@foreach($people as $p)
 		{{  $p }} <br/>
 	@endforeach

 	<h1>Query</h1><br/> 	
 	@foreach($machine as $m)
 		{{  $m->machine_type }} <br/>
 	@endforeach

 	<h1>Model</h1><br/> 	
 	@foreach($mModel as $m)
 		{{  $m->machine_type }} <br/>
 	@endforeach
 	
@stop