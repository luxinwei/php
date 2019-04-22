$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="firealarmaccept_detail.php?id="+id;});
 
//获取详细信息==========================================
initDetail();
function initDetail(){
	var params={uri:"fire_alarm_accepts/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
	//	//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#depId").val(resultobj["data"]["depId"]);
		 		  
		    	 
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
	 		 	 				acceptEndTime=timeFormat
(acceptEndTime);
			 	 			}else{
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
				  	 			
		 			 $("#firstAlarmTime").val(firstAlarmTime);
			    	 $("#acceptTime").val(acceptTime);
			    	 $("#acceptEndTime").val(acceptEndTime);
			    		$("#reportTime").val(reportTime);
			 		 	$("#reportFeebackTime").val(reportFeebackTime);
		    	 
	   		    	 
		    	 $("#acceptedTypeCode").find("option[value='"+resultobj["data"]["acceptedTypeCode"]+"']").attr("selected",true);
		    	 $("#acceptedConfirmCode").find("option[value='"+resultobj["data"]["acceptedConfirmCode"]+"']").attr("selected",true);
		    	 $("#description").val(resultobj["data"]["description"]);
		    	 $("#handleResult").val(resultobj["data"]["handleResult"]);
 		    	 $("#userName").val(resultobj["data"]["userName"]);
		    	 $("#description").val(resultobj["data"]["description"]);
		    	 $("#monitorCenterRankCode").find("option[value='"+resultobj["data"]["monitorCenterRankCode"]+"']").attr("selected",true);
		 		 
		 
		    	    
		    	 $("#monitorUserName").val(resultobj["data"]["monitorUserName"]);
		    	 $("#monitorHandleInfo").val(resultobj["data"]["monitorHandleInfo"]);
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
}
 
//修改信息==========================================
$("#btn_save").bind("click", function(){
	var acceptedConfirmCode              = $("#acceptedConfirmCode").val();
	var reportTime                       = $("#reportTime").val();
	var reportFeebackTime                = $("#reportFeebackTime").val();
	var monitorUserName                  = $("#monitorUserName").val();
	var monitorHandleInfo                = $("#monitorHandleInfo").val();
	var depId                            = $("#depId").val();
	var firstAlarmTime                   = $("#firstAlarmTime").val();
	var acceptTime                       = $("#acceptTime").val();
	var acceptEndTime                    = $("#acceptEndTime").val();
	var acceptedTypeCode                 = $("#acceptedTypeCode").val();
	var handleResult                     = $("#handleResult").val();
	var userName                       = $("#userName").val();
	var description                      = $("#description").val();
	if(!Mibile_Validation.notEmpty(acceptedConfirmCode,"消息确认不能为空"))return; 
	if(!Mibile_Validation.notEmpty(reportTime,"向消防通信指挥中心报告时间不能为空"))return; 
	if(!Mibile_Validation.notEmpty(reportFeebackTime,"消防通信指挥中心反馈确认时间不能为空"))return; 
	if(!Mibile_Validation.notEmpty(monitorUserName,"消防通信指挥中心受理员姓名不能为空"))return; 
	if(!Mibile_Validation.notEmpty(monitorHandleInfo,"消防通信指挥中心接管处理情况不能为空"))return; 
var obj=new Object();
	obj.id                          = id;
	obj.acceptedConfirmCode         = acceptedConfirmCode;
	obj.reportTime                  = reportTime;
	obj.reportFeebackTime           = reportFeebackTime;
	obj.monitorUserName             = monitorUserName;
	obj.monitorHandleInfo           = monitorHandleInfo;
	obj.depId                       = depId;
	obj.firstAlarmTime              = firstAlarmTime;
	obj.acceptTime                  = acceptTime;
	obj.acceptEndTime               = acceptEndTime;
	obj.acceptedTypeCode            = acceptedTypeCode;
	obj.handleResult                = handleResult;
	obj.userName                  = userName;
	obj.description                 = description;
	var str = JSON.stringify(obj);
	var params={uri:"fire_alarm_accepts",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="firealarmaccept_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})
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

