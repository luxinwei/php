 $("#btn_save").bind("click", function(){ 
 
	var deviceId              = $("#deviceId").val();
	var name                  =  $("#name").val()
	var department                    = $("#department").val()
	var period            = $("#period").val();
	var testTime              = $("#testTime").val();
	var director                = $("#director").val();
	var result                = $("#result").val();
	//var files                        = $("#file_base64").val();
	//var fileNames                    = $("#fileName").val();
	//if(!Mibile_Validation.notEmpty(taskStateCode,"培训状态不能为空"))return; 
	///if(!Mibile_Validation.notEmpty(percentRate,"合格率不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(joiningRate,"参加率不能为空"))return; 
     var obj=new Object();
 	obj.deviceId               = deviceId;
	obj.name                = name
	obj.department                  = department
	obj.period             = period;
	obj.testTime               = testTime;
	obj.director                 = director;
	obj.result                 = result;
  	var str = JSON.stringify(obj);
 	var params={uri:"test_managements",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="trainingduty_list.php";
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
