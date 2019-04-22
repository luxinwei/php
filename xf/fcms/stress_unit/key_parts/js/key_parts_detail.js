    
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="key_parts_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="key_parts_update.php?id="+id;});
$("#img_rf").bind("click", function(){
	window.parent.navfn("单位监管->防火巡查任务管理");
	window.location.href="../../unit_businessmanage/detectionmanagement/detectionmanagement_list.php"});
$("#img_jf").bind("click", function(){
	window.parent.navfn("单位信息->消防设施管理");

	window.location.href="../fire_protectionfacilities/fire_protectionfacilities_list.php"});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"important_parts/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// $("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#chargePersonName").html(resultobj["data"]["chargePersonName"]);
	    	 $("#chargePersonId").html(resultobj["data"]["chargePersonId"]);
	    	 $("#chargePersonTel").html(resultobj["data"]["chargePersonTel"]);
	    	 
	    	 $("#overallFloorage").html(resultobj["data"]["overallFloorage"]);
	    	 $("#name").html(resultobj["data"]["name"]);
	    	 $("#buildingName").html(resultobj["data"]["buildingName"]);
	    	 $("#position").html(resultobj["data"]["position"]);
	    	 $("#floor").html(resultobj["data"]["floor"]);
	    	 $("#buildingResistFireCode").html(fnChangeName(resultobj["data"]["buildingResistFireCode"],buildingResistFireCode_jsarry));
	    	 $("#buildingUseKindCode").html(fnChangeName(resultobj["data"]["buildingUseKindCode"],buildingUseKindCode_jsarry));
	    	 $("#establishReasonCode").html(fnChangeName(resultobj["data"]["establishReasonCode"],establishReasonCode_jsarry));
	    	 $("#fireproofSignCode").html(fnChangeName(resultobj["data"]["fireproofSignCode"],fireproofSignCode_jsarry));
	    	 $("#dangerSourceCode").html(fnChangeName(resultobj["data"]["dangerSourceCode"],dangerSourceCode_jsarry));

 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}