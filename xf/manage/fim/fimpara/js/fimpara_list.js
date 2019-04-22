search();
function search(){
	var params=decodeURI($("#myform").serialize());
	var url="fimParaAction.php?action=list&m="+m;
gridpage({url:url
			,param:params		                                                       
			,bodyid:"tbody_content"                                                                  
			,pagenavid:"pageNav"                                                                     
			,single:false
			,length:1000
			,store:function(ds){                                                                     
			         var content="";                                                                 
					 if(ds.totalProperty>0){                                                             
						for(j=0;j<ds.root.length;j++){                                                     
						    var key=ds.root[j]["PARACODE"]                                                 
							content+="<tr>";                                                                 
							content+="<td align='center'>"+(j+1)+"</td>";                                    
							content+="<td align='center'>";                                                  
							content+="<input type=\"checkbox\" name=\"key\" value=\""+key+"\" />";           
							content+="</td>";                                                                
							content+="<td>"+ds.root[j]["PARACODE"]+"</td>";                               
							content+="<td>"+ds.root[j]["PARACONTENT"]+"</td>";                               
							content+="<td>"+ds.root[j]["DESCRIPTION"]+"</td>";                                                          
							content+="</tr>";                                                                
						}                                                                                  
					}                                                                                    
					return content;                                                                      
			 }                                                                                       
	 });                                                                                         
}

function showEdit(){
	var row=checkBoxObj('key');
	if(row.row!=1){alert("请选择一条记录");return false;}
	var key=row.value;
	var tourl="fimpara_edit.php?key="+key+"&m="+m;
	window.location.href=tourl;
}
function showDel(){                                                     
   var row=checkBoxObj('key');                                          
    if(row.row<=0){alert("请选择要删除的信息");return false;}               
    if(!confirm("确认进行此操作吗?"))return false;                      
    var param={keylist:row.value}                                      
    var url="fimParaAction.php?action=del&m="+m;
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