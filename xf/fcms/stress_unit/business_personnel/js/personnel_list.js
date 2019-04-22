 
//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params=$("#myform").serialize()	;
	if(params!="")params+="&";
	params+="uri=user_infos";
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
	// $("#tbody_content").parent().after(JSON.stringify(resultobj));
	
	 // var resultobj=eval("("+responseText+")");
		var success = resultobj.success;
		var code = resultobj.code;
		var content = "";
		if (success) {
			var data=resultobj.data;
			for(j=0;j<data.length;j++){
				var id=data[j]["id"];
				content+="<tr align='center'>";
				content+="<td align='center'>";                                                  
				content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" />";           
				content+="</td>";
	 			content+="<td>"+data[j]["name"]+"</td>";
	 			content+="<td>"+data[j]["phone"]+"</td>";
 				content+="<td>"+fnChangeName(data[j]["trainingFlag"],yesornot_jsarry)+"</td>";
 				content+="<td>"+data[j]["certificateNum"]+"</td>";
	 		 	var getTime=timestampToTime(data[j]["getTime"]);
	 		 	getTime=getTime.substring(0,10);
 				content+="<td>"+getTime+"</td>";
	 			content+="<td>"+fnChangeName(data[j]["evacuationGuide"],yesornot_jsarry)+"</td>";
 
				content+="<td class=\"tc\">";
				content+="<a class=\"hmui-btn-primary\" href=\"personnel_detail.php?id="+id+"\"></a>";
				content+="</td>";
				content+="</tr>";
	   
		
	 	   }
		
	    if(data.length==0){
	    	content+="<tr>";                                                                                           
			content+="<td colspan=9 align='center'>";  
			content+="没有查询到数据"; 
			content+="</td>"; 
			content+="</tr>";
	    }
	 

    }else{
    	var message=resultobj.message; 
    	content+="<tr>";                                                                                           
		content+="<td colspan=9 align='center'>";  
		content+="错误码："+code+message; 
		content+="</td>"; 
		content+="</tr>";
    }	                                                          
	return content;  
	
}

function timestampToTime(timestamp) {
    var date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
    Y = date.getFullYear() + '-';
    M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
    D = date.getDate() + '';
    h = date.getHours() + ':';
    m = date.getMinutes() + ':';
    s = date.getSeconds();
    return Y+M+D+h+m+s;
}
