$("#btn_history").bind("click", function(){window.location.href="fireInfomanagement_list.php"});

 
//修改信息==========================================
 
//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"fire_info_managements/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 //$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
 	    	 $("#firePosition").html(resultobj["data"]["firePosition"]);
	 		 	var fireTime=timeFormat
(resultobj["data"]["fireTime"]);
 	 		 	fireTime=fireTime.substring(0,10);
 	    	 $("#fireTime").html(fireTime);
	    	 $("#burnedArea").html(resultobj["data"]["burnedArea"]);
	    	 $("#fireReason").html(resultobj["data"]["fireReason"]);
	    	 $("#deathCount").html(resultobj["data"]["deathCount"]);
	    	 $("#woundCount").html(resultobj["data"]["woundCount"]);
	    	 $("#propertyLoss").html(resultobj["data"]["propertyLoss"]);
	    	 $("#fireFightingDes").html(resultobj["data"]["fireFightingDes"]);
	    	 $("#alarmTypeCode").html(fnChangeName(resultobj["data"]["alarmTypeCode"],alarmTypeCode_jsarry));
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
