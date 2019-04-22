$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
 
$("#btn_history").bind("click", function(){window.location.href="rolemanagement_list.php"});
 selectData({activeId:"confMenuIds",width:600,height:600,url:"rolemanagement_confMenu_list.php",btntitle:"选择权限"});
 selectData({activeId:"appCode",width:600,height:600,url:"rolemanagement_app_list.php",btntitle:"选择应用"});

$("#btn_save").bind("click", function(){
  	var name                       = $("#name").val();
	var appCode                    = $("#appCode").attr("appCodeValue");
	var description                = $("#description").val();
	var confMenuIds                = $("#confMenuIds").attr("confMenuIdsValue");
	if(!Mibile_Validation.notEmpty(name,"角色名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(confMenuIds,"菜单id不能为空"))return; 
 	confMenuIds = confMenuIds.substr(0, confMenuIds.length - 1); 
    
	
      var obj=new Object();
 	obj.name                     = name;
	obj.appCode                  = appCode;
	obj.description              = description;
	obj.confMenuIds              = confMenuIds;
	var str = JSON.stringify(obj);
	var params={uri:"roles",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
 		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="rolemanagement_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
 
 
