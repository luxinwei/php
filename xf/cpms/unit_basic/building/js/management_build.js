$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	//window.location.reload(); 
	document.dataform.reset();
	});
$("#btn_history").bind("click", function(){window.location.href="management_list.php?"});
getdepId();
function getdepId(){
	var params={uri:"owner_departments"};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	 $.post(url,params,function(responseText){	
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     var online="";
	     if(success){
	    	 var data=resultobj.data;
	    		if(data.length==1){  
	    		 var id=data[0]["id"];
	    		 $("#depId").val(id);
		 	   }else if(data.length>1){
		 		  content+="查询数据存在问题";                                                                                           
		 	   }else if(data.length==0){
		 		  content+="没有查询到数据"; 
		    }
	    }else{
	    	var message=resultobj.message; 
	    	content+="错误码："+code+message; 
	    }	
 })
}
$("#btn_save").bind("click", function(){
	var buildname                      =$("#buildname").val();
	var buildTime                      = $("#buildTime").val();
	var buildHeight                    = $("#buildHeight").val();
	var overallFloorage                = $("#overallFloorage").val();
	var floorSpace                     = $("#floorSpace").val();
	var standardFloorage               = $("#standardFloorage").val();
	var workerNum                      = $("#workerNum").val();
	var aboveGroundFloors              = $("#aboveGroundFloors").val();
	var aboveGroundArea                = $("#aboveGroundArea").val();
	var underGroundFloors              = $("#underGroundFloors").val();
	var underGroundArea                = $("#underGroundArea").val();
	var maxnumCapacity                = $("#maxnumCapacity").val();
	var controlRoomPosition            = $("#controlRoomPosition").val();
	var controlRoomPerson                = $("#controlRoomPerson").val();
	var controlRoomPhone               = $("#controlRoomPhone").val();
 	var buildingTypeCode               = $("#buildingTypeCode").val();
	var buildingUseKindCode            = $("#buildingUseKindCode").val();
	var buildingFireDangerCode         = $("#buildingFireDangerCode").val();
	var buildingResistFireCode         = $("#buildingResistFireCode").val();
	var buildingStructureCode          = $("#buildingStructureCode").val();
	if(!Mibile_Validation.notEmpty(buildname,"建构筑物名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingTypeCode,"建筑物分类类别不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildTime,"建造日期不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingUseKindCode,"建构筑物使用性质不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingFireDangerCode,"火灾危险性不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingResistFireCode,"耐火等级不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingStructureCode,"结构类型不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildHeight,"建筑高度不能为空"))return; 
	if(!Mibile_Validation.notEmpty(overallFloorage,"建筑面积不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(floorSpace,"建筑占地面积不符合要求"))return; 
	//if(!Mibile_Validation.notEmpty(standardFloorage,"标准层面积不符合要求"))return; 
	//if(!Mibile_Validation.notEmpty(workerNum,"日常工作时间人数不是必填项，否则最少1人,最多为99999人"))return; 
	if(!Mibile_Validation.notEmpty(aboveGroundFloors,"地上层数不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(aboveGroundArea,"地上层面积不符合要求"))return; 
	if(!Mibile_Validation.notEmpty(underGroundFloors,"地下层数不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(underGroundArea,"地下层面积不符合要求"))return; 
	//if(!Mibile_Validation.notEmpty(maxnumCapacity,"最大容纳人数"))return; 
	if(!Mibile_Validation.notEmpty(controlRoomPosition,"消防控制室位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(controlRoomPerson,"消防控制室联系人不能为空"))return; 
	if(!Mibile_Validation.checkTelMobile(controlRoomPhone,"1","消防控制室电话;电话格式：0371-56694566或 手机号为11位"))return; 

    var obj=new Object();
 	obj.name                            = buildname;
	obj.buildTime                       = buildTime;
	obj.buildHeight                     = buildHeight;
	obj.overallFloorage                 = overallFloorage;
	obj.floorSpace                      = floorSpace;
	obj.standardFloorage                = standardFloorage;
	obj.workerNum                       = workerNum;
	obj.aboveGroundFloors               = aboveGroundFloors;
	obj.aboveGroundArea                 = aboveGroundArea;
	obj.underGroundFloors               = underGroundFloors;
	obj.underGroundArea                 = underGroundArea;
	obj.maxnumCapacity                 = maxnumCapacity;
	obj.controlRoomPosition             = controlRoomPosition;
	obj.controlRoomPerson                 = controlRoomPerson;
	obj.controlRoomPhone                = controlRoomPhone;
 	obj.buildingTypeCode                = buildingTypeCode;
	obj.buildingUseKindCode             = buildingUseKindCode;
	obj.buildingFireDangerCode          = buildingFireDangerCode;
	obj.buildingResistFireCode          = buildingResistFireCode;
	obj.buildingStructureCode           = buildingStructureCode;
	obj.depId                           =$("#depId").val();
	var str = JSON.stringify(obj);
	var params={uri:"buildings",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="management_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
