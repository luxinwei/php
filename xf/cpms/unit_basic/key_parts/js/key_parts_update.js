$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="key_parts_detail.php?id="+id;});
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
$("#img_rf").bind("click", function(){
	window.parent.navfn("单位监管->防火巡查任务管理");
	window.location.href="../../unit_businessmanage/detectionmanagement/detectionmanagement_list.php"});
$("#img_jf").bind("click", function(){
	window.parent.navfn("单位信息->消防设施管理");

	window.location.href="../fire_protectionfacilities/fire_protectionfacilities_list.php"});
//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"important_parts/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#buildingId").val(resultobj["data"]["buildingName"]);
		    	 $("#buildingId").attr("buildIdValue",resultobj["data"]["buildingId"]);
		    	 $("#chargePersonName").val(resultobj["data"]["chargePersonName"]);
		    	 $("#chargePersonId").val(resultobj["data"]["chargePersonId"]);
		    	 $("#chargePersonTel").val(resultobj["data"]["chargePersonTel"]);		    	 
		    	 $("#overallFloorage").val(resultobj["data"]["overallFloorage"]);
		    	 $("#name").val(resultobj["data"]["name"]);
 		    	 $("#position").val(resultobj["data"]["position"]);
		    	 $("#floor").val(resultobj["data"]["floor"]);
		    	 
		    	 var FireCode=resultobj["data"]["dutyCode"];
		    	 $("[name='dutyCode']").each(function(){
		    		 if($(this).val()==FireCode){$(this).attr("checked",true);}
		    	 })
		    	 var FireCode=resultobj["data"]["buildingResistFireCode"];
		    	 $("[name='buildingResistFireCode']").each(function(){
		    		 if($(this).val()==FireCode){$(this).attr("checked",true);}
		    	 })
		    	 var SignCode=resultobj["data"]["fireproofSignCode"];
		    	 $("[name='fireproofSignCode']").each(function(){
		    		 if($(this).val()==SignCode){$(this).attr("checked",true);}
		    	 })
		    	 
		    	 var reasonCode=resultobj["data"]["establishReasonCode"];  
		    	 var reason = reasonCode.split(',');  	
		    	 $("[name='establishReasonCode']").each(function(){
		    		 for(j=0;j<reason.length;j++){if($(this).val()==reason[j]){$(this).attr("checked",true);break;}}
		    	 })
		    	 
		    	 var sourceCode=resultobj["data"]["dangerSourceCode"];  
		    	 var source = sourceCode.split(',');  	
		    	 $("[name='dangerSourceCode']").each(function(){
		    		 for(j=0;j<source.length;j++){if($(this).val()==source[j]){$(this).attr("checked",true);break;}}
		    	 })
 		    	 $("#buildingUseKindCode").find("option[value='"+resultobj["data"]["buildingUseKindCode"]+"']").attr("selected",true);

  		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
}
selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
 
	var buildingId                =$("#buildingId").attr("buildIdValue");  
	var chargePersonName          = $("#chargePersonName").val();
	var chargePersonId            = $("#chargePersonId").val();
	var chargePersonTel           = $("#chargePersonTel").val();
	var overallFloorage           = $("#overallFloorage").val();
	var name                      = $("#name").val();
	var position                  = $("#position").val();
	var floor                     = $("#floor").val();
	var buildingUseKindCode       = $("#buildingUseKindCode").val();
	//单选框值
	var buildingResistFireCode = $('[name="buildingResistFireCode"]:checked ').val();
	var dutyCode = $('[name="dutyCode"]:checked ').val();
	var fireproofSignCode = $('[name="fireproofSignCode"]:checked ').val();
    //复选框值
	var dangerSourceCode=''; 
	$("[name='dangerSourceCode']:checked").each(function(){dangerSourceCode+=$(this).val()+',';})
	dangerSourceCode=dangerSourceCode.substring(0,dangerSourceCode.length-1);
 
	var establishReasonCode=''; 
	$("[name='establishReasonCode']:checked").each(function(){establishReasonCode+=$(this).val()+',';})
	establishReasonCode=establishReasonCode.substring(0,establishReasonCode.length-1);
 
	
	if(!Mibile_Validation.notEmpty(chargePersonName,"消防安全责任人姓名不能为空"))return; 
	if(!Mibile_Validation.checkIDCard(chargePersonId,"0","消防安全责任人身份证号不能为空,身份证号长度应为18字符"))return; 
	if(!Mibile_Validation.checkTelMobile(chargePersonTel,"0","消防安全责任人电话不能为空;电话格式：0371-56694566或 手机号为11位"))return; 
	if(!Mibile_Validation.notEmpty(dutyCode,"管理责任不能为空"))return; 
	if(!Mibile_Validation.notEmpty(name,"重点部位名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingId,"所属建构筑物名称不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(overallFloorage,"建筑面积不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingResistFireCode,"耐火等级不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"所在位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(floor,"所在层数不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingUseKindCode,"建构筑物使用性质不能为空"))return; 
	if(!Mibile_Validation.notEmpty(fireproofSignCode,"消防标志设立情况不能为空"))return; 
	if(!Mibile_Validation.notEmpty(establishReasonCode,"确立消防安全重点部位原因不能为空"))return; 
	if(!Mibile_Validation.notEmpty(dangerSourceCode,"危险源情况不能为空"))return;
    var obj=new Object();
	obj.id                       = id;
	obj.buildingId               = buildingId;
	obj.chargePersonName         = chargePersonName;
	obj.chargePersonId           = chargePersonId;
	obj.chargePersonTel          = chargePersonTel;
	obj.dutyCode                 = dutyCode;
	obj.depId                    = $("#depId").val();
	obj.name                     = name;
	obj.overallFloorage          = overallFloorage;
	obj.floor                    = floor;
	obj.position                 = position;
	obj.buildingUseKindCode      = buildingUseKindCode;
	obj.buildingResistFireCode   = buildingResistFireCode;
	obj.fireproofSignCode        = fireproofSignCode;
	obj.dangerSourceCode         = dangerSourceCode;
	obj.establishReasonCode      = establishReasonCode;
	var str = JSON.stringify(obj);
	var params={uri:"important_parts",commitData:str};
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
		    	window.location.href="key_parts_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
 })
})
