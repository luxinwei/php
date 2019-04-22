$("#btn_history").bind("click", function(){window.location.href="systembulletin_list.php";});
$("#btn_save").bind("click", function(){
	 
 	var content              = $("#content").val();
	var scopeValue                = $("#scopeValue").val();
	var createUser                = $("#createUser").val();
	var createTime                = $("#createTime").val();
	var dataStateCode                = $("#dataStateCode").val();
	var bulletinAreaCode                = $("#bulletinAreaCode").val();
/*	if(!Mibile_Validation.notEmpty(buildingId,"所属建构筑物id不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"隧道位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(height,"隧道高度不能为空"))return; 
	if(!Mibile_Validation.notEmpty(length,"隧道长度不能为空"))return; */
 
      var obj=new Object();
 	obj.content               = content;
	obj.scopeValue               = scopeValue;
	obj.createUser                 = createUser;
	obj.createTime                   = createTime;
	obj.dataStateCode                   = dataStateCode;
	obj.bulletinAreaCode                   = bulletinAreaCode;
	var str = JSON.stringify(obj);
	var params={uri:"system_notices",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="systembulletin_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})