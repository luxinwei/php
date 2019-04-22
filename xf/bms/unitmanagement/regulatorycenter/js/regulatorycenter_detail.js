$("#btn_history").bind("click", function(){window.location.href="regulatorycenter_list.php";});
$("#btn_edit").bind("click", function(){window.location.href="regulatorycenter_update.php?id="+id;});
initDetail();
function initDetail(){
	alert(id);
	var params={uri:"monitor_centers/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	

		 ////$("#detail").parent().after(responseText);
		
		 var resultobj=eval("("+responseText+")");
		// {"code":201,"data":{"address":"郑州","areaId":1,"chargePerson":"user1","chargePhone":"15987485840","id":8,"monitorCenterRankCode":"2","name":"F监控中心","position":"113.574443,34.813479","telephone":"15987485840"},"message":"操作成功","success":true}
		 
		 
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 $("#address").html(resultobj["data"]["address"]);
	    	 $("#centername").html(resultobj["data"]["name"]);
	    	 $("#position").html(resultobj["data"]["position"]);
	    	 $("#telephone").html(resultobj["data"]["telephone"]);
	    	 $("#chargePerson").html(resultobj["data"]["chargePerson"]);
	    	 $("#chargePhone").html(resultobj["data"]["chargePhone"]);
	    	 $("#monitorCenterRankCode").html(resultobj["data"]["monitorCenterRankCode"]);
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
     })
}