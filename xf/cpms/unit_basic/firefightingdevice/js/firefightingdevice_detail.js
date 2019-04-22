 

//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="firefightingdevice_list.php";});

//修改信息==========================================
$("#btn_edit").bind("click", function(){window.location.href="firefightingdevice_update.php?id="+id;});

//查询信息==========================================
initDetail();
function initDetail(){
	var params={uri:"fire_fighting_devices/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
//	  //$("#tbody_content").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	  var systemForm=resultobj["data"]["systemForm"];
	    	  var deviceType=resultobj["data"]["deviceType"];
	    	 $("#fightingname").html(resultobj["data"]["name"]);
	    	 $("#buildingId").html(resultobj["data"]["buildingName"]);
	    	 $("#impPartId").html(resultobj["data"]["impPartName"]);
		 	    //	$("#systemForm").find("option[value='"+resultobj["data"]["systemForm"]+"']").attr("selected",true);
	 	 	    //	$("#deviceType").find("option[value='"+resultobj["data"]["deviceType"]+"']").attr("selected",true);
	 		    	// $("#imgName").val(fnChangeName(resultobj["data"]["systemForm"],systemForm_jsarry));
			    //	 $("#position").val(resultobj["data"]["position"]);
			    	 
			    	 systemFormFn(systemForm,deviceType);	    
		
	    	 $("#model").html(resultobj["data"]["model"]);
	    	 $("#areaNum").html(resultobj["data"]["areaNum"]);
	    	 $("#bitNum").html(resultobj["data"]["bitNum"]);
	    	 $("#floor").html(resultobj["data"]["floor"]);
	    	 $("#serviceTime").html(resultobj["data"]["serviceTime"]);
 	    
	    	 $("#serviceStateCode").html(fnChangeName(resultobj["data"]["serviceStateCode"],serviceStateCode_jsarry));
 	    	 $("#productName").html(resultobj["data"]["productName"]);
	    	 $("#productTel").html(resultobj["data"]["productTel"]);
 	    	 $("#maintenanceName").html(resultobj["data"]["maintenanceName"]);
	    	 $("#maintenanceTel").html(resultobj["data"]["maintenanceTel"]);
 	    	 $("#runStateCode").html(fnChangeName(resultobj["data"]["runStateCode"],runStateCode_jsarry));
 	    	 $("#stateChangeTime").html(resultobj["data"]["stateChangeTime"]);
 	    	 $("#stateDescription").html(resultobj["data"]["stateDescription"]);
	    	 $("#cameraNum").html(resultobj["data"]["cameraNum"]);
	    	 $("#shootingAngle").html(resultobj["data"]["shootingAngle"]);
	    	 
	    	 $("#filebase64").val(resultobj["data"]["file"]);
	    	 $("#iconPosition").val(resultobj["data"]["iconPosition"]);
	    	 $("#fileName").val(resultobj["data"]["fileName"]);
	    	 
	    	 $("#btn_addImg").attr("src",resultobj["data"]["file"])

	    	 //加载页面数据回显
	    	 $("#count").html(resultobj["data"]["count"]);
	    	 $("#count1").html(resultobj["data"]["count1"]);
	    	 $("#count2").html(resultobj["data"]["count2"]);
	    	 $("#count3").html(resultobj["data"]["count3"]);
 	    	// $("#position").html(resultobj["data"]["position"]);
	    	  $("#position").html(resultobj["data"]["position"]);
	    	 $("#capacity").html(resultobj["data"]["capacity"]);
 	    	 
	    	 var FireCode=resultobj["data"]["deviceType"];
	    	 $("[name='deviceType']").each(function(){
	    		 if($(this).val()==FireCode){$(this).attr("checked",true);}
	    	 })
	   
	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
 })
}



