@extends("im.layout.Common")
@section("content")

<link rel="stylesheet" href="{{ URL::asset('assets/css/common/startup.css') }}">
<div class="row row-padding device">
 		<div class="col-sm-6 col-padding" >
         <div class="tile tile11 tileshadow im-anchor" data-url="{{ URL::to('computer') }}">
             <div class="carousel slide" data-ride="carousel">
                 <!-- Wrapper for slides -->
                 <div class="carousel-inner">
                     <div class="item active text-center">
                         <div style="position:relative;left:40%">
                               <img src="{{ URL::asset('assets/img/desktop.png') }}" class="img-responsive" style="width:100px;height:100px" align="middle"/>
                         </div>
                         <div class="icontext">
                             Computer (Desktop)
                         </div>		                            
                     </div>
                        <div class="item text-center">
                         <div style="position:relative;left:40%">
                               <img src="{{ URL::asset('assets/img/laptop.png') }}" class="img-responsive" style="width:100px;height:100px" align="middle"/>
                         </div>
                         <div class="icontext">
                             Computer (Laptop)
                         </div>		                            
                     </div>		                        	                     
                 </div>
             </div>
         </div>		           
	   </div>	
	   <div class="col-sm-6 col-padding">
	            <div class="tile tile11 tileshadow im-anchor" data-url="underconstruct.php">
	                <div class="carousel slide" data-ride="carousel">
	                    <!-- Wrapper for slides -->
	                    <div class="carousel-inner">
	                        <div class="item active text-center">
	                            <div style="position:relative;left:37%">
	                                  <img src="{{ URL::asset('assets/img/switch.png') }}" class="img-responsive" style="width:150px;height:100px" align="middle"/>
	                            </div>
	                            <div class="icontext">
	                                Device (Switch)
	                            </div>				                            	                            
	                        </div>
	                           <div class="item text-center">
	                            <div style="position:relative;left:37%">
	                                  <img src="{{ URL::asset('assets/img/router.png') }}" class="img-responsive" style="width:150px;height:100px" align="middle"/>
	                            </div>
										 <div class="icontext">
	                                Device (Router)
	                            </div>				                           		                            
	                        </div>		                        	                     
	                    </div>
	                </div>
	            </div>		           
	        </div>		      
 		</div>   
 		
 <div class="row row-padding">    		
    	<div class="col-sm-6 col-padding">
            <div class="tile tile11 tileshadow im-anchor" data-url="underconstruct.php">
                <div class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active text-center">
                            <div style="position:relative;left:40%">
                                  <img src="{{ URL::asset('assets/img/printer1.png') }}" class="img-responsive" style="width:100px;height:100px" align="middle"/>
                            </div>
                            <div class="icontext">
                                Printer
                            </div>		                            
                        </div>
                           <div class="item text-center">
                            <div style="position:relative;left:40%">
                                  <img src="{{ URL::asset('assets/img/printer2.png') }}" class="img-responsive" style="width:100px;height:100px" align="middle"/>
                            </div>
                            <div class="icontext">
                                Printer
                            </div>		                            
                        </div>		                        	                     
                    </div>
                </div>
            </div>		           
     </div>	
     <div class="col-sm-6 col-padding">
            <div class="tile tile11 tileshadow im-anchor" data-url="underconstruct.php">
                <div class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active text-center">
                            <div style="position:relative;left:37%">
                                  <img src="{{ URL::asset('assets/img/scanner1.png') }}" class="img-responsive" style="width:150px;height:100px" align="middle"/>
                            </div>
                            <div class="icontext">
                                Scanner
                            </div>				                            	                            
                        </div>
                           <div class="item text-center">
                            <div style="position:relative;left:37%">
                                  <img src="{{ URL::asset('assets/img/scanner2.png') }}" class="img-responsive" style="width:150px;height:100px" align="middle"/>
                            </div>
									 <div class="icontext">
                                Scanner
                            </div>				                           		                            
                        </div>		                        	                     
                    </div>
                </div>
            </div>		           
      </div>		      
</div>    		
<div class="row row-padding">
	   <div class="col-sm-12 col-padding">
	          <div class="tile tile11 tileshadow im-anchor" data-url="underconstruct.php">
	                <div class="carousel slide" data-ride="carousel">
	                    <!-- Wrapper for slides -->
	                    <div class="carousel-inner">
	                        <div class="item active text-center">
	                            <div style="position:relative;left:40%">
	                                  <img src="{{ URL::asset('assets/img/hardware1.png') }}" class="img-responsive" style="width:100px;height:100px" align="middle"/>
	                            </div>
	                            <div class="icontext">
	                                Computer Hardware (Addon)
	                            </div>		                            
	                        </div>
	                           <div class="item text-center">
	                            <div style="position:relative;left:40%">
	                                  <img src="{{ URL::asset('assets/img/hardware2.png') }}" class="img-responsive" style="width:100px;height:100px" align="middle"/>
	                            </div>
	                            <div class="icontext">
	                                Computer Hardware (Replace)
	                            </div>		                            
	                        </div>		                        	                     
	                    </div>
	                </div>
	            </div>		           
	    </div>	
</div>        

@stop