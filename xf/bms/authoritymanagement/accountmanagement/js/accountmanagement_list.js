
$("#owner").change(function(){
 	search();
})
$("#state").change(function(){
	search();	
})
 
$("#btn_search").bind("click", function(){
 	search();
});
applySearch();
search();
function search(){
	var params="";
 	var name=$("#name").val();
    var depId=$("#owner").val();
 	var state=$("#state").val();
  	if(name!=""){params+="name="+name;params+="&";};
 	if(depId!=null){
 		if(depId!=0){
 		params+="depId="+depId;params+="&";}
 		};
 	if(state!="2"){params+="state="+state;params+="&";};
//	var params=$("#myform").serialize()	;
  	params+="uri=users";
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
	// $("#pageNav").parent().after(JSON.stringify(resultobj));
	 // var resultobj=eval("("+responseText+")");
	 var success=resultobj.success; 
     var code=resultobj.code; 
     var content="";   
     var online="";
     if(success){
    	 var data=resultobj.data;
    	 for(j=0;j<data.length;j++){ 
    		 var id=data[j]["id"];
    		 var state=data[j]["state"];
    		 var appCode=data[j]["appCode"];
    		 var depId=data[j]["depId"];
    		 var state=data[j]["state"];
    		content+="<tr align=\'center\'>";   
    		content+="<td align='center'>";                                                  
    		content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\"   state=\""+state+"\" depId=\""+depId+"\" appCode=\""+appCode+"\"   />";           
    		content+="</td>"; 
			content+="<td>"+ClearTrim(data[j]["depName"])+"</td>";  
			content+="<td>"+data[j]["name"]+"</td>";                        
  			content+="<td>"+data[j]["phone"]+"</td>";                        
  		//	content+="<td>"+data[j]["state"]+"</td>";                        
  	 	 	content+="<td>"+fnChangeName(state,a)+"</td>";
 			var birthday=data[j]["birthday"];
 			if(birthday==null){birthday=""}
 			if(birthday!=null&&birthday!=""){birthday=timeFormat(birthday)}
 			content+="<td>"+birthday+"</td>"; 
 			
 			
 			var sex=data[j]["sex"];
 			if(data[j]["sex"]==null){sex=""}
  			content+="<td>"+fnChangeName(sex,sex_jsarry)+"</td>";
	 
			content+="</tr>"; 
	 	   }
	    if(data.length==0){
	    	content+="<tr>";                                                                                           
			content+="<td colspan=7 align='center'>";  
			content+="没有查询到数据"; 
			content+="</td>"; 
			content+="</tr>";
	    	
	    }

    }else{
    	var message=resultobj.message; 
    	content+="<tr>";                                                                                           
		content+="<td colspan=7 align='center'>";  
		content+="错误码："+code+message; 
		content+="</td>"; 
		content+="</tr>";
    }	                                                               
	return content; 
}
function timeFormat(t) {     
	var date = new Date(parseInt(t));   
	Y = date.getFullYear() + '-';
	M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	D = date.getDate() + '';
	return Y+M+D;
	
	}   
//==========================================================================================================================================


