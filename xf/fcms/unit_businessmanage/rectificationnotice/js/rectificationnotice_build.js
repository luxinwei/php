$("#btn_history").bind("click", function(){window.location.href="rectificationnotice_list.php?"});

//选择单位
selectData({activeId:"depId",width:600,height:600,url:"select_unit_list.php",btntitle:"选择"});

 
//保存信息
$("#btn_save").bind("click", function(){
	var code                   =$("#code").val();
	var depId                  = $("#depId").attr("depIdValue");
	var monitorCenterId        = $("#monitorCenterId").val();
	var checkTime              = $("#checkTime").val();
	var rectificationDeadline  = $("#rectificationDeadline").val();
	var illegalContent         = $("#illegalContent").val();
	var rectificationStateCode = $("#rectificationStateCode").val();
	
	if(!Mibile_Validation.notEmpty(code,"整改通知编号不能为空"))return; 
	if(!Mibile_Validation.notEmpty(depId,"整改单位不能为空"))return; 
	if(!Mibile_Validation.notEmpty(monitorCenterId,"下发单位长度应为1-50字符"))return; 
	if(!Mibile_Validation.notEmpty(checkTime,"检查时间不能为空"))return; 
	if(!Mibile_Validation.notEmpty(rectificationDeadline,"整改期限不能为空"))return; 
	if(!Mibile_Validation.notEmpty(illegalContent,"违规内容不能为空"))return; 
	if(!Mibile_Validation.notEmpty(rectificationStateCode,"整改状态不能为空"))return; 

	
	var obj=new Object();
	obj.code                     = code;
	obj.depId                    = depId;
	obj.monitorCenterId          = monitorCenterId;
	obj.checkTime                = checkTime;
	obj.rectificationDeadline    = rectificationDeadline;
	obj.illegalContent           = illegalContent;
	obj.rectificationStateCode           = rectificationStateCode;
	var str = JSON.stringify(obj);
	var params={uri:"rectification_notices",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="communicationmodule_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})
