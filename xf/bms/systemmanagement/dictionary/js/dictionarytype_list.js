//数据操作=============================================================================================================================

 
//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	var params=$("#myform").serialize()	;
	if(params!="")params+="&";
	params+="uri=dictionary_types";
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	gridpage({url:url
				,param:params			                                                       
				,bodyid:"tbody_content"                                                                  
				,pagenavid:"pageNav"                                                                     
				,single:false  
				,showType:1
				,length:13
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
			content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\"  value=\""+id+"\" />";           
			content+="</td>"; 
			content+="<td>"+data[j]["code"]+"</td>";  
			content+="<td>"+data[j]["name"]+"</td>";    
		
			content+="</tr>"; 
	 	   }
	    if(data.length==0){
	    	content+="<tr>";                                                                                           
			content+="<td colspan=3 align='center'>";  
			content+="没有查询到数据"; 
			content+="</td>"; 
			content+="</tr>";
	    	
	    }
   }else{
   	var message=resultobj.message; 
   	content+="<tr>";                                                                                           
		content+="<td colspan=3 align='center'>";  
		content+="错误码："+code+message; 
		content+="</td>"; 
		content+="</tr>";
   }	                                                                           
	return content;  
	
}

$("#btn_add").bind("click",function(){
	
	var url="dictionarytype_add_type.php";
	$("#menumanagement_iframe").attr("src",url);
	
})
 
$("#btn_edit").bind("click", function(){
	var row=checkBoxObj('key');
	 
	if(row.row<1||row.row>1){alert("请选择一条记录");return false;}
	var key=row.value;
  	var url="dictionarytype_update_type.php?id="+key;
	$("#menumanagement_iframe").attr("src",url);
});
$("#btn_code").bind("click", function(){
	var row=checkBoxObj('key');
	 
	if(row.row<1||row.row>1){alert("请选择一条记录");return false;}
	var key=row.value;
  	var url="dictionarytype_add_data.php?id="+key;
	$("#menumanagement_iframe").attr("src",url);
});
	
	

