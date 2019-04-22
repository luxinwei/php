$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
selectData({activeId:"manuid",width:600,height:600,url:"manufacturer_list_select.php",btntitle:"优先选择厂家，没有可以输入"});

$("#btn_history").bind("click", function(){window.location.href="modelmanagement_list.php?"});
 
$("#btn_save").bind("click", function(){
	var mfId            =$("#manuid").attr("manuidValue"); 
 	if(!Mibile_Validation.notEmpty(name,"厂商名称不能为空"))return; 
  
      var obj=new Object();
	obj.model               = model;
	obj.mfId               = mfId;
	 
 	var str = JSON.stringify(obj);
	var params={uri:"part_models",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="modelmanagement_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})