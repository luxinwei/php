
   
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="gridunit_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="gridunit_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"grid_admins/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 ////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#name").html(resultobj["data"]["name"]);
	    	 $("#areaName").html(resultobj["data"]["areaName"]);
	    	 $("#liaisonOfficer").html(resultobj["data"]["liaisonOfficer"]);
	    	 $("#liaisonOfficerPhone").html(resultobj["data"]["liaisonOfficerPhone"]);
	    	 $("#scopeCoordinates").html(resultobj["data"]["scopeCoordinates"]);
	    	 $("#parentDepName").html(resultobj["data"]["parentDepName"]);
  	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
   })
}