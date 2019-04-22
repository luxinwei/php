//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"fire_fighting_devices/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
//	    	 $("#chargePersonName").html(resultobj["data"]["chargePersonName"]);
//	    	 $("#chargePersonId").html(resultobj["data"]["chargePersonId"]);
//	    	 $("#chargePersonTel").html(resultobj["data"]["chargePersonTel"]);
//	    	 $("#importentname").html(resultobj["data"]["importentname"]);
//	    	 $("#buildingName").html(resultobj["data"]["buildingName"]);
//	    	 $("#overallFloorage").html(resultobj["data"]["overallFloorage"]);
//	    	 $("#position").html(resultobj["data"]["position"]);
//	    	 $("#floor").html(resultobj["data"]["floor"]);
//	    	 $("#monitorCenterRankCode").find("option[value='"+resultobj["data"]["monitorCenterRankCode"]+"']").attr("selected",true);	
//	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
     })
}