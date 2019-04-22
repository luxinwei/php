$("#btn_history").bind("click", function(){window.location.href="regulatorycenter_list.php";});

$("#btn_save").bind("click", function(){
	var obj=new Object();
	obj.name                     = $("#centername").val();
	obj.area_id                  = $("#areaId").val();
	obj.position                 = $("#position").val();
	obj.telephone                = $("#telephone").val();
	obj.charge_person            = $("#chargePerson").val();
	obj.charge_phone             = $("#chargePhone").val();
	obj.monitor_center_rank_code = $("#monitorCenterRankCode").val();
	obj.address                  = $("#address").val();
	var str = JSON.stringify(obj);
	var params={uri:"monitor_centers",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.reload();
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})
 