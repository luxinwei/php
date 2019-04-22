//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="electricmonitor_list9.php?partId="+partId;});

//修改信息==========================================
 
//查询信息==========================================
initDetail();
function initDetail(){
	
	var params={uri:"pointType/eventDetails/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 ////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#time").html(timeFormat(ClearTrim(resultobj["data"]["time"])));
	    	 $("#type").html(ClearTrim(resultobj["data"]["type"]));
	    	 $("#buildingName").html(ClearTrim(resultobj["data"]["buildingName"]));
	    	 $("#impName").html(ClearTrim(resultobj["data"]["impName"]));
	    	 $("#deviceName").html(ClearTrim(resultobj["data"]["deviceName"]));
	    	 $("#disposeTime").html(ClearTrim(timeFormat(resultobj["data"]["disposeTime"])));
	    	 $("#state").html(ClearTrim((fnChangeName(resultobj["data"]["state"],state_jsarry))));
	    	 $("#result").html(ClearTrim(resultobj["data"]["result"]));
	    	 $("#content").html(ClearTrim(resultobj["data"]["content"]));
	    	 $("#eventId").html(ClearTrim(resultobj["data"]["eventId"]));
	    	 $("#partId").html(ClearTrim(resultobj["data"]["partId"]));
	    	 
 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}
function timeFormat(t) { 
	if(t==""||t==null){
		return "";
	}else{
	var date = new Date(parseInt(t));   
	Y = date.getFullYear() + '-';
	M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	D = date.getDate() + '';
	h = date.getHours() + ':';
	m = date.getMinutes() + ':';
	s = date.getSeconds(); 
	return Y+M+D+h+m+s;
	}
	return "";
	}   