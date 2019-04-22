 


//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="firealarmaccept_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="firealarmaccept_updata.php?id="+id;});

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
	 			var acceptTime=""
		 			var acceptTime=resultobj["data"]["acceptTime"];
		  			if(acceptTime!=undefined){
		 				acceptTime=timeFormat
(acceptTime);
		 			}else{
		 				acceptTime="";
		 			}
		  				var acceptEndTime=""
		 	 			var acceptEndTime=resultobj["data"]["acceptEndTime"];
		  	 			if(acceptEndTime!=undefined){
		  	 				alert("ss")
		 	 				acceptEndTime=timeFormat
(acceptEndTime);
		 	 			}else{
		 	 				alert("qq")
		 	 				acceptEndTime="";
		 	 			}
		  	 			var firstAlarmTime=""
			 	 			var firstAlarmTime=resultobj["data"]["firstAlarmTime"];
			  	 			if(firstAlarmTime!=undefined){
			  	 				firstAlarmTime=timeFormat
(firstAlarmTime);
			 	 			}else{
			 	 				firstAlarmTime="";
			 	 			}
	  		 		var reportTime=""
		 	 			var reportTime=resultobj["data"]["reportTime"];
		  	 			if(reportTime!=undefined){
		  	 				reportTime=timeFormat
(reportTime);
		 	 			}else{
		 	 				reportTime="";
		 	 			}		
		  	 			var reportFeebackTime=""
			 	 			var reportFeebackTime=resultobj["data"]["reportFeebackTime"];
		  	 			if(reportFeebackTime!=undefined){
		  	 				reportFeebackTime=timeFormat
(reportFeebackTime);
		 	 			}else{
		 	 				firstAlarmTime="";
		 	 			}
			  	 			
	 			 $("#firstAlarmTime").html(firstAlarmTime);
		    	 $("#acceptTime").html(acceptTime);
		    	 $("#acceptEndTime").html(acceptEndTime);
		    		$("#reportTime").html(reportTime);
		 		 	$("#reportFeebackTime").html(reportFeebackTime);
	    	 
	    	 $("#acceptedTypeCode").html(fnChangeName(resultobj["data"]["acceptedTypeCode"],acceptedTypeCode_jsarry));
	    	 $("#description").html(resultobj["data"]["description"]);
	    	 $("#handleResult").html(resultobj["data"]["handleResult"]);
	    	 $("#acceptUser").html(resultobj["data"]["acceptUser"]);
	    	 $("#description").html(resultobj["data"]["description"]);
	    	 $("#acceptedConfirmCode").html(fnChangeName(resultobj["data"]["acceptedConfirmCode"],acceptedConfirmCode_jsarry));
	    	
 
	    	 
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

