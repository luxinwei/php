


 
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params="";
	var name=$("#name").val();

	if(name!=""){params+="name="+name;};
	if(params!="")params+="&";
	params+="uri=system_menus";
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
     var online="";
     if(success){
    	 var data=resultobj.data;
    	 for(j=0;j<data.length;j++){ 
    		 var id=data[j]["id"];
     		content+="<tr align=\'center\'>";   
    		content+="<td align='center'>";                                                  
    		content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";           
    		content+="</td>"; 
			content+="<td>"+data[j]["name"]+"</td>";  
			content+="<td>"+data[j]["level"]+"</td>";  
			content+="<td>"+timeFormat(data[j]["createTime"])+"</td>";  
			content+="<td>"+data[j]["appCode"]+"</td>";                                        
            content+="<td >";
            content+="<a class=\"hmui-btn-primary\" href=\"menumanagement_detail.php?id="+id+"\"></a>";
            content+="</td>";
			content+="</tr>"; 
			
	 	   }
	    if(data.length==0){
	    	content+="<tr>";                                                                                           
			content+="<td colspan=6 align='center'>";  
			content+="没有查询到数据"; 
			content+="</td>"; 
			content+="</tr>";
	    	
	    }

    }else{
    	var message=resultobj.message; 
    	content+="<tr>";                                                                                           
		content+="<td colspan=6 align='center'>";  
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

//跳转动作---进入修改页面  id=========================================
$("#btn_edit").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row<1){alert("请选择一条记录");return false;}
	var key=row.value;
	window.location.href="menumanagement_detail.php?id="+key;	 	 
});