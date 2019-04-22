$("#btn_reset").bind("click", function(){
//	window.location.href="storage_build.php?m="+m;
	window.location.reload(); 
	});
 
//返回列表
$("#btn_history").bind("click", function(){window.location.href="storage_list.php";});
selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

//保存信息
$("#btn_save").bind("click", function(){
	var buildingId              =$("#buildingId").attr("buildIdValue"); 
	var name                    = $("#name").val();
	var number                  = $("#number").val();
	var nature                  = $("#nature").val();
	var shape                   = $("#shape").val();
	var cubage                  = $("#cubage").val();
	var mainMaterial               = $("#mainMaterial").val();
	var mainProduct               = $("#mainProduct").val();
	if(!Mibile_Validation.notEmpty(buildingId,"建筑名称名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(name,"储储存物管理存物名称不能为空"))return; 
	if(!Mibile_Validation.notEmpty(number,"储存物数量不能为空"))return; 
	if(!Mibile_Validation.notEmpty(nature,"储存物性质不能为空"))return; 
	if(!Mibile_Validation.notEmpty(shape,"储存物形态不能为空"))return; 
	if(!Mibile_Validation.notEmpty(cubage,"储存物容积不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(mainMaterial,"主要原料不能为空"))return; 
	//if(!Mibile_Validation.notEmpty(mainProduct,"主要产品不能为空"))return; 
        var obj=new Object();
	obj.buildingId                   = buildingId;
	obj.name                         = name;
	obj.number                       = number;
	obj.nature                       = nature;
	obj.shape                        = shape;
	obj.cubage                       = cubage;
	obj.mainMaterial                 = mainMaterial;
	obj.mainProduct                  = mainProduct;
	var str = JSON.stringify(obj);
	var params={uri:"building_storages",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="storage_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})

 
 