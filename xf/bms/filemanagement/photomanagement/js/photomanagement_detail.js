
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="communicationmodule_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="communicationmodule_update.php?id="+id;});
 
initDetail();
function initDetail(){
 
	var params={uri:"files/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// //$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#sid").html(resultobj["data"]["sid"]);
	    	 $("#depName").html(resultobj["data"]["depName"]);
	    	 $("#name").html(resultobj["data"]["name"]);
 	    	 $("#position").html(resultobj["data"]["position"]);
	    	 $("#description").html(resultobj["data"]["description"]);
	    	 $("#comMouldCode").html(fnChangeName(resultobj["data"]["comMouldCode"],comMouldCode_jsarry));
 	     
 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}