 


//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="falsepositives_detail.php";});

//修改信息==========================================
 
//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"fire_alarm_accepts/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#depName").html(resultobj["data"]["depName"]);
	    	 
	 		 	var firstAlarmTime=timeFormat
(resultobj["data"]["firstAlarmTime"]);
 	 		 	var acceptTime=timeFormat
(resultobj["data"]["acceptTime"]);
 	 		 	
	 		 	var acceptEndTime=timeFormat
(resultobj["data"]["acceptEndTime"]);
 	    	    $("#firstAlarmTime").html(firstAlarmTime);
	    	    $("#acceptTime").html(acceptTime);
	    	    $("#acceptEndTime").html(acceptEndTime);
	    	 
	    	 $("#acceptedTypeCode").html(fnChangeName(resultobj["data"]["acceptedTypeCode"],acceptedTypeCode_jsarry));
	    	 $("#description").html(resultobj["data"]["description"]);
	    	 $("#handleResult").html(resultobj["data"]["handleResult"]);
	    	 $("#acceptUser").html(resultobj["data"]["acceptUser"]);
	    	 $("#description").html(resultobj["data"]["description"]);
	    	 $("#acceptedConfirmCode").html(fnChangeName(resultobj["data"]["acceptedConfirmCode"],acceptedConfirmCode_jsarry));
	    	
	 		 	var reportTime=timeFormat
(resultobj["data"]["reportTime"]);
 	 		 	var reportFeebackTime=timeFormat
(resultobj["data"]["reportFeebackTime"]);
 	    	    $("#reportTime").html(reportTime);
	    	    $("#reportFeebackTime").html(reportFeebackTime);
	    	 
	    	 $("#monitorUserName").html(resultobj["data"]["monitorUserName"]);
	    	 $("#monitorHandleInfo").html(resultobj["data"]["monitorHandleInfo"]);
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}
function timeFormat(t) {   

	if(t==""){	
		return "";
	}else{  
		var date = new Date(parseInt(t));   
		Y = date.getFullYear() + '-';
		M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : 					date.getMonth()+1) + '-';
		D = date.getDate() + ' ';
		h = date.getHours() + ':';
		m = date.getMinutes() + ':';
		s = date.getSeconds(); 
		return Y+M+D+h+m+s;
	}
	return "";
}

