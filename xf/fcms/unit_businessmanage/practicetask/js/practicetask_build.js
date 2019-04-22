$("#btn_history").bind("click", function(){window.location.href="practicetask_list.php";});
selectData({activeId:"executeDepId",width:600,height:600,url:"select_unit_list.php",btntitle:"选择单位"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var beginTime                  =  $("#beginTime").val();
	var endTime                    = $("#endTime").val();
 	var executeDepId              = $("#executeDepId").attr("executeDepIdValue");
	var practiceRequirements                 = $("#practiceRequirements").val();
	var practiceContent                 = $("#practiceContent").val();
	var taskStateCode                 = $("#taskStateCode").val();
	var result                     = $("#result").val();
	var practicetaskname                     = $("#practicetaskname").val();
	var depId                     =  $("#depId").attr("depIdValue");
	 
 
	if(!Mibile_Validation.notEmpty(taskStateCode,"演练状态不能为空"))return; 
 
  var obj=new Object();
 	obj.beginTime                = beginTime
	obj.endTime                  = endTime
	obj.practiceRequirements     = practiceRequirements;
 	obj.executeDepId             = executeDepId;
	obj.practiceContent          = practiceContent;
	obj.taskStateCode            = taskStateCode;
	obj.result                   = result;
	obj.depId                     = depId;
	obj.name                     = practicetaskname;
	var str = JSON.stringify(obj);
	alert(str);
	var params={uri:"practice_tasks",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	 alert(id);
		    	window.location.href="practicetask_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
})
})