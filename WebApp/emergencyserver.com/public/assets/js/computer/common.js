$(function () {
	bindFormClick();
	$(".sub-form").get(0).click();
});
/*
	Binds the Sub Form click event 
	On: 21/10/2016
	By: Khursheed Ali
*/
function bindFormClick(){
	
	$(".sub-form").on("click",function(){
		var url=$(this).data("url");
		var mid=$(this).data("mid");				
		if($(this).hasClass("first-form")){
			$("#pageForm").load(url+"/"+mid);			
		}
		else 
		if(mid!=0){
			$("#pageForm").load(url+"/"+mid);						
		}
		else{
			alert("Error: Please fill the required(*) sub-section.");
			return false;		
		}
		$(".nav-pills>li").removeClass("active");
		$(this).parent().addClass("active")		
				
	});	
}
function gotoNextMenu(){
	var $menu=$(".sub-menu>li");
	var len=$menu.length;
	var cur=-1;	
	$menu.each(function(i){
		if($(this).hasClass("active")){
			cur=i;
		}		
	});		
	$(".nav-pills>li").removeClass("active");
	if(0<cur+1 && cur+1 <len){		
		$($menu[cur+1]).addClass("active");
		$($menu[cur+1]).find(".sub-form").click();		
	}
	else
	if(cur+1 >=len){
		window.location=ENDURL;
	}	
}

function postRequest($this,isMainForm){
	var url=$("form")[0].action;
	var fdata=$("form").serialize();
	if($($("form")[0]).isValid()){
		$.post(url,fdata,function(data,status){
			if(data["success"]){
				if(isMainForm==true){
					setMid(data["rtnId"]);
				}
				gotoNextMenu();
			}	
			else{
				setGlobalError(data["errorMsg"]);
			}
		});

	}	
	
}
function setMid(id)
{
	alert(id);
	$(".sub-form").data("mid",id);
}
function setGlobalError(msg)
{
	$("#globalError").html(msg);
}