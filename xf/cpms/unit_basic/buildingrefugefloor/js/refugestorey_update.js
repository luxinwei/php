   
$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});

//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="refugestorey_detail.php?id="+id;});

 
//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"building_refuge_floors/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// 调试//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#buildingId").val(resultobj["data"]["buildingName"]);
		    	 $("#buildingId").attr("buildIdValue",resultobj["data"]["buildingId"]);
		    	 $("#position").val(resultobj["data"]["position"]);
 		    	 $("#acreage").val(resultobj["data"]["acreage"]);
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}
selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var buildingId            =$("#buildingId").attr("buildIdValue");  
	var position              = $("#position").val();
	var acreage             = $("#acreage").val();
	if(!Mibile_Validation.notEmpty(buildingId,"建筑名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(position,"避难层位置不能为空"))return; 
	if(!Mibile_Validation.notEmpty(acreage,"避难层面积不能为空"))return; 
      var obj=new Object();
	obj.id                       = id;
	obj.buildingId              = buildingId;
	obj.acreage                  = acreage;
	obj.position                 = position;
	var str = JSON.stringify(obj);
	var params={uri:"building_refuge_floors",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
window.onbeforeunload = null;
	$.post(url,params,function(responseText){	
		//$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="refugestorey_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
