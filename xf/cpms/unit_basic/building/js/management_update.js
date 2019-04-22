$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="management_detail.php?id="+id;});
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


//查询信息==========================================
initDetail();
function initDetail() {

	var params = {uri: "buildings/" + id};
	var url = rootPath + "/com/base/InterfaceGetAction.php";
	$.post(url, params, function (responseText) {
		// //////$("#tbody_content").parent().after(responseText);
		var resultobj = eval("(" + responseText + ")");
		var success = resultobj.success;
		var code = resultobj.code;
		var content = "";
		if (success) {
	    	 $("#buildingTypeCode").html(fnChangeName(resultobj["data"]["buildingTypeCode"],buildingTypeCode_jsarry));
	    	 $("#buildingUseKindCode").html(fnChangeName(resultobj["data"]["buildingUseKindCode"],buildingUseKindCode_jsarry));
	    	 $("#buildingFireDangerCode").html(fnChangeName(resultobj["data"]["buildingFireDangerCode"],buildingFireDangerCode_jsarry));
	    	 $("#buildingResistFireCode").html(fnChangeName(resultobj["data"]["buildingResistFireCode"],buildingResistFireCode_jsarry));
	    	 $("#monitorCenterRankCode").html(fnChangeName(resultobj["data"]["monitorCenterRankCode"],monitorCenterRankCode_jsarry));
	    	 $("#buildingStructureCode").html(fnChangeName(resultobj["data"]["buildingStructureCode"],monitorCenterRankCode_jsarry));
	    	 $("#buildname").html(resultobj["data"]["name"]);
	 		 
	    	var buildTime=timeFormat
(data[j]["buildTime"]);
	 		buildTime=buildTime.substring(0,10);
			$("#buildTime").html(buildTime);
			$("#buildHeight").html(resultobj["data"]["buildHeight"]);
			$("#overallFloorage").html(resultobj["data"]["overallFloorage"]);
			$("#floorSpace").html(resultobj["data"]["floorSpace"]);
			$("#standardFloorage").html(resultobj["data"]["standardFloorage"]);
			$("#workerNum").html(resultobj["data"]["workerNum"]);
			$("#aboveGroundFloors").html(resultobj["data"]["aboveGroundFloors"]);
			$("#aboveGroundArea").html(resultobj["data"]["aboveGroundArea"]);
			$("#underGroundFloors").html(resultobj["data"]["underGroundFloors"]);
			$("#underGroundArea").html(resultobj["data"]["underGroundArea"]);
			$("#maxnumCapacity").html(resultobj["data"]["maxnumCapacity"]);
			$("#controlRoomPosition").html(resultobj["data"]["controlRoomPosition"]);
			$("#controlRoomPerson").html(resultobj["data"]["controlRoomPerson"]);
			$("#controlRoomPhone").html(resultobj["data"]["controlRoomPhone"]);
		} else {
			var message = resultobj.message;
			alert("错误码：" + code + message);
		}
	})
}
function timeFormat
(timestamp) {
  var date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
  Y = date.getFullYear() + '-';
  M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
  D = date.getDate() + '';
  h = date.getHours() + ':';
  m = date.getMinutes() + ':';
  s = date.getSeconds();
  return Y+M+D+h+m+s;
}

//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"buildings/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#buildingTypeCode").find("option[value='"+resultobj["data"]["buildingTypeCode"]+"']").attr("selected",true);
		    	 $("#buildingUseKindCode").find("option[value='"+resultobj["data"]["buildingUseKindCode"]+"']").attr("selected",true);
		    	 $("#buildingFireDangerCode").find("option[value='"+resultobj["data"]["buildingFireDangerCode"]+"']").attr("selected",true);
		    	 $("#buildingResistFireCode").find("option[value='"+resultobj["data"]["buildingResistFireCode"]+"']").attr("selected",true);
		    	 $("#buildingStructureCode").find("option[value='"+resultobj["data"]["buildingStructureCode"]+"']").attr("selected",true);
					$("#buildname").val(resultobj["data"]["name"]);
			    	 var buildTime=timeFormat
(resultobj["data"]["buildTime"]);
			 		 	buildTime=buildTime.substring(0,10);
					$("#buildTime").val(buildTime);
					$("#buildHeight").val(resultobj["data"]["buildHeight"]);
					$("#overallFloorage").val(resultobj["data"]["overallFloorage"]);
					$("#floorSpace").val(resultobj["data"]["floorSpace"]);
					$("#standardFloorage").val(resultobj["data"]["standardFloorage"]);
					$("#workerNum").val(resultobj["data"]["workerNum"]);
					$("#aboveGroundFloors").val(resultobj["data"]["aboveGroundFloors"]);
					$("#aboveGroundArea").val(resultobj["data"]["aboveGroundArea"]);
					$("#underGroundFloors").val(resultobj["data"]["underGroundFloors"]);
					$("#underGroundArea").val(resultobj["data"]["underGroundArea"]);
					$("#maxnumCapacity").val(resultobj["data"]["maxnumCapacity"]);
					$("#controlRoomPosition").val(resultobj["data"]["controlRoomPosition"]);
					$("#controlRoomPerson").val(resultobj["data"]["controlRoomPerson"]);
					$("#controlRoomPhone").val(resultobj["data"]["controlRoomPhone"]);
 		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}
 

//修改信息==========================================
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
	if(!Mibile_Validation.notEmpty(controlRoomPosition,"消防控制室不能为空长度应为1-100字符"))return; 
	if(!Mibile_Validation.notEmpty(controlRoomPerson,"消防控制室联系人不能为空长度应为1-20字符"))return; 
	if(!Mibile_Validation.checkTelMobile(controlRoomPhone,"1","消防控制室电话不能为空;电话格式：0371-56694566或 手机号为11位"))return; 

    var obj=new Object();
	obj.id                              = id;
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
	var url=rootPath+"/com/base/InterfacePutAction.php";
window.onbeforeunload = null;
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="management_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
function timeFormat(t) {   

	if(t==""){	
		return "";
	}else{  
		var date = new Date(parseInt(t));   
		Y = date.getFullYear() + '-';
		M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : 					date.getMonth()+1) + '-';
		D = date.getDate() + ' ';
		h = date.getHours() + ':';
		m = date.getMinutes() + ':';
		s = date.getSeconds(); 
		return Y+M+D+h+m+s;
	}
	return "";
}
