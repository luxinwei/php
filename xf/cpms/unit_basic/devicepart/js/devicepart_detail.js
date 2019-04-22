 
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="devicepart_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="devicepart_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"device_parts/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 //$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#deviceName").html(resultobj["data"]["deviceName"]);
	    	 $("#floor").html(resultobj["data"]["floor"]);
	    	 $("#typeName").html(resultobj["data"]["typeName"]);
	    	 $("#name").html(resultobj["data"]["name"]);
	    	 $("#model").html(resultobj["data"]["model"]);
	    	 $("#areaNum").html(resultobj["data"]["areaNum"]);
	    	 $("#circuitNum").html(resultobj["data"]["circuitNum"]);
	    	 $("#bitNum").html(resultobj["data"]["bitNum"]);
	    	 $("#position").html(resultobj["data"]["position"]);
 	    	 $("#state").html(fnChangeName(resultobj["data"]["state"],result_jsarray));
	    	 $("#description").html(resultobj["data"]["description"]);
 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}