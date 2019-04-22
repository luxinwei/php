 
//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params="";
	var fireTime2=$("#fireTime2").val();
	var fireTime1=$("#fireTime1").val();
	if(fireTime1!=""&&fireTime2!=""){
		  
		params=params+"&fireTime1="+fireTime1;
		params=params+"&fireTime2="+fireTime2;
	}	
	if(params!="")params+="&";
	 params+="uri=fire_info_managements";
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	gridpage({url:url
				,param:params			                                                
				,bodyid:"tbody_content"                                                        
				,pagenavid:"pageNav"                                                            
				,single:false  
				,showType:1
				,length:10
				,store:processData                                                                                 
	});         
}
function processData(resultobj){
	////$("#pageNav").parent().after(JSON.stringify(resultobj));
	 // var resultobj=eval("("+responseText+")");
	  var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var id=data[j]["id"];
	    		content+="<tr align='center'>";                                                                                           
				content+="<td align='center'>";                                                  
				content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";           
				content+="</td>";                                                                
 				content+="<td>"+data[j]["firePosition"]+"</td>";  
 	 		 	var fireTime=timeFormat
(data[j]["fireTime"]);
 	 		 	fireTime=fireTime.substring(0,10);
 				content+="<td>"+fireTime+"</td>";
				content+="<td>"+data[j]["fireReason"]+"</td>";   
				content+="<td>"+fnChangeName(data[j]["alarmTypeCode"],alarmTypeCode_jsarry)+"</td>"; //中心级别
				
				content+="<td>"+data[j]["burnedArea"]+"</td>";             
				content+="<td>"+data[j]["deathCount"]+"</td>";             
				content+="<td>"+data[j]["woundCount"]+"</td>";             
				content+="<td>"+data[j]["propertyLoss"]+"</td>";             
 				content+="<td class=\"tc\">";   
				content+="<a class=\"hmui-btn-primary\" href=\"fireInfomanagement_detail.php?id="+id+"\"></a>";
				content+="</td>"; 
				content+="</tr>"; 
				
		 	   }
		    if(data.length==0){
		    	content+="<tr>";                                                                                           
				content+="<td colspan=10 align='center'>";  
				content+="没有查询到数据"; 
				content+="</td>"; 
				content+="</tr>";
		    	
		    }
	    }else{
	    	var message=resultobj.message; 
	    	content+="<tr>";                                                                                           
			content+="<td colspan=10 align='center'>";  
			content+="错误码："+code+message; 
			content+="</td>"; 
			content+="</tr>";
	    }	                                                                
	return content;  
	
}

//跳转动作---进入添加页面================================================================================================
$("#btn_add").bind("click", function(){ 
	var tourl="fireInfomanagement_add.php";  
	window.location.href=tourl;
});
 
//跳转动作---进入审核页面  id=========================================
$("#btn_release").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row<1||row.row>1){alert("请选择一条记录");return false;}
	var key=row.value;
	window.location.href="fireInfomanagement_check.php?id="+key;	 	 
});
//跳转动作---进入修改页面  id=========================================
$("#btn_edit").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row<1||row.row>1){alert("请选择一条记录");return false;}
	var key=row.value;
	window.location.href="fireInfomanagement_update.php?id="+key;	 	 
});
//删除动作---删除单条数据=========================================
$("#btn_del").bind("click", function(){
	  var row=checkBoxObj('key');                                          
	  //  if(row.row<=0){alert("请选择要删除的信息");return false;}
		if(row.row<1){alert("请选择一条记录");return false;}
	    if(!confirm("确认进行此操作吗?"))return false;   
	    var id=row.value;
	    var params={uri:"fire_info_managements/"+id};
		var url=rootPath+"/com/base/InterfaceDeleteAction.php";
		$.post(url,params,function(responseText){
		     var resultobj=eval("("+responseText+")"); 
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		   
		     if(success){
		           alert("成功！");
		           search();
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }	     
	    })    	    
});
//导出数据=========================================
$("#btn_xls").bind("click", function(){
		var row=checkBoxObj('key');
		if(row.row<1){alert("请选择记录");return false;}
		var ids=row.value;
  		var tourl="fireInfomanagement_xls.php?ids="+ids;
		window.open(tourl);
});
 

function timeFormat(t) {   

	if(t==""){	
		return "";
	}else{  
		var date = new Date(parseInt(t));   
		Y = date.getFullYear() + '-';
		M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : 					date.getMonth()+1) + '-';
		D = date.getDate() + ' ';
		h = date.getHours() + ':';
		m = date.getMinutes() + ':';
		s = date.getSeconds(); 
		return Y+M+D+h+m+s;
	}
	return "";
}

