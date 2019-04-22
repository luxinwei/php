 
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="automaticfirealarm_list_content4.php";});

  
//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"auto_fire_alarms/shieldMsg/"+tId+"/"+eId};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
	//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#cTime").html(ClearTrim(resultobj["data"]["cTime"]));
	    	 $("#type").html(resultobj["data"]["type"]);
	    	 $("#buildName").html(resultobj["data"]["buildName"]);
	    	 $("#impName").html(resultobj["data"]["impName"]);
	    	 $("#deviceName").html(resultobj["data"]["deviceName"]);
	    	 $("#content").html(resultobj["data"]["content"]);
	    	 $("#error").html(resultobj["data"]["error"]);
 	    	 $("#state").html(fnChangeName(resultobj["data"]["state"],state_jsarray));	    	 
	    	 $("#dTime").html(resultobj["data"]["dTime"]);
 	    	 $("#result").html(resultobj["data"]["result"]);
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
 })
}