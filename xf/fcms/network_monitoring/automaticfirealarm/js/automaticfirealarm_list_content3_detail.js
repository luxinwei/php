 
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="automaticfirealarm_list_content3.php";});

  
//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"auto_fire_alarms/electricalAlarm/"+tId+"/"+eId};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
	//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#type").html(resultobj["data"]["type"]);
	    	 $("#buildName").html(resultobj["data"]["buildName"]);
	    	 $("#depName").html(resultobj["data"]["depName"]);
	    	 $("#deviceName").html(resultobj["data"]["deviceName"]);
	    	 $("#content").html(resultobj["data"]["content"]);
	    	 $("#error").html(resultobj["data"]["error"]);
	    	 $("#state").html(resultobj["data"]["state"]);
	    	// $("#modality").html(resultobj["data"]["modality"]);
	    	 $("#result").html(resultobj["data"]["result"]);
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
 })
}