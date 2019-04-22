
 //A当选择形式内容时
 $("#systemForm").change(function(){
	 $("#systemForm_display").css("display","table");
		//1.获取形式内容
		 var systemFormval= $("#systemForm").find("option:selected").text();
		 //2.设置图片名称
		 $("#imgName").html(systemFormval);
		 //3.获取形式id
		 var systemFormId=$("#systemForm").find("option:selected").val();
		
		//4。判断id所属形式添加内容
	 	 var content="";
		 	content="<tr id=\"leibie\">"
	 		content+="<th width=\"18%\">设施系统类型</th>";
			content+="<td width=\"82%\" colspan=\"3\">";
			content+="<select class=\"hmui-select w\" id=\"deviceType\"  >";
			content+="<option value=\"0\">请选择系统类型</option>";
//---------------------------------------------------------------------------------------------------------------------------
		 if(systemFormId=="9"){//给水系统
				for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==5||deviceTypeCode_jsarray[i][0]==6||deviceTypeCode_jsarray[i][0]==7)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
				}
		 }
//---------------------------------------------------------------------------------------------------------------------------
 		 if(systemFormId=="16"){//供配电系统
 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
				
					if(deviceTypeCode_jsarray[i][0]==19){
 					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";}
			}
 			$("#systemForm_display").css("display","none");
		 }
//---------------------------------------------------------------------------------------------------------------------------
 		 if(systemFormId=="20"){//智慧用电检测系统
 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
				if(deviceTypeCode_jsarray[i][0]==1||deviceTypeCode_jsarray[i][0]==2)
				content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
 			}
  			$("#systemForm_display").css("display","none");
 		 }
 //---------------------------------------------------------------------------------------------------------------------------

		 if(systemFormId=="13"){//防火门帘系统
	 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==14||deviceTypeCode_jsarray[i][0]==15)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
	 			}
	  			$("#systemForm_display").css("display","none");
	 	 }
//---------------------------------------------------------------------------------------------------------------------------
		 if(systemFormId=="11"){//自动喷水灭火系统
	 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==10||deviceTypeCode_jsarray[i][0]==11||deviceTypeCode_jsarray[i][0]==12)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
	 			}
	 	 }
//---------------------------------------------------------------------------------------------------------------------------
		 if(systemFormId=="12"){//防烟排烟系统
	 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==8||deviceTypeCode_jsarray[i][0]==9)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
	 			}
	 	 }
//---------------------------------------------------------------------------------------------------------------------------
		 if(systemFormId=="10"){//消火栓灭火系统
	 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==8||deviceTypeCode_jsarray[i][0]==9)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
	 			}
	 	 }
//---------------------------------------------------------------------------------------------------------------------------
		 if(systemFormId=="14"){//消防应急广播系统
	 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==16)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
	 			}
	 	 }
//---------------------------------------------------------------------------------------------------------------------------
		 if(systemFormId=="19"){//消防电话系统
	 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==17)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
	 			}
	  			$("#systemForm_display").css("display","none");
	 	 }
//---------------------------------------------------------------------------------------------------------------------------
		 if(systemFormId=="15"){//应急照明及疏散指示系统
	 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==18)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
	 			}
	 	 }
//---------------------------------------------------------------------------------------------------------------------------
		 if(systemFormId=="17"){//灭火器系统
	 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==20)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
	 			}
	 	 }
//---------------------------------------------------------------------------------------------------------------------------
		 if(systemFormId=="18"){//消防电梯系统
	 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==21)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
	 			}
	 	 }
//---------------------------------------------------------------------------------------------------------------------------
		 if(systemFormId=="15"){//应急照明及疏散指示系统
	 			for(var i=0;i<deviceTypeCode_jsarray.length;i++){
					if(deviceTypeCode_jsarray[i][0]==18)
					content+="<option  value=\""+deviceTypeCode_jsarray[i][0]+"\" >"+deviceTypeCode_jsarray[i][1];+"</option>";
	 			}
	 	 }
//---------------------------------------------------------------------------------------------------------------------------
		 
		content+="</select>";
		content+="</td>";
		content+="</tr>"  ; 
//5.移除之前形式类别的内容
		 $("#leibie").remove();
//5.移除之前类别的内容
		 $("[name='ms']").each(function(){
			 $(this).remove();
		 })
