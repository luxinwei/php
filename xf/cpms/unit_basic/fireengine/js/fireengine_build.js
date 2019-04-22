 
$("#btn_reset").bind("click", function(){
//	window.location.href="fireengine_build.php?m="+m;
	window.location.reload(); 
	});
$("#btn_history").bind("click", function(){window.location.href="fireengine_list.php?"});
 
$("#btn_save").bind("click", function(){
	var name                      =$("#name").val();
	var sid                      = $("#sid").val();
	var moduleId                    = $("#moduleId").val();
	var manufacturer                = $("#manufacturer").val();
	
	var model                     = $("#model").val();
	var number               = $("#number").val();
	var description                      = $("#description").val();
	
 	var delFlag = $('[name="delFlag"]:checked ').val();

	if(!Mibile_Validation.notEmpty(name,"主机名称不能为空"))return; 
 	if(!Mibile_Validation.notEmpty(sid,"主机sid不能为空"))return; 
	if(!Mibile_Validation.notEmpty(moduleId,"通讯模组不能为空"))return; 
	if(!Mibile_Validation.notEmpty(number,"编号不能为空"))return; 
	 if(!Mibile_Validation.notEmpty(delFlag,"删除状态不能为空"))return; 
	 

  var obj=new Object();
 	obj.name                            = name;
	obj.sid                       = sid;
	obj.moduleId                     = moduleId;
	obj.manufacturer                 = manufacturer;
	
	obj.model                      = model;
	obj.number                = number;
	obj.description                       = description;
	obj.delFlag               = delFlag;
	
	
	var str = JSON.stringify(obj);
	var params={uri:"mainframes",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="fireengine_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
