$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	}); 

//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="rolemanagement_detail.php?id="+id;});
 
//获取详细信息==========================================
initDetail();
function initDetail(){
	var params={uri:"roles/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#name").val(resultobj["data"]["name"]);
		    	 $("#description").val(resultobj["data"]["description"]);
  		    	 $("#appCode").val(resultobj["data"]["appCode"]);
  		     
 		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}
selectData({activeId:"appCode",width:600,height:600,url:"rolemanagement_app_list.php",btntitle:"修改应用"});
selectData({activeId:"confMenuIds",width:600,height:600,url:"rolemanagement_update_confMenu_list.php?id="+id,btntitle:"修改权限"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var name                       = $("#name").val();
	var appCode                    = $("#appCode").attr("appCodeValue");
	var description                = $("#description").val();
	var confMenuIds                = $("#confMenuIds").attr("confMenuIdsValue");
	if(!Mibile_Validation.notEmpty(name,"角色名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(confMenuIds,"菜单id不能为空"))return; 
 	confMenuIds = confMenuIds.substr(0, confMenuIds.length - 1); 
      var obj=new Object();
  	obj.id                       = id;
 	obj.name                     = name;
	obj.appCode                  = appCode;
	obj.description              = description;
	obj.confMenuIds              = confMenuIds;
	var str = JSON.stringify(obj);
	var params={uri:"roles",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="rolemanagement_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
