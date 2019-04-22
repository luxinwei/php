 
//返回列表
$("#btn_history").bind("click", function(){window.location.href="traintaskmanagement_list.php";});
 
//保存信息
 $("#btn_save").bind("click", function(){
//	var depId                     =$("#depId").val();
// 	var executeDepId              = $("#executeDepId").val();
	var trainingTitle             = $("#trainingTitle").val();
	var trainingContent            = $("#trainingContent").val();
	var beginTime                  = $("#beginTime").val();
	var endTime                   = $("#endTime").val();
//	var drillStateCode            = $("#drillStateCode").val();

//	if(!Mibile_Validation.notEmpty(depId,"监控中心名称不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(executeDepId,"所属区域不能为空"))return; 
	if(!Mibile_Validation.notEmpty(trainingTitle,"培训标题不能为空"))return; 
	if(!Mibile_Validation.notEmpty(trainingContent,"培训内容不能为空"))return; 
	if(!Mibile_Validation.notEmpty(beginTime,"培训开始时间不能为空"))return; 
 	if(!Mibile_Validation.notEmpty(endTime,"培训结束时间不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(drillStateCode,"请设置经纬度"))return; 
 
	
	var obj=new Object();
 	//obj.depId                   = depId;
 	obj.executeDepId            = executeDepId;
	obj.trainingTitle           = trainingTitle;
	obj.trainingContent         = trainingContent;
	obj.beginTime               = beginTime;
	obj.endTime                 = endTime;
//	obj.drillStateCode           = drillStateCode;
 	var str = JSON.stringify(obj);
	var params={uri:"training_duties",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");	     
		    	 window.location.href="traintaskmanagement_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
}) 

selectData({activeId:"executeDepId",width:600,height:600,url:"select_unit_list.php",btntitle:"选择单位"});
 
 