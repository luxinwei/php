$("#btn_history").bind("click", function(){window.location.href="regulatorycenter_detail.php?id="+id;});

$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});

$("#btn_map").bind("click", function(){
	var usercode          = $("#usercode").val();
	var tourl="regulatorycenter_map.php?id="+id;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2;
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
	
	
});


initDetail();
function initDetail(){
	var params={uri:"monitor_centers/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// ////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
			// {"code":201,"data":{"address":"郑州","areaId":1,"chargePerson":"user1","chargePhone":"15987485840","id":8,"monitorCenterRankCode":"2","name":"F监控中心","position":"113.574443,34.813479","telephone":"15987485840"},"message":"操作成功","success":true}
			 
			 
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#address").val(resultobj["data"]["address"]);
		    	 $("#areaId").val(resultobj["data"]["areaId"]);
		    	 $("#chargePerson").val(resultobj["data"]["chargePerson"]);
		    	 $("#chargePhone").val(resultobj["data"]["chargePhone"]);
		    	 $("#id").val(resultobj["data"]["id"]);
		    	 $("#monitorCenterRankCode").val(resultobj["data"]["monitorCenterRankCode"]);
		    	 $("#centername").val(resultobj["data"]["name"]);
		    	 $("#position").val(resultobj["data"]["position"]);
		    	 $("#telephone").val(resultobj["data"]["telephone"]);
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
}



$("#btn_save").bind("click", function(){
	var obj=new Object();
alert(id)
	obj.id                       = id;
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
	var url=rootPath+"/com/base/InterfacePutAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="regulatorycenter_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})
