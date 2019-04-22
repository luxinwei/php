$("#btn_reset").bind("click", function(){
//	window.location.href="buildingfireelevator_build.php?m="+m;
	window.location.reload(); 
	});
 
 


//保存信息
$("#btn_save").bind("click", function(){
 	var name              = $("#name").val();
	var requestMethod              = $("#requestMethod").val();
	var parentId              = $("#parentId").val();
	var url              = $("#url").val();
	var sortNum              = $("#sortNum").val();
 //	if(!Mibile_Validation.notEmpty(buildingId,"建筑名称不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(position,"电梯位置不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(holdWeight,"电梯载重不能为空"))return; 
	
	
    var obj=new Object();
	obj.name                = name;
	obj.requestMethod       = requestMethod;
	obj.parentId            = parentId;
	obj.url                 = url;
	obj.sortNum                 = sortNum;
 
	var str = JSON.stringify(obj);
 	var params={uri:"menus",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	 parent.location.href="operationmanagement_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})

 