
search();
function search(){
	params=null;
	url="fimGroupAction.php?action=list&m="+m;
	$.post(url,params,function(responseText){
	     var ds=eval("("+responseText+")"); 
	     var content="";                                                                                                                               
				 if(ds.totalProperty>0){                                                             
					for(j=0;j<ds.root.length;j++){                                                     
						 var key=ds.root[j]["ID"]                                                 
							content+="<tr>";                                                                 
							content+="<td align='center'>"+(j+1)+"</td>";                                    
							content+="<td align='center'>";                                                  
							content+="<input type=\"checkbox\" name=\"key\" value=\""+key+"\" />";           
							content+="</td>";                                                                
							content+="<td>"+ds.root[j]["ID"]+"</td>";  
							content+="<td>"+ds.root[j]["TITLE"]+"</td>";    
							content+="<td>"+ds.root[j]["DESCRIPTION"]+"</td>";
							content+="<td>"+fnChangeName(ds.root[j]["VALID"],sf_array)+"</td>";                               
							content+="</tr>";                                                        
					}                                                                                  
				}                                                                                             
		 $("#tbody_content").empty().append(content);  
	     
})
}

function showAdd(){
	 var tourl="fimgroup_edit.php?m="+m;
	 window.location.href=tourl;
}
function showEdit(){
	var row=checkBoxObj('key');
	if(row.row!=1){alert("请选择一条记录");return false;}
	var key=row.value;
	var tourl="fimgroup_edit.php?key="+key+"&m="+m;
	window.location.href=tourl;
}
function showMenuQx(){
	var row=checkBoxObj('key');
	if(row.row!=1){alert("请选择一条记录");return false;}
	var key=row.value;
	var tourl="menu_list.php?groupid="+key+"&m="+m;
    window.location.href=tourl;
}
function showNewsQx(){
	var row=checkBoxObj('key');
	if(row.row!=1){alert("请选择一条记录");return false;}
	var key=row.value;
	var tourl="newsitems_list.php?groupid="+key+"&m="+m;
    window.location.href=tourl;
}
function showDel(){                                                     
   var row=checkBoxObj('key');                                          
    if(row.row<=0){alert("请选择要删除的信息");return false;}               
    if(!confirm("确认进行此操作吗?"))return false;                      
    var param={keylist:row.value}  
    var url="fimGroupAction.php?action=del&m="+m;
    jQuery.ajax({url:url,                                               
		type:'post',                                                        
		async: false,      //ajax同步                                       
		data:param,                                                         
		dataType:"html",                                                    
		success:function(responseText){                                     
				var data=eval("("+responseText+")");//转化为json串              
			   var success=data.success;                                      
				   if(success==0){                                              
				    alert("删除失败!");                                         
				   }else if(success==1){                                        
				    alert("删除成功!");                                         
				    window.location.reload();                                   
				   }                                                            
	       },                                                             
	    error:function(){                                                 
           alert("系统出现未知异常");                                   
           return false;                                                
        }                                                               
});                                                                     
}                                                                       