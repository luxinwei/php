     
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="adjacent_building_list.php";});
 
//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"adjacent_buildings/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
	//	  $("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#buildingName").html(resultobj["data"]["buildingName"]);
	    	 $("#depName").html(resultobj["data"]["depName"]);
	    	 $("#buildingDrectionCode").html(fnChangeName(resultobj["data"]["buildingDrectionCode"],buildingDrectionCode_jsarry));
	    	 $("#name").html(resultobj["data"]["name"]);
	    	 $("#buildingUseKindCode").html(fnChangeName(resultobj["data"]["buildingUseKindCode"],buildingUseKindCode_jsarry));
	    	 $("#buildingStructureCode").html(fnChangeName(resultobj["data"]["buildingStructureCode"],buildingStructureCode_jsarry));
	    	 
	    	 $("#height").html(resultobj["data"]["height"]);
	    	 $("#standoffDistance").html(resultobj["data"]["standoffDistance"]);
  
 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}