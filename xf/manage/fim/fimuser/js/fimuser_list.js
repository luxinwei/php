search();
function search(){

gridpage({url:"FimUserAction.php?action=list&m="+m
			,param:$("#myform").serialize()		                                                       
			,bodyid:"tbody_content"                                                                  
			,pagenavid:"pageNav"                                                                     
			,single:false  
			,length:20
			,store:function(ds){                                                                     
			         var content="";                                                                 
					 if(ds.totalProperty>0){                                                             
						for(j=0;j<ds.root.length;j++){                                                     
						    var key=ds.root[j]["USERCODE"];
						    var pic=ds.root[j]["PIC"];
						    if(pic==""){
						    	pic=rootPath+"/uploadpage/swfupload/images/noimg.png";
						    }else{
						    	pic=fileServerUrl+"/"+pic;
						    }
						    pic=pic.replace(/\ufeff/g,'');
						    var orgid=ds.root[j]["ORGID"];
						    var orgtitle="";
						    for(var x=0;x<org_array.length;x++){
						    	if(org_array[x]["id"]==orgid){
						    		orgtitle=org_array[x]["title"];
						    		break;
						    	}
						    }
						    
							content+="<tr>";                                                                 
							content+="<td align='center'>"+(j+1)+"</td>";                                    
							content+="<td align='center'>";                                                  
							content+="<input type=\"checkbox\" name=\"key\" value=\""+key+"\" />";           
							content+="</td>";
							content+="<td>"+ds.root[j]["USERCODE"]+"</td>";
							content+="<td>"+ds.root[j]["USERACCOUNT"]+"</td>";
							content+="<td>"+ds.root[j]["MOBILE"]+"</td>";
							content+="<td>"+ds.root[j]["EMAIL"]+"</td>";
							content+="<td>"+ds.root[j]["NICKNAME"]+"</td>";
							content+="<td>"+ds.root[j]["REGTIME"]+"</td>";
							//content+="<td>"+orgtitle+"</td>";
							content+="<td>"+fnChangeName(ds.root[j]["FIMGROUPID"],group_jsArray)+"</td>";
							
					                             
							                              
							//content+="<td>"+ds.root[j]["PIC"]+"</td>";                                                          
							content+="</tr>";                                                                
						}                                                                                  
					}                                                                                    
					return content;                                                                      
			 }                                                                                       
	 });         
}
function showAdd(){
	var tourl="fimuser_add.php?m="+m;
	window.location.href=tourl;
}
function showEdit(){
	var row=checkBoxObj('key');
	if(row.row!=1){alert("请选择一条记录");return false;}
	var key=row.value;
	var tourl="fimuser_edit.php?key="+key+"&m="+m;
    window.location.href=tourl;
}
function showModifyPwd(){
	var row=checkBoxObj('key');
	if(row.row!=1){alert("请选择一条记录");return false;}
	var key=row.value;
	var tourl="fimuser_modify_pwd.php?key="+key+"&m="+m;
    window.location.href=tourl;
}

function showDel(){                                                     
   var row=checkBoxObj('key');                                          
    if(row.row<=0){alert("请选择要删除的信息");return false;}               
    if(!confirm("确认进行此操作吗?"))return false;                      
    var param={keylist:row.value,action:'del'}                                      
    var url="FimUserAction.php?action=del&m="+m;
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

$("#orgid").change(function(){
	var orgid=$("option:selected",this).val();
	var params={orgid:orgid};
	var url="FimUserAction.php?action=groups&m="+m;
	$.post(url,params,function(responseText){
		$("#fimgroupid").empty().append(responseText);
	})
	search();
});
$("#fimgroupid").change(function(){
	
	search();
});
