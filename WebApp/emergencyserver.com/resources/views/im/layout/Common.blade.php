<!DOCTYPE html>
<html lang="en">
<head>
  <title>ES:Control Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/layout-custom.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css') }}" />

  <script src="{{ URL::asset('assets/js/jquery-2.2.3.min.js') }}"></script>
  <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
  <link rel="stylesheet" href="{{ URL::asset('assets/css/lm.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/tile.css') }}"> 
  <script src="{{ URL::asset('assets/js/common/common.js') }}"></script>   
  <script type="text/javascript">
    jQuery(function ($) {
        $(".tile").height($("#tile1").width());
        $(".carousel").height($("#tile1").width());
        $(".item").height($("#tile1").width());
        
        $(window).on('resize', function () {
            if (this.resizeTO) {
                clearTimeout(this.resizeTO);
            }
            this.resizeTO = setTimeout(function () {
                $(this).trigger('resizeEnd');
            }, 10);
        });

        $(window).on('resizeEnd', function () {
            $(".tile").height($("#tile1").width());
            $(".carousel").height($("#tile1").width());
            $(".item").height($("#tile1").width());
        });
    });
</script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" >IIT-Bombay</a>
    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="{{ URL::to('home') }}">Home</a></li>
	        <li><a href="underconstruct.php">Contact</a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="login/login.php"><span class="glyphicon glyphicon-log-out"></span>Login</a></li>
	      </ul>
	    </div>
	</div>
  </div>
</nav> 
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8 text-left center-content">
    		<div class="row jumbotron content-row1" style="padding-top: 10px;padding-bottom: 0px">				
	   		<div class="col-sm-12">
            <div class="row">
              <div class="col-sm-2">
                <img src="{{ URL::asset('assets/img/emergency_icon1.png') }}" style="height:150px;margin-top: -16px;"/>        
              </div>
              <div class="col-sm-2">
              </div>  
              <div class="col-sm-8" style="">
                <h1>Emegency</h1>
                <p style="margin-top: -14px;">24x7 | Help Line | Accident | Lost </p>
              </div>
            </div>          						
				</div>				  							
    		</div>
    		<br/>
    		<div class="row row-padding content-row2">
    		         
        @yield("content")

        </div> <!-- End of content-row2 -->       
    <div class="col-sm-2"> <!-- Right Pan--> 
    </div> 
  </div> <!-- End of content -->
</div> <!-- End of container -->
</body>
</html>
