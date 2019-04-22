$("#btn_reset").bind("click", function(){
//	window.location.href="adjacentbuilding_build.php?m="+m;
	window.location.reload(); 
	}); 

//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="manufacturer_detail.php?id="+id;});
 
//获取详细信息==========================================
initDetail();
function initDetail(){
	var params={uri:"part_models/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 //$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 $("#manuname").val(resultobj["data"]["name"]);
 		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
}
//selectData({activeId:"buildingId",width:600,height:600,url:"select_build_list.php",btntitle:"选择建筑"});

//修改信息==========================================
$("#btn_save").bind("click", function(){
	var name            =$("#manuname").val(); 
 
	if(!Mibile_Validation.notEmpty(manuname,"厂商不能为空"))return; 
 
 
      var obj=new Object();
	obj.id                       = id;
	obj.name               = name;
 	var str = JSON.stringify(obj);
	var params={uri:"part_models",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="manufacturer_detail.php?id="+id;
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})
