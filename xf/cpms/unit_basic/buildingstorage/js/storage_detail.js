 
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="storage_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="storage_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"building_storages/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#buildingName").html(resultobj["data"]["buildingName"]);
	    	 $("#name").html(resultobj["data"]["name"]);
	    	 $("#number").html(resultobj["data"]["number"]);
	    	 $("#nature").html(resultobj["data"]["nature"]);
	    	 $("#shape").html(resultobj["data"]["shape"]);
	    	 $("#cubage").html(resultobj["data"]["cubage"]);
	    	 $("#mainMaterial").html(resultobj["data"]["mainMaterial"]);
	    	 $("#mainProduct").html(resultobj["data"]["mainProduct"]);
 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
     })
}