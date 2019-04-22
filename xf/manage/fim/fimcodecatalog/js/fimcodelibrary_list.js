
search();
function search(){
	
	var params={codeno:codeno}
	var url="fimCodelibraryAction.php?action=list&m="+m;
	  $.post(url,params,function(responseText){
		  var content="";
		  var ds=eval("("+responseText+")");//转化为json串
		  for(j=0;j<ds.root.length;j++){                                                     
			    var key=ds.root[j]["ID"]                                                 
				content+="<tr>";                                                                 
				//content+="<td align='center'>"+(j+1)+"</td>";                                    
				content+="<td align='center'>";                                                  
				content+="<input type=\"checkbox\" name=\"key\" value=\""+key+"\" />";           
				content+="</td>";                                                                                                                         
				content+="<td>"+ds.root[j]["ITEMNO"]+"</td>";                               
				content+="<td>"+ds.root[j]["ITEMNAME"]+"</td>";                                                             
				content+="<td>"+ds.root[j]["REMARK"]+"</td>";                               
				content+="</tr>";                                                                
			}
		  $("#tbody_content").empty().append(content);
	  })                                                                                        
}
function showAdd(){
	var tourl="fimcodelibrary_edit.php?codeno="+codeno+"&m="+m;
	window.location.href=tourl;
}
function showEdit(){
	var row=checkBoxObj('key');
	if(row.row!=1){alert("请选择一条记录");return false;}
	var key=row.value;
	var tourl="fimcodelibrary_edit.php?key="+key+"&m="+m;
	window.location.href=tourl;
}
function showOrder(){
	var tourl="fimcodelibrary_order.php?codeno="+codeno+"&m="+m;
	window.location.href=tourl;
	
}
function showDel(){                                                     
   var row=checkBoxObj('key');                                          
    if(row.row<=0){alert("请选择要删除的信息");return false;}               
    if(!confirm("确认进行此操作吗?"))return false;                      
    var param={keylist:row.value,action:'del'}                                      
    var url="fimCodelibraryAction.php?action=del&m="+m
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
					   setTimeout(function(){
            				alert('操作成功！');
            				window.location.reload();
        		           },1000); 
		                                  
				   }                                                            
	       },                                                             
	    error:function(){                                                 
           alert("系统出现未知异常");                                   
           return false;                                                
        }                                                               
});                                                                     
}                                                                       