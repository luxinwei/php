 
$("#btn_patrolpoint").bind("click", function(){
	var tourl="btn_patrolpoint_prc.php?m="+m;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2; 
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
});
$("#btn_reset").bind("click", function(){
//	window.location.href="buildingemergencyexit_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表
$("#btn_history").bind("click", function(){window.location.href="patrolpoint_list.php";});
selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});
selectData({activeId:"deviceId",width:600,height:600,url:"select_facilities_list.php",btntitle:"选择设施"});
selectData({activeId:"importantPartId",width:600,height:600,url:"select_keypart_list.php",btntitle:"选择重点部位"});

//保存信息
$("#btn_save").bind("click", function(){
	var buildingId            =$("#buildingId").attr("buildIdValue");  
	var deviceId             =$("#deviceId").val();
	var importantPartId      =$("#importantPartId").attr("importantPartIdvalue");  
	var position              = $("#position").val();
	var patrolname            = $("#patrolname").val();
	var areaNum               = $("#areaNum").val();
	var bitNum                = $("#bitNum").val();
	var floor                 = $("#floor").val();
	var rfidCode                 = $("#rfidCode").val();
	if(!Mibile_Validation.notEmpty(patrolname,"巡查点名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"巡查位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(areaNum,"区号不能为空"))return; 
	if(!Mibile_Validation.notEmpty(bitNum,"位号不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingId,"建筑名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(floor,"楼层不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(floor,"安全出口形式不能为空"))return; 
	
	obj.buildingId               = buildingId;
	obj.deviceId                = deviceId;
	obj.importantPartId           = importantPartId;
	obj.position               = position;
	obj.name                 = patrolname;
	obj.areaNum                     = areaNum;
	obj.bitNum                    = bitNum;
	obj.floor                 = floor;
	obj.rfidCode                 = rfidCode;
	var str = JSON.stringify(obj);
	var params={uri:"patrol_points",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="patrolpoint_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})

 
 