function systemFormFn(systemForm,deviceType){
	var params={uri:"fire_fighting_devices/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
	//////$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
  //A当选择形式内容时systemForm_jsarry
 		 $("#systemForm").html(fnChangeName(resultobj["data"]["systemForm"],systemForm_jsarry));
 		//1.获取形式内容
  		 //2.设置图片名称
		 
		 //3.获取形式id
		
	 
 
 
 
 //====================================================================================================================
 
 //B当选择形式内容时 b
 		 $("#deviceType").html(resultobj["data"]["deviceTypeName"]);
 //1.获取选择类型ID	 
		 var deviceTypeCodeid =resultobj["data"]["deviceType"]
//---------------------------------------------------------------------------------------------------------------------------
		//a.判断id进行复选框选中
			  	if(deviceTypeCodeid=="1"||deviceTypeCodeid=="2"||deviceTypeCodeid=="3"||deviceTypeCodeid=="4"){//泵房
		//b.准备要追加的内容
			   	    content="";
			   	 	content+="<tr name=\"ms\">";
					content+="<th><font class=\"cred\">*</font>探测器数量</th>";
					content+="<td><span id=\"count\"></span>";
					content+="<th><font class=\"cred\">*</font>控制器数量</th>";
					content+="<td><span id=\"count1\"></span>"; 
					content+="</tr>"  ; 
				   	content+="<tr name=\"ms\">";
					content+="<th><font class=\"cred\">*</font>手动报警按钮流量</th>";
					content+="<td><span id=\"count2\"></span>";
					content+="<th><font class=\"cred\">*</font>消防电气控制装置扬程</th>";
					content+="<td><span id=\"count3\"></span>"; 
					content+="</tr>"  ; 
		//c.清空之前追加的内容
					$("[name='ms']").each(function(){
					 	$(this).remove();
				 	}) 
		//d.往类型后面追加新的内容
				 	$("#lieb").after(content); 
			  	}
//---------------------------------------------------------------------------------------------------------------------------
//a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="5"||deviceTypeCodeid=="6"){//水池。水箱
//b.准备要追加的内容
	    	content="";
	    	content+="<tr name=\"ms\">";
	 		content+="<th><font class=\"cred\">*</font>位置</th>";
			content+="<td><span id=\"position\"></span>";
	 		content+="<th><font class=\"cred\">*</font>容量</th>";
			content+="<td><span id=\"capacity\"></span>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
				$(this).remove();
			})
//d.往类型后面追加新的内容
			$("#lieb").after(content); 
  		
	  	  }
	  	
//---------------------------------------------------------------------------------------------------------------------------
//a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="7"){//泵房
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>消防泵位置</th>";
			content+="<td><span id=\"position\"></span>";
			content+="<th><font class=\"cred\">*</font>消防泵数量</th>";
			content+="<td><span id=\"count\"></span>"; 
			content+="</tr>"  ; 
		   	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>消防泵流量</th>";
			content+="<td><span id=\"capacity\"></span>";
			content+="<th><font class=\"cred\">*</font>消防泵扬程</th>";
			content+="<td><span id=\"capacity\"></span>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
//d.往类型后面追加新的内容
		 	$("#lieb").after(content); 
	  	}
//---------------------------------------------------------------------------------------------------------------------------
	  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="8"||deviceTypeCodeid=="9"){//消火栓
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><span id=\"count\"></span>";
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
 //d.往类型后面追加新的内容
		 	$("#lieb").after(content); 
	  	}
//---------------------------------------------------------------------------------------------------------------------------
//a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="10"||deviceTypeCodeid=="11"){//报警阀、水泵接合器
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>位置</th>";
			content+="<td><span id=\"position\"></span>";
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><span id=\"count\"></span>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容

 //d.往类型后面追加新的内容
		 	$("#lieb").after(content); 
	  	}
//---------------------------------------------------------------------------------------------------------------------------
	  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="12"){//屋顶调防水箱
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>与本系统相连的</th>";
			content+="<td>";
			content+="<select class=\"hmui-select w\" id=\"\"  >";
			content+="<option value=\"1\">有</option>";
			content+="<option value=\"0\">无</option>";
			content+="</select>";
			content+="</td>";
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
		 	
//d.往类型后面追加新的内容
		 	$("#lieb").after(content); 
	  	}
//---------------------------------------------------------------------------------------------------------------------------
		  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="16"){//应急广播
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>位置</th>";
			content+="<td><span id=\"position\"></span>";
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><span id=\"count\"></span>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
 //d.往类型后面追加新的内容
		 	$("#lieb").after(content);  
	  	}
//---------------------------------------------------------------------------------------------------------------------------
		  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="17"){//消防电话
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>位置</th>";
			content+="<td><span id=\"position\"></span>";
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><span id=\"count\"></span>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
		 	
//d.往类型后面追加新的内容
		 	$("#lieb").after(content); 
	  	}
//---------------------------------------------------------------------------------------------------------------------------
		  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="18"){//应急照明及疏散
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><span id=\"count\"></span>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
 //d.往类型后面追加新的内容
		 	$("#lieb").after(content); 
	  	}
//---------------------------------------------------------------------------------------------------------------------------
		  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="20"){//灭火器
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>配置类型</th>";
			content+="<td><span id=\"count\"></span>"; 
			content+="<th><font class=\"cred\">*</font>生产日期</th>";
			content+="<td><span id=\"count\"></span>"; 
			content+="</tr>"  ; 
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>跟换药剂日期</th>";
			content+="<td><span id=\"count\"></span>"; 
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><span id=\"count\"></span>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
 //d.往类型后面追加新的内容
		 	$("#lieb").after(content); 
	  	}
//---------------------------------------------------------------------------------------------------------------------------
		  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="21"){//灭火器
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>位置</th>";
			content+="<td><span id=\"position\"></span>"; 
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><span id=\"count\"></span>"; 
			content+="</tr>"  ; 

//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
 //d.往类型后面追加新的内容
		 	$("#lieb").after(content); 
	  	}
//---------------------------------------------------------------------------------------------------------------------------
	})
}
  