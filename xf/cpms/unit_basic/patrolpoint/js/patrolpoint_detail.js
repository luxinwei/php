 
$("#btn_patrolpoint").bind("click", function(){
	var tourl="btn_patrolpoint_prc.php?m="+m;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});


//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="patrolpoint_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="patrolpoint_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"patrol_points/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// //$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#patrolname").html(resultobj["data"]["name"]);
	    	 $("#position").html(resultobj["data"]["position"]);
	    	 $("#areaNum").html(resultobj["data"]["areaNum"]);
	    	 $("#bitNum").html(resultobj["data"]["bitNum"]);
	    	 $("#buildingId").html(resultobj["data"]["buildingName"]);
	    	 $("#deviceId").html(resultobj["data"]["deviceIdName"]);
	    	 $("#importantPartId").html(resultobj["data"]["importantPartIdName"]);
	    	 $("#floor").html(resultobj["data"]["floor"]);
	    	 $("#rfidCode").html(resultobj["data"]["rfidCode"]);
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
 })
}