singlePicUpload();

$("#btn_reset").bind("click", function(){
//	window.location.href="buildingfireelevator_build.php?m="+m;
	window.location.reload(); 
	});
//地图查看==========================================
$("#btn_map").bind("click", function(){
	var usercode          = $("#usercode").val();
	var scopeCoordinates          = $("#scopeCoordinates").val();
	 scopeCoordinates=scopeCoordinates.split(";");
	 var ss="[";
	for (var i=0 ; i< scopeCoordinates.length ; i++)
	{
		if(ss!="["){ss+=",";}
		ss+="["+scopeCoordinates[i]+"]";
	}
	ss+="]";
 
	var tourl="unit_map_gaode_detail.php?scopeCoordinates="+ss;
	var iWidth=1000; 
	var iHeight=800; 
	var iTop = (window.screen.availHeight-30-iHeight)/2;
  var iLeft = (window.screen.availWidth-10-iWidth)/2; 
  var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
  popup.focus();
	
	
});
//返回列表
$("#btn_history").bind("click", function(){window.location.href="gridunit_detail.php?id="+id; });
 selectData({activeId:"areaId",width:600,height:600,url:"select_area_list.php",btntitle:"选择区域"});
 initDetail();
 function initDetail(){
 	var params={uri:"grid_admins/"+id};
 	var url=rootPath+"/com/base/InterfaceGetAction.php";
 	$.post(url,params,function(responseText){	
 		// ////$("#detail").parent().after(responseText);
 		 var resultobj=eval("("+responseText+")");
 	     var success=resultobj.success; 
 	     var code=resultobj.code; 
 	     var content="";   
 	     if(success){
 	    	 $("#name").val(resultobj["data"]["name"]);
 	    	 $("#areaName").val(resultobj["data"]["areaName"]);
 	    	 $("#liaisonOfficer").val(resultobj["data"]["liaisonOfficer"]);
 	    	 $("#liaisonOfficerPhone").val(resultobj["data"]["liaisonOfficerPhone"]);
 	    	 $("#scopeCoordinates").val(resultobj["data"]["scopeCoordinates"]);
 	    	 $("#parentDepName").val(resultobj["data"]["parentDepName"]);
 	    	 $("#scopeCoordinates").val(resultobj["data"]["scopeCoordinates"]);
   	    }else{
 	    	var message=resultobj.message; 
 	    	alert("错误码："+code+message);
 	    }   
    })
 }
//保存信息
$("#btn_save").bind("click", function(){
	var areaId                     =$("#areaId").attr("areaIdValue");  
	var name                       = $("#name").val();
	var liaisonOfficer             = $("#liaisonOfficer").val();
	var liaisonOfficerPhone        = $("#liaisonOfficerPhone").val();
	var scopeCoordinates           = $("#scopeCoordinates").val();
	var parentDepName              = $("#parentDepName").val();
 	//if(!Mibile_Validation.notEmpty(buildingId,"建筑名称不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(position,"电梯位置不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(holdWeight,"电梯载重不能为空"))return; 
      var obj=new Object();
     obj.id                            =id;
	obj.areaId                         = areaId;
	obj.name                           = name;
	obj.liaisonOfficer                 = liaisonOfficer;
	obj.liaisonOfficerPhone            = liaisonOfficerPhone;
	obj.scopeCoordinates               = scopeCoordinates;
	obj.parentDep                      = parentDepName;
	var str = JSON.stringify(obj);
	var params={uri:"grid_admins",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="gridunit_detail.php?id="+id; 
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})

 
 