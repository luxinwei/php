
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="rectificationnotice_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="rectificationnotice_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"rectification_notices/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
	  //////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
 	    	 $("#code").html(resultobj["data"]["code"]); 
	    	 $("#monitorCenterId").html(resultobj["data"]["sentDepName"]);
 	    	 $("#depId").html(resultobj["data"]["depName"]);
 		 	var checkTime=timeFormat
(resultobj["data"]["checkTime"]);
		 	checkTime=checkTime.substring(0,10);
 	    	 $("#checkTime").html(checkTime);
 	    	 $("#rectificationDeadline").html(resultobj["data"]["rectificationDeadline"]);
 	    	 $("#illegalContent").html(resultobj["data"]["illegalContent"]);
  	    	$("#rectificationStateCode").html(fnChangeName(resultobj["data"]["rectificationStateCode"],rectificationStateCode_jsarry));
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


