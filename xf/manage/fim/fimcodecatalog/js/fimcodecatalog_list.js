
function showAdd(){
	var tourl="fimcodecatalog_edit.php?m="+m;
	window.libraryFrame.location.href=tourl;
	
}
function showEdit(key){
	var tourl="fimcodecatalog_edit.php?key="+key+"&m="+m;
	window.libraryFrame.location.href=tourl;
}

function showDel(){                                                     
   var row=checkBoxObj('key');                                          
    if(row.row<=0){alert("请选择要删除的信息");return false;}               
    if(!confirm("确认进行此操作吗?"))return false;                      
    var param={keylist:row.value}                                      
    var url="fimCodecatalogAction.php?action=del&m="+m
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