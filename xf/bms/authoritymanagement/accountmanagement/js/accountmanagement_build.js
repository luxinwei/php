$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
 
$("#btn_history").bind("click", function(){window.location.href="accountmanagement_list.php?"});
selectData({activeId:"appCode",width:600,height:600,url:"select_app_list.php",btntitle:"选择应用"});
selectData({activeId:"depId",width:600,height:600,url:"select_dep_list.php",btntitle:"选择单位"});

$("#btn_save").bind("click", function(){
	var depId            =$("#depId").attr("depIdValue"); 
 	var name              = $("#name").val();
	var phone                = $("#phone").val();
	var password                = $("#password").val();
	var appCode                = $("#appCode").val();
	var state                = $("#state").val();
	var sex                = $("#sex").val();
	var email                = $("#email").val();
	var address                = $("#address").val();
	var birthday                = $("#birthday").val();
 //	if(!Mibile_Validation.notEmpty(buildingId,"所属建构筑物id不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(position,"隧道位置不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(height,"隧道高度不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(length,"隧道长度不能为空"))return; 
 
      var obj=new Object();
	obj.depId               = depId;
	obj.name                 = name;
	obj.phone                   = phone;
	obj.password                   = password;
	obj.appCode                   = appCode;
	obj.state                   = state;
	obj.sex                   = sex;
	obj.email                   = email;
	obj.address                   = address;
	obj.sex                   = sex;
	obj.birthday                   = birthday;
 	var str = JSON.stringify(obj);
	var params={uri:"users",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="accountmanagement_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})