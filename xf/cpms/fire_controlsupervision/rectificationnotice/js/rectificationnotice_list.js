 
//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params=$("#myform").serialize()	;
	if(params!="")params+="&";
	params+="uri=rectification_notices";
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
	// //$("#tbody_content").parent().after(JSON.stringify(resultobj));
	
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
			content+="<td>"+data[j]["code"]+"</td>";  
			content+="<td>"+data[j]["depName"]+"</td>"; 
		 	var checkTime=timeFormat
(data[j]["checkTime"]);
		 	checkTime=checkTime.substring(0,10);
			content+="<td>"+checkTime+"</td>";   
			content+="<td>"+data[j]["rectificationDeadline"]+"</td>";   
 			content+="<td>"+fnChangeName(data[j]["rectificationStateCode"],rectificationStateCode_jsarry)+"</td>"; 
			content+="<td class=\"tc\">";   
			content+="<a class=\"hmui-btn-primary\" href=\"rectificationnotice_detail.php?id="+id+"\"></a>";
 			content+="</td>"; 
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
$("#btn_feedback").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row<1||row.row>1){alert("请选择一条记录");return false;}
	var key=row.value;
	window.location.href="practicetask_update.php?id="+key;	 	 
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





 
 