$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="monitorcenter_detail.php?id="+id;});


//地图查看==========================================
$("#btn_map").bind("click", function(){
	var usercode          = $("#usercode").val();
	var tourl="unit_map_gaode.php?id="+id;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2;
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
	
	
});
//获取详细信息==========================================
initDetail();
function initDetail(){
	var params={uri:"monitor_centers/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// $("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#address").val(resultobj["data"]["address"]);
		    	 $("#areaId").val(resultobj["data"]["areaId"]);
		    	 $("#areaId").find("option[value='"+resultobj["data"]["areaId"]+"']").attr("selected",true);
		    	 $("#chargePerson").val(resultobj["data"]["chargePerson"]);
		    	 $("#chargePhone").val(resultobj["data"]["chargePhone"]);
		    	 $("#id").val(resultobj["data"]["id"]);
		    	 $("#monitorCenterRankCode").find("option[value='"+resultobj["data"]["monitorCenterRankCode"]+"']").attr("selected",true);
		    	 $("#pauseFlag").find("option[value='"+resultobj["data"]["pauseFlag"]+"']").attr("selected",true);
		    	 $("#centername").val(resultobj["data"]["name"]);
		    	 $("#position").val(resultobj["data"]["position"]);
		    	 $("#telephone").val(resultobj["data"]["telephone"]);
		    	 $("#parentCenter").val(resultobj["data"]["parentCenter"]);
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
}
selectData({activeId:"areaId",width:600,height:600,url:"select_area_list.php",btntitle:"选择区域"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var centername            =$("#centername").val();
	var areaId                = $("#areaId").attr("areaIdValue");
	var position              = $("#position").val();
	var telephone             = $("#telephone").val();
	var chargePerson          = $("#chargePerson").val();
	var chargePhone           = $("#chargePhone").val();
	var monitorCenterRankCode = $("#monitorCenterRankCode").val();
	var address               = $("#address").val();
	if(!Mibile_Validation.notEmpty(centername,"监控中心名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(areaId,"所属区域不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"地图坐标不能为空"))return; 
	if(!Mibile_Validation.checkTelMobile(telephone,0,"联系电话格式不正确"))return; 
	if(!Mibile_Validation.checkTelMobile(chargePhone,0,"联系电话格式不正确"))return; 
	if(!Mibile_Validation.notEmpty(chargePerson,"中心负责人姓名不能为空"))return; 
	if(!Mibile_Validation.notEmpty(monitorCenterRankCode,"请选择中心级别"))return; 
	if(!Mibile_Validation.notEmpty(address,"监控中心介绍长度最大200字符"))return; 
var obj=new Object();
	obj.id                       = id;
	obj.name                     = centername;
	obj.area_id                  = areaId;
	obj.position                 = position;
	obj.telephone                = telephone;
	obj.charge_person            = chargePerson;
	obj.charge_phone             = chargePhone;
	obj.monitor_center_rank_code = monitorCenterRankCode;
	obj.address                  = address;
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
		    	 window.location.href="monitorcenter_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})
