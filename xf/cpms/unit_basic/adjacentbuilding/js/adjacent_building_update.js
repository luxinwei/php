 $("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="adjacentbuilding_detail.php?id="+id;});

//获取详细信息==========================================
window.onbeforeunload = function() { 
    return "确认离开当前页面吗？未保存的数据将会丢失";
}
initDetail();
function initDetail(){
	var params={uri:"adjacent_buildings/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		// //$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#buildingId").val(resultobj["data"]["buildingName"]);
		    	 $("#buildingId").attr("buildIdValue",resultobj["data"]["buildingId"]);
		    	 $("#bname").val(resultobj["data"]["name"]);
		    	 $("#height").val(resultobj["data"]["height"]);
 		    	 $("#standoffDistance").val(resultobj["data"]["standoffDistance"]);
		    	 $("#buildingDrectionCode").find("option[value='"+resultobj["data"]["buildingDrectionCode"]+"']").attr("selected",true);
		    	 $("#buildingStructureCode").find("option[value='"+resultobj["data"]["buildingStructureCode"]+"']").attr("selected",true);
		    	 $("#buildingUseKindCode").find("option[value='"+resultobj["data"]["buildingUseKindCode"]+"']").attr("selected",true);
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}

selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var name                      = $("#bname").val();
	var height                    = $("#height").val();
	var buildingId                =$("#buildingId").attr("buildIdValue"); 
	var standoffDistance          = $("#standoffDistance").val();
	var buildingDrectionCode      = $("#buildingDrectionCode").val();
	var buildingStructureCode     = $("#buildingStructureCode").val();
	var buildingUseKindCode       = $("#buildingUseKindCode").val();
 
	if(!Mibile_Validation.notEmpty(name,"建筑物名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingId,"所属建筑物名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(height,"建筑物高度不能为空"))return; 
	if(!Mibile_Validation.notEmpty(standoffDistance,"与本建筑物的距离不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingStructureCode,"建筑物结构类型不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingDrectionCode,"毗邻建筑的方向不能为空"))return; 
	if(!Mibile_Validation.notEmpty(buildingUseKindCode,"建筑物使用性质不能为空"))return; 
 
      var obj=new Object();
	obj.id                       = id;
	obj.buildingId               = buildingId;
	obj.name                     = name;
	obj.height                   = height;
	obj.standoffDistance         = standoffDistance;
	obj.buildingDrectionCode     = buildingDrectionCode;
	obj.buildingStructureCode    = buildingStructureCode;
	obj.buildingUseKindCode      = buildingUseKindCode;
	var str = JSON.stringify(obj);
	var params={uri:"adjacent_buildings",commitData:str};
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
		    	window.location.href="adjacentbuilding_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
