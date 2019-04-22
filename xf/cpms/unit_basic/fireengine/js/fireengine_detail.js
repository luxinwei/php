 
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="fireengine_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="fireengine_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){

	var params={uri:"mainframes/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		  //////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#name").html(resultobj["data"]["name"]);
	    	 $("#sid").html(resultobj["data"]["sid"]);
	    	 $("#moduleId").html(resultobj["data"]["moduleId"]);
	    	 $("#manufacturer").html(resultobj["data"]["manufacturer"]);
	    	 $("#model").html(resultobj["data"]["model"]);
	    	 $("#number").html(resultobj["data"]["number"]);
	    	 $("#description").html(resultobj["data"]["description"]);
	    	 $("#delFlag").html(resultobj["data"]["delFlag"]);
			$("#delFlag").html(fnChangeName(resultobj["data"]["delFlag"],yesornot_jsarry));
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
 })
}