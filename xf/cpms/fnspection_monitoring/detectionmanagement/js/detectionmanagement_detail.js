$("#btn_history").bind("click", function(){window.location.href="detectionmanagement_list.php";});


 

//查询信息==========================================
initDetail();
function initDetail(){
 	var params={uri:"patrol_task_records/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 //////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#depName").html(resultobj["data"]["depName"]);
	    	 $("#executeDepName").html(resultobj["data"]["executeDepName"]);
	    	 $("#patrolUserName").html(resultobj["data"]["patrolUserName"]);
	    	 $("#taskName").html(resultobj["data"]["taskName"]);

	    	 $("#beginTime").html(ClearTrim(timeFormat(resultobj["data"]["beginTime"])));
	    	 $("#endTime").html(ClearTrim(timeFormat(resultobj["data"]["endTime"])));
	    	 $("#createTime").html(ClearTrim(timeFormat(resultobj["data"]["createTime"])));
	    	 $("#deviationTime").html(ClearTrim(timeFormat(resultobj["data"]["deviationTime"])));
 
	    	 $("#overtimeFlag").html(fnChangeName(resultobj["data"]["overtimeFlag"],overtimeFlag_jsarry));
	    	 $("#pointCount").html(resultobj["data"]["pointCount"]);
	    	 $("#overtimeFlag").html(resultobj["data"]["overtimeFlag"]);
	    	 $("#patrolPoints").html(resultobj["data"]["patrolPoints"]);
   	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}
function timeFormat(t) {     
	var date = new Date(parseInt(t));   
	Y = date.getFullYear() + '-';
	M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	D = date.getDate() + '';
	h = date.getHours() + ':';
	m = date.getMinutes() + ':';
	s = date.getSeconds(); 
	return Y+M+D+h+m+s;
	
	}   