$("#btn_reset").bind("click", function(){
//	window.location.href="refugestorey_build.php?m="+m;
	window.location.reload(); 
	});
 
//返回列表
$("#btn_history").bind("click", function(){window.location.href="refugestorey_list.php";});
selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

//保存信息
$("#btn_save").bind("click", function(){
	var buildingId            =$("#buildingId").attr("buildIdValue");  
	var position              = $("#position").val();
	var acreage             = $("#acreage").val();
	if(!Mibile_Validation.notEmpty(buildingId,"建筑名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"避难层位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(acreage,"避难层面积不能为空"))return; 
      var obj=new Object();
	obj.buildingId              = buildingId;
	obj.acreage                  = acreage;
	obj.position                 = position;
	var str = JSON.stringify(obj);
	var params={uri:"building_refuge_floors",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="refugestorey_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})

 
 