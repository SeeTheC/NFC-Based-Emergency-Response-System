$(function () {
	bindAnchor();
});
/*
	Redirect to the url. 
	On: 22/10/2016
	By: Khursheed Ali
*/
function bindAnchor()
{
	$(".im-anchor").on("click",function(){
		if(!$(this).parent().hasClass("active")){
			var url=$(this).data("url");
			if(url.length>0)
			{
					document.location=url;
			}	
		}
	});	
}