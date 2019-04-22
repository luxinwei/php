
   
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="buildingfireelevator_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="buildingfireelevator_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"building_fire_elevators/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 //$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#buildingName").html(resultobj["data"]["buildingName"]);
	    	 $("#position").html(resultobj["data"]["position"]);
	    	 $("#holdWeight").html(resultobj["data"]["holdWeight"]);
 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}