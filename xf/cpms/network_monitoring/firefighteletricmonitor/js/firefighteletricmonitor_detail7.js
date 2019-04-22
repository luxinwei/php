 
 $(document).ready(function(){  
	 
	 if(partId!=""){
		 search();
	}  
            
 search();
function search(){
	var params="uri=pointType/pointNowValue/"+partId;
		params+="&params="
	    params+="{"
		params+="\"type\":";
		params+="\"zt\"";
		params+="}"
			
	var url=rootPath+"/com/base/InterfaceGetNetAction.php";
		 $.post(url,params,function(responseText){
			 var resultobj=eval("("+responseText+")");
			 processData0(resultobj)
		  }) 
	
}
function processData0(resultobj){
//	//$("#pageNav").parent().after(JSON.stringify(resultobj));
	
	 // var resultobj=eval("("+responseText+")");
	var success=resultobj.success; 
    var code=resultobj.code; 
    var data=resultobj.data;
    var content="";   
    var online="";
    if(success){
    
	   
   } 
    if(data==""||data=="null"){
		content+="<tr>";
		content+="<td colspan=9 align='center'>";
		content+="没有查询到数据";
		content+="</td>";
		content+="</tr>";

	}
    $("#tbody_content").empty().append(content);

	
}
search1();
function search1(){
	var params="uri=pointType/loadValue/"+partId;
		params+="&params="
	    params+="{"
		params+="\"type\":";
		params+="\"zt\"";
		params+="}"
			
	var url=rootPath+"/com/base/InterfaceGetNetAction.php";
		 $.post(url,params,function(responseText){
			 var resultobj=eval("("+responseText+")");
			 processData1(resultobj)
		  })       
	       
}
function processData1(resultobj){
//$("#pageNav1").parent().after(JSON.stringify(resultobj));
	
	 // var resultobj=eval("("+responseText+")");
	var success=resultobj.success; 
    var code=resultobj.code; 
    var data=resultobj.data;
    var content="";   
    var online="";
    if(success){
 	 $("#differenceRate").html(data["differenceRate"]);
 	 $("#differenceValue").html(data["differenceValue"]);
 	 $("#maxTime").html(data["maxTime"]);
 	 $("#maxValue").html(data["maxValue"]);
 	 $("#meanValue").html(data["meanValue"]);
 	 $("#minTime").html(data["minTime"]);
 	 $("#minValue").html(data["minValue"]);
 	 $("#name").html(data["name"]);
 	 $("#rate").html(data["rate"]);
 
	   
   }else{

    	$("#name").html("暂无数据");

	}
    

	
}
//时间戳  
  
function timeFormat(t) {     
	var date = new Date(parseInt(t));   
	
	h = date.getHours() + ':';
	m = date.getMinutes() + ':';
	s = date.getSeconds(); 
	return h+m+s;
	
	}   
function timeFormatday(t) {     
	var date = new Date(parseInt(t));   
	Y = date.getFullYear() + '-';
	M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	D = date.getDate();

	return Y+M+D;
	
	}   
 });  
