$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	});

//返回列表
$("#btn_history").bind("click", function(){window.location.href="adjacentbuilding_list.php";});
selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

//保存信息
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
	obj.buildingId               = buildingId;
	obj.name                     = name;
	obj.height                   = height;
	obj.standoffDistance         = standoffDistance;
	obj.buildingDrectionCode     = buildingDrectionCode;
	obj.buildingStructureCode    = buildingStructureCode;
	obj.buildingUseKindCode      = buildingUseKindCode;
	var str = JSON.stringify(obj);
	var params={uri:"adjacent_buildings",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="adjacentbuilding_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})

//地图查看==========================================
$("#btn_map").bind("click", function(){
	var usercode          = $("#usercode").val();
	var tourl="monitorcenter_map.php?id="+id;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2;
    var iLeft = (window.screen.availWidth-10-iWidth)/2; 
    var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
    popup.focus();
	
	
});
 