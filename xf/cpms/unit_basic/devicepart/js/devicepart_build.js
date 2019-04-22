$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
 
$("#btn_history").bind("click", function(){window.location.href="devicepart_list.php"});
selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

$("#btn_save").bind("click", function(){
	
 	var buildingId            =$("#buildingId").attr("buildIdValue"); 
	var name                = $("#name").val();
	var floor                = $("#floor").val();
	var floor                = $("#model").val();
	var floor                = $("#templateId").val();
 	//if(!Mibile_Validation.notEmpty(buildingId,"所属建构筑物id不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(position,"隧道位置不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(height,"隧道高度不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(length,"隧道长度不能为空"))return; 
 
      var obj=new Object();
	obj.buildingId               = buildingId;
	obj.position                 = position;
	obj.name                   = name;
	obj.floor                   = floor;
	obj.model                   = model;
	obj.model                   = model;
	obj.templateId                   = templateId;
 	var str = JSON.stringify(obj);
	var params={uri:"device_parts",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="tunnel_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})