//6.添加新的内容
		 $("#zhuijia").after(content);  
 })
 
 
 
 
 //====================================================================================================================
 
 //B当选择形式内容时
 $("#deviceType").live("change",function(){
//1.获取选择类型ID	 
		 var deviceTypeCodeid = $("#deviceType").val();		 
//---------------------------------------------------------------------------------------------------------------------------
//a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="5"||deviceTypeCodeid=="6"){//水池。水箱
//b.准备要追加的内容
	    	content="";
	    	content+="<tr name=\"ms\">";
	 		content+="<th><font class=\"cred\">*</font>位置</th>";
			content+="<td><input class=\"hmui-input w\" id=\"position\"/></td>";
	 		content+="<th><font class=\"cred\">*</font>容量</th>";
			content+="<td><input class=\"hmui-input w\" id=\"capacity\"/></td>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
				$(this).remove();
			})
//d.往类型后面追加新的内容
			$("#leibie").after(content);  
  		
	  	  }
//---------------------------------------------------------------------------------------------------------------------------
//a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="7"){//泵房
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>消防泵位置</th>";
			content+="<td><input class=\"hmui-input w\" id=\"position\"/></td>";
			content+="<th><font class=\"cred\">*</font>消防泵数量</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>"; 
			content+="</tr>"  ; 
		   	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>消防泵流量</th>";
			content+="<td><input class=\"hmui-input w\" id=\"capacity\"/></td>";
			content+="<th><font class=\"cred\">*</font>消防泵扬程</th>";
			content+="<td><input class=\"hmui-input w\" id=\"capacity\"/></td>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
//d.往类型后面追加新的内容
		 	$("#leibie").after(content);  
	  	}
//---------------------------------------------------------------------------------------------------------------------------
	  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="8"||deviceTypeCodeid=="9"){//消火栓
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>";
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
 //d.往类型后面追加新的内容
		 	$("#leibie").after(content);  
	  	}
//---------------------------------------------------------------------------------------------------------------------------
//a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="10"||deviceTypeCodeid=="11"){//报警阀、水泵接合器
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>位置</th>";
			content+="<td><input class=\"hmui-input w\" id=\"position\"/></td>";
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
		 	
//d.往类型后面追加新的内容
		 	$("#leibie").after(content);  
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
		 	$("#leibie").after(content);  
	  	}
//---------------------------------------------------------------------------------------------------------------------------
		  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="16"){//应急广播
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>位置</th>";
			content+="<td><input class=\"hmui-input w\" id=\"position\"/></td>";
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
		 	
//d.往类型后面追加新的内容
		 	$("#leibie").after(content);  
	  	}
//---------------------------------------------------------------------------------------------------------------------------
		  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="17"){//消防电话
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>位置</th>";
			content+="<td><input class=\"hmui-input w\" id=\"position\"/></td>";
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
		 	
//d.往类型后面追加新的内容
		 	$("#leibie").after(content);  
	  	}
//---------------------------------------------------------------------------------------------------------------------------
		  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="18"){//应急照明及疏散
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
		 	
//d.往类型后面追加新的内容
		 	$("#leibie").after(content);  
	  	}
//---------------------------------------------------------------------------------------------------------------------------
		  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="20"){//灭火器
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>配置类型</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>"; 
			content+="<th><font class=\"cred\">*</font>生产日期</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>"; 
			content+="</tr>"  ; 
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>跟换药剂日期</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>"; 
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>"; 
			content+="</tr>"  ; 
//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
		 	
//d.往类型后面追加新的内容
		 	$("#leibie").after(content);  
	  	}
//---------------------------------------------------------------------------------------------------------------------------
		  //a.判断id进行复选框选中
	  	if(deviceTypeCodeid=="21"){//灭火器
//b.准备要追加的内容
	   	    content="";
	   	 	content+="<tr name=\"ms\">";
			content+="<th><font class=\"cred\">*</font>位置</th>";
			content+="<td><input class=\"hmui-input w\" id=\"position\"/></td>"; 
			content+="<th><font class=\"cred\">*</font>数量</th>";
			content+="<td><input class=\"hmui-input w\" id=\"count\"/></td>"; 
			content+="</tr>"  ; 

//c.清空之前追加的内容
			$("[name='ms']").each(function(){
			 	$(this).remove();
		 	}) 
		 	
//d.往类型后面追加新的内容
		 	$("#leibie").after(content);  
	  	}
//---------------------------------------------------------------------------------------------------------------------------
 })