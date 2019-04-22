 $("#btn_reset").bind("click", function(){
//	window.location.href="bussinessmanmanage_build.php?m="+m;
	window.location.reload(); 
	});
 
$("#btn_history").bind("click", function(){window.location.href="systembulletin_detail.php?id="+id;});
//获取详细信息==========================================
initDetail();
function initDetail(){
	var params={uri:"system_notices/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#bulletinAreaCode").find("option[value='"+resultobj["data"]["bulletinAreaCode"]+"']").attr("selected",true);
		    	 $("#dataStateCode").find("option[value='"+resultobj["data"]["dataStateCode"]+"']").attr("selected",true);
   				
		    	 $("#content").val(resultobj["data"]["content"]);
					$("#scopeValue").val(resultobj["data"]["scopeValue"]);
					$("#createUser").val(resultobj["data"]["createUser"]);
					
		 		 	var createTime=timestampToTime(data[j]["createTime"]);
		 		 	createTime=createTime.substring(0,10);
					$("#createTime").val(createTime);
				 
 		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}
 
function timestampToTime(timestamp) {
    var date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
    Y = date.getFullYear() + '-';
    M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
    D = date.getDate() + '';
    h = date.getHours() + ':';
    m = date.getMinutes() + ':';
    s = date.getSeconds();
    return Y+M+D+h+m+s;
}


$("#btn_save").bind("click", function(){
	var content                      =$("#content").val();
	var bulletinAreaCode                      = $("#bulletinAreaCode").val();
 	var scopeValue                = $("#scopeValue").val();
	
	var dataStateCode                     = $("#dataStateCode").val();
	var createUser               = $("#createUser").val();
	var createTime                      = $("#createTime").val();
	
 	
	
/*	if(!Mibile_Validation.notEmpty(name,"用户详情名称不能为空;"))return; 
 	if(!Mibile_Validation.checkTelMobile(phone,"1","人员手机号电话不能为空;电话格式：0371-56694566或 手机号为11位"))return; 
	if(!Mibile_Validation.notEmpty(educationDegree,"用户文化程度不能为空"))return; 
	if(!Mibile_Validation.notEmpty(trainingFlag,"是否受过消防培训不能为空;"))return; 
	if(!Mibile_Validation.notEmpty(evacuationGuide,"是否为疏散引导员不能为空"))return; 
	 */

    var obj=new Object();
    
    obj.id                            = id;
 	obj.content                            = content;
	obj.bulletinAreaCode                       = bulletinAreaCode;
  	
	obj.scopeValue                      = scopeValue;
	obj.dataStateCode                = dataStateCode;
	obj.createUser                       = createUser;
	obj.createTime               = createTime;
	
 	var str = JSON.stringify(obj);
	var params={uri:"system_notices",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="systembulletin_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
