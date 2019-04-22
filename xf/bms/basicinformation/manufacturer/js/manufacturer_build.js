$("#btn_reset").bind("click", function(){
//	window.location.href="management_build.php?m="+m;
	window.location.reload(); 
	});
 
$("#btn_history").bind("click", function(){window.location.href="manufacturer_list.php?"});
 
$("#btn_save").bind("click", function(){
	var name            =$("#manuname").val(); 
 	if(!Mibile_Validation.notEmpty(name,"厂商名称不能为空"))return; 
       var obj=new Object();
	obj.name               = name;
 	var str = JSON.stringify(obj);
	var params={uri:"manufacturers",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	window.location.href="manufacturer_list.php";
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
   })
})