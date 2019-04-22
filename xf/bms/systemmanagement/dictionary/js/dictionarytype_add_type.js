$("#btn_reset").bind("click", function(){
//	window.location.href="buildingfireelevator_build.php?m="+m;
	window.location.reload(); 
	});
//保存信息
$("#btn_save").bind("click", function(){
 	var name              = $("#name").val();
	var code              = $("#code").val();
 
	if(!Mibile_Validation.notEmpty(name,"字典名城不能为空"))return; 
	if(!Mibile_Validation.notEmpty(code,"字典编码不能为空"))return; 
 	
    var obj=new Object();
	obj.name               = name;
	obj.code               = code;
	var str = JSON.stringify(obj);
 	var params={uri:"dicationary_types",commitData:str};
	var url=rootPath+"/com/base/InterfacePostAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	 parent.location.href="dictionarytype_list.php"
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})
