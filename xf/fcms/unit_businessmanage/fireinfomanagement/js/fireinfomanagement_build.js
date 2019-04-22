 
//返回列表
$("#btn_history").bind("click", function(){window.location.href="fireinfomanagement_list.php";});
 
//保存信息
$("#btn_save").bind("click", function(){
	var depId                    = $("#depId").val();
	var firePosition             = $("#firePosition").val();
	var fireTime                 = $("#fireTime").val();
	var burnedArea               = $("#burnedArea").val();
	var fireReason               = $("#fireReason").val();
	var deathCount               = $("#deathCount").val();
	var woundCount               = $("#woundCount").val();
	var propertyLoss             = $("#propertyLoss").val();
	var fireFightingDes          = $("#fireFightingDes").val();
	var alarmTypeCode            = $("#alarmTypeCode").val();
	if(!Mibile_Validation.notEmpty(depId,"所属单位id不能为空"))return; 
	if(!Mibile_Validation.notEmpty(firePosition,"起火位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(fireTime,"起火时间不合法"))return; 
	if(!Mibile_Validation.notEmpty(burnedArea,"过火面积不符合要求"))return; 
	if(!Mibile_Validation.notEmpty(fireReason,"起火原因长度应为1-100字符"))return; 
	if(!Mibile_Validation.notEmpty(deathCount,"死亡人数不符合要求"))return; 
	if(!Mibile_Validation.notEmpty(woundCount,"受伤人数不符合要求"))return; 
	if(!Mibile_Validation.notEmpty(propertyLoss,"财产损失不符合要求"))return; 
	if(!Mibile_Validation.notEmpty(fireFightingDes,"火灾扑救描述长度应为1-500字符"))return; 
	if(!Mibile_Validation.notEmpty(alarmTypeCode,"报警方式不能为空"))return; 
var obj=new Object();
	obj.depId                      = depId;
	obj.firePosition                    = firePosition;
	obj.fireTime               = fireTime;
	obj.burnedArea                 = burnedArea;
	obj.fireReason                 = fireReason;
	obj.deathCount                 = deathCount;
	obj.woundCount                 = woundCount;
	obj.propertyLoss               = propertyLoss;
	obj.fireFightingDes            = fireFightingDes;
	obj.alarmTypeCode              = alarmTypeCode;
	var str = JSON.stringify(obj);
	var params={uri:"fire_info_managements",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	 window.location.href="fireinfomanagement_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})

 