function systemFormFn(systemForm,deviceType){
	var content="";
	 if(systemForm=="8"){
		 //火灾自动报警系统
			content+="<tr>";
			content+="<th width=\"15%\">探测器数量</th>";
			content+="<td width=\"35%\"><span id=\"count\"></span></td>";
			content+="<th width=\"15%\">控制器数量</th>";
			content+="<td width=\"35%\"><span id=\"count1\"></span></td>"  ;
			content+="</tr>"  ;
			content+="<tr>"  ;
			content+="<th>手动报警按钮数量</th>"    ;
			content+="<td><span id=\"count2\"></span></td>"  ;  
			content+="<th>消防电器控制装置数量</th>"     
			content+="<td><span id=\"count3\"></span></td>" ;   
			content+="</tr>" ; 

		 
	 }else if(systemForm=="9"){
			if(deviceType=="5"||deviceType=="6"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">位置</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">容量</th>"     
			content+="<td width=\"35%\"><span id=\"capacity\"></span></td>" ;   
			content+="</tr>" ; 
			}else if(deviceType=="7"){
				content+="<tr>"  ;
				content+="<th width=\"15%\">消防泵房位置</th>"    ;
				content+="<td width=\"35%\"><span id=\"position\"></span></td>";  
				content+="<th width=\"15%\">消防泵数量</th>"     
				content+="<td width=\"35%\"><span id=\"capacity\"></span></td>" ;   
				content+="</tr>" ; 
				content+="<tr>"  ;
				content+="<th width=\"15%\">消防泵流量</th>"    ;
				content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
				content+="<th width=\"15%\">消防泵扬程</th>"     
				content+="<td width=\"35%\"><span id=\"capacity\"></span></td>" ;   
				content+="</tr>" ; 
				content+="<tr>"  ;
				content+="<th width=\"15%\">消防给水系统平面图</th>"    ;
				content+="<td width=\"85%\" colspan=\"3\"><img src=\"\" id=\"fireimg\"/></td>"  ;  
				content+="</tr>" ; 
				
			}

		 
	 }else if(systemForm=="10"){
		 	//消火栓灭火系统
			if(deviceType=="8"||deviceType=="9"){
				content+="<tr>"  ;
				content+="<th width=\"15%\">数量</th>"    ;
				content+="<td width=\"85%\"  colspan=\"3\"><span id=\"position\"></span></td>"  ;  
				content+="</tr>" ; 
			}
			 
	 }else if(systemForm=="11"){
 
			//自动喷水灭火系统
			if(deviceType=="10"||deviceType=="11"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">位置</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">数量</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ; 
			}else if(deviceType=="12"){
				content+="<tr>"  ;
				content+="<th width=\"15%\">与本系统相连的</th>"    ;
				content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
				content+="</tr>" ; 
				
			}
	 }else if(systemForm=="12"){
		 
			//防烟排烟系统
			if(deviceType=="10"||deviceType=="11"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">位置</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">数量</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ; 
			content+="<tr>"  ;
			content+="<th width=\"15%\">类型</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="</tr>" ; 
			} 
	 }else if(systemForm=="13"){
		 
			//防火门帘系统
			if(deviceType=="14"||deviceType=="15"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">位置</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">数量</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ; 
			} 
	 }else if(systemForm=="14"){
		 
			//消防应急广播系统
			if(deviceType=="16"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">位置</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">数量</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ; 
			} 
	 }else if(systemForm=="15"){
		 
			//应急照明及疏散指示系统
			if(deviceType=="18"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">位置</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">数量</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ; 
			} 
	 }else if(systemForm=="16"){
		 
			//消防供配电系统
			if(deviceType=="19"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">是否独立电柜</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">备用电源形式</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ; 
			} 
	 }else if(systemForm=="17"){
		 
			//灭火器系统
			if(deviceType=="20"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">配置类型</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">生产日期</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ;
			content+="<tr>"  ;
			content+="<th width=\"15%\">更换药剂日期</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">数量</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ; 
			} 
	 }else if(systemForm=="18"){
		 
			//消防电梯系统
			if(deviceType=="18"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">位置</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">数量</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ; 
			} 
	 }else if(systemForm=="19"){
		 
			//消防专用电话系统
			if(deviceType=="17"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">位置</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">数量</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ; 
			} 
	 }else if(systemForm=="20"){
		 
			//智慧用电监测系统
			if(deviceType=="17"){
			content+="<tr>"  ;
			content+="<th width=\"15%\">位置</th>"    ;
			content+="<td width=\"35%\"><span id=\"position\"></span></td>"  ;  
			content+="<th width=\"15%\">数量</th>"     
			content+="<td width=\"35%\"><span id=\"count\"></span></td>" ;   
			content+="</tr>" ; 
			} 
	 } 

	 $("#systemForm_content").empty().append(content);  
}
	 
 
 

