//返回列表
$("#btn_history").bind("click", function(){window.location.href="monitorcenter_list.php";});

selectData({activeId:"areaId",width:600,height:600,url:"select_area_list.php",btntitle:"选择区域"});

//保存信息
$("#btn_save").bind("click", function(){
	var centername            =$("#centername").val();
	var areaId                = $("#areaId").attr("areaIdValue");
	var position              = $("#position").val();
	var telephone             = $("#telephone").val();
	var chargePerson          = $("#chargePerson").val();
	var chargePhone           = $("#chargePhone").val();
	var monitorCenterRankCode = $("#monitorCenterRankCode").val();
	var address               = $("#position").attr(addressvalue);
	alert(address);
	if(!Mibile_Validation.notEmpty(centername,"监控中心名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(areaId,"所属区域不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"地图坐标不能为空"))return; 
	if(!Mibile_Validation.checkTelMobile(telephone,0,"联系电话格式不正确"))return; 
	if(!Mibile_Validation.checkTelMobile(chargePhone,0,"联系电话格式不正确"))return; 
	if(!Mibile_Validation.notEmpty(chargePerson,"中心负责人姓名不能为空"))return; 
	if(!Mibile_Validation.notEmpty(monitorCenterRankCode,"请设置经纬度"))return; 
	if(!Mibile_Validation.notEmpty(address,"请设置经纬度"))return; 

	
	var obj=new Object();
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
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	 window.location.href="monitorcenter_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})

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
 