function applySearch(){
     var params={uri:"owner_departments"};
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
       // //$("#tbody_content").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
        var success=resultobj.success;
        var code=resultobj.code;
        var content="";
        content+="<option value=\"0\" selected=\"selected\">单位</option>"
        if(success){
            var data=resultobj.data;
            for(j=0;j<data.length;j++){
                var id=data[j]["id"];
                content+="<option value='"+data[j]["id"]+"'>"+data[j]["name"]+"</option>";         
            }
            if(data.length==0){
             alert("没有查询到数据");

            }

        }else{
            var message=resultobj.message;
          alert("错误码："+code+message);
        }
        $("#owner").empty().append(content);  //列表注入位置
    })
}
//==========================================================================================================================================
//重置密码
$("#btn_resetpwd").bind("click", function(){ 
	var row=checkBoxObj('key');
	if(row.row<1||row.row>1){alert("请选择一条记录");return false;}
	var key=row.value;
	
	var tourl="accountmanagement_resetpwd.php?id="+key;
	layer.open({
		  type: 2,
		 
		  title: '重置密码',
		  shadeClose: true,
		  shade: 0.1,
		  area: ['400px', '250px'],
		  content:[tourl, 'no'] //iframe的url
		  ,btn: ['确定','返回']
		  ,yes: function(){
		    	 window.frames[0].saveFn();
		    	 layer.closeAll();
		    	 window.location.href="accountmanagement_list.php";	 	 
		     }
		,btn2: function(index, layero){
			window.location.href="accountmanagement_list.php";	 	
		}

		}); 
});
//==========================================================================================================================================
//初始化账户
 $("#btn_init_user").bind("click", function(){ 
	var row=checkBoxObj('key');
	if(row.row<1||row.row>1){alert("请选择一条记录");return false;}
	var key=row.value;
	var params={uri:"users/"+key+"/init_user"};
		var url=rootPath+"/com/base/InterfacePatchAction.php";
	 	$.post(url,params,function(responseText){	
		     var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
				alert("成功");
				search();
		     }else{
				alert("失败");
				search();
		     }
			                
		 }) 
	 
	 
});
//==========================================================================================================================================
//状态改变
 $("#btn_statechange").bind("click", function(){ 
 		var row=checkBoxObj('key');
 		if(row.row<1||row.row>1){alert("请选择一条记录");return false;}
		var id=row.value;
		var state=$("[name='key']:checked").attr("state");
 			if(state=="0"){
 				state="1";
 			}else{
 				state="0";
 			}
	              
 			var params={uri:"users/"+id+"/"+state};
 	 		var url=rootPath+"/com/base/InterfacePatchAction.php";
 		 	$.post(url,params,function(responseText){	
 	  		     var resultobj=eval("("+responseText+")");
 			     var success=resultobj.success; 
 			     var code=resultobj.code; 
 			     var content="";   
 			     if(success){
 					alert("成功");
 					search();
 			     }else{
 					alert("失败");
 					search();
 			     }
	 			                
	 		 }) 
	 	
 	 	 
	});
//授权
 $("#btn_authorize").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row<1||row.row>1){alert("请选择一条记录");return false;}
	var key=row.value;
 	var appCode=$("[name='key']:checked").attr("appCode");
   	var tourl="accountmanagement_role_select_pic.php?id="+key+"&appCode="+appCode;
 	var iWidth=800; 
 	var iHeight=700; 
 	var iTop = (window.screen.availHeight-30-iHeight)/2; 
     var iLeft = (window.screen.availWidth-10-iWidth)/2; 
     var popup = window.open(tourl,"","height="+iHeight+", width="+iWidth+", top="+iTop+", left="+iLeft);
     popup.focus();
 });

//跳转动作---进入添加页面================================================================================================
$("#btn_add").bind("click", function(){ 
	var tourl="accountmanagement_build.php";  
	window.location.href=tourl;
});
//跳转动作---进入修改页面  id=========================================
$("#btn_edit").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row<1){alert("请选择一条记录");return false;}
	var key=row.value;
	window.location.href="accountmanagement_update.php?id="+key;	 	 
});
//删除动作---删除单条数据=========================================
$("#btn_del").bind("click", function(){
	  var row=checkBoxObj('key');                                          
	  //  if(row.row<=0){alert("请选择要删除的信息");return false;}
		if(row.row<1){alert("请选择一条记录");return false;}
	    if(!confirm("确认进行此操作吗?"))return false;   
	    var id=row.value;
	    var params={uri:"fire_fighting_devices/"+id};
		var url=rootPath+"/com/base/InterfaceDeleteAction.php";

		if(row.row>1){
				    	alert(row.value);
				    	 params={uri:"fire_fighting_devices/batch",commitData:row.value};
				 		 url=rootPath+"/com/base/InterfacePostBatchDelAction.php";
				    }
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
		var tourl="firefightingdevice_xls.php?ids="+ids;
		window.open(tourl);
});



 