
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="monitorcenter_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="monitorcenter_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"monitor_centers/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#address").html(resultobj["data"]["address"]);
	    	 $("#centername").html(resultobj["data"]["name"]);
	    	 $("#position").html(resultobj["data"]["position"]);
	    	 $("#telephone").html(resultobj["data"]["telephone"]);
	    	 $("#chargePerson").html(resultobj["data"]["chargePerson"]);
	    	 $("#chargePhone").html(resultobj["data"]["chargePhone"]);
	    	 $("#monitorCenterRankCode").html(fnChangeName(resultobj["data"]["monitorCenterRankCode"],monitorCenterRankCode_jsarry));
	    	 $("#pauseFlag").html(fnChangeName(resultobj["data"]["pauseFlag"],pauseFlag_jsarray));
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
     })
}