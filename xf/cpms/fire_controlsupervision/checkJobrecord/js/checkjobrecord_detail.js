 
$("#btn_history").bind("click", function(){window.location.href="checkjobrecord_list.php?"});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"inspect_records/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#user").html(resultobj["data"]["user"]);
	    	 $("#depId").html(resultobj["data"]["depId"]);
	    	 $("#checkedDepId").html(resultobj["data"]["checkedDepId"]);
	 		 	var startTime=timeFormat
(resultobj["data"]["startTime"]);
	 		 	//startTime=startTime.substring(0,10);
 				
				var endTime=timeFormat
(resultobj["data"]["endTime"]);
			//	endTime=endTime.substring(0,10);
 				
	    	 $("#startTime").html(startTime);
	    	 $("#endTime").html(endTime);
	    	 $("#result").html(fnChangeName(resultobj["data"]["result"],result_jsarry));
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

