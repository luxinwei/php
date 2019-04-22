
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="systembulletin_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="systembulletin_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"system_notices/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#content").html(resultobj["data"]["content"]);
	    	 $("#scopeValue").html(resultobj["data"]["scopeValue"]);
	    	 $("#createUser").html(resultobj["data"]["createUser"]);
	    	 $("#createTime").html(timeFormat(resultobj["data"]["createTime"]));
	    	 $("#dataStateCode").html(fnChangeName(resultobj["data"]["dataStateCode"],dataStateCode_jsarry));
	    	 $("#bulletinAreaCode").html(fnChangeName(resultobj["data"]["bulletinAreaCode"],bulletinAreaCode_jsarry));
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