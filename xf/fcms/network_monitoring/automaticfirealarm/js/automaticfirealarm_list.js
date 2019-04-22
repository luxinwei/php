$("#btn_build").bind("click", function(){window.location.href="practicetask_build.php?m="+m;});
 
function getCheckBoxValue(activeXName){
    var result="";
	var obj=document.getElementsByName(activeXName);
	for(i=0;i<obj.length;i++){	
				if(obj[i].checked==true){
				    if(result!="")result+=",";
					result+=obj[i].value;					
				}				
			}
   return result;
}
$("input[name='fire']").bind("click", function(){
	//window.location.reload();
 
	$("input[name='fire']").attr("checked",false);
	$(this).attr("checked",true);
	
	var result=getCheckBoxValue("fire");
	$("#haha").val(result);
	initx(result);
	
});
initx("1");
function initx(i){
	
	/*m=$("#haha").val();*/
 
	var url="automaticfirealarm_list_content1.php";

	if(i=="1")url="automaticfirealarm_list_content1.php";
	if(i=="2")url="automaticfirealarm_list_content2.php";
	if(i=="3")url="automaticfirealarm_list_content3.php";
	if(i=="4")url="automaticfirealarm_list_content4.php";
	if(i=="5")url="automaticfirealarm_list_content5.php";
$("#automaticfirealarm_iframe").attr("src",url);
 	/*if(m=="1")url="automaticfirealarm_list_content1.php";
	if(m=="2")url="automaticfirealarm_list_content2.php";
	if(m=="3")url="automaticfirealarm_list_content3.php";
	if(m=="0")url="automaticfirealarm_list_content1.php";*/
	//var params={}
	
//	$.post(url,params,function(responseText){
		
///		 $("#tbody_content").empty().append(responseText);     
//	});

}
 

