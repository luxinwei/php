$("input[name='fire']").bind("click", function(){
	//window.location.reload();
 
	$("input[name='fire']").attr("checked",false);
	$(this).attr("checked",true);
	
	var result=getCheckBoxValue("fire");
	 
	initx(result);
	
});
initx("1");
function initx(i){
	
 
 
	var url="systemdatastatistics_content1.php";

	if(i=="1")url="systemdatastatistics_content1.php";
	if(i=="2")url="systemdatastatistics_content2.php";

	 

	var params={}
	
	$.post(url,params,function(responseText){
		 $("#tbody_content").empty().append(responseText);     
	});

}