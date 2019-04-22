
 $(document).ready(function(){  
	 if(partId!=""){
		  setTimeout(search2(), 300 );
			 loadCountPic();
	}

	

	 $("#btn_search").bind("click", function(){
		 setTimeout(search2(), 300 );
		 loadCountPic();
	 
	  
		 });
	 var xdata= new Array();
	 var tody_data = new Array();
	 var yesterday_data = new Array();
	 var today_day=""
	 var yesterday_day=""
		    		
	function clearData(){ //清空后台数据
			     if(xdata != null && xdata.length != 0) xdata = []; //x轴数据
			     if(tody_data != null && tody_data.length != 0) tody_data = []; 
			     if(yesterday_data != null && yesterday_data.length != 0) yesterday_data = []; 
			     if(today_day != null ) today_day = ""; 
			     if(yesterday_day != null ) yesterday_day = ""; 
			} 
	function search2(){
		clearData();
 		var beginTime="";
		beginTime = $("#beginTime").val();
 		
		var params="uri=pointType/graph/"+partId;
			params+="&params="
		    params+="{"
			params+="\"type\":";
			params+="\"fh\"";
			
			if(beginTime!=""){
			params+=",\"beginTime\":"
			params+="\""+beginTime+"\""
			}
	 
			params+="}"
				
		var url=rootPath+"/com/base/InterfaceGetNetAction.php";
			 $.post(url,params,function(responseText){
				 var resultobj=eval("("+responseText+")");
				 processData(resultobj)
			  });              
	};
	function processData(resultobj){
	 // $("#pageNav2").parent().after(JSON.stringify(resultobj));
		
		 // var resultobj=eval("("+responseText+")");
		var success=resultobj.success; 
	    var code=resultobj.code;
	    var data = resultobj.data;
	    var content="";   
	    var online="";
	    if(success&&data.length>0){
	    	var yesterday= resultobj["data"]["yesterday"];
	    	var today= resultobj["data"]["today"];
	    	today_day=timeFormatday(today[0]["time"]);
 	    	for(var i=0;i<today.length;i++){
	    		tody_data.push(today[i]["value"]);
	    		//xdata.push(timeFormat(today[i]["time"]));
	    	}
	    	
	    	yesterday_day=timeFormatday(yesterday[0]["time"]);
 	    	for(var i=0;i<yesterday.length;i++){
	    		yesterday_data.push(yesterday[i]["value"]);
	     
	    		xdata.push(timeFormat(yesterday[i]["time"]));
        	    	 
        	}
 	    	
 	    	 loadCountPic();

       }       		
}      
  

 
function loadCountPic(){
	 var chart = document.getElementById("someline");  
     var echart = echarts.init(chart);  
     var option = {  
         title: {

             text: '近两日总负荷对比',
             textStyle:{fontSize:'16',color:'#626c81',fontWeight:'600',}
         },
         tooltip : {  
             trigger: 'axis'  
         }, 
         color:['#48cda6','#fd87ab'],
         legend: {  
        	 data:[today_day,yesterday_day]
         },  
         toolbox: {  
             show : false,
             feature : {

                 dataView : {show: true},
        
                 saveAsImage : {show: true}
             }
         },
         dataZoom : {
             show : true,
             realtime : true,

         },
         grid: {  
      
               
//              left: '50%',  
//              right: '50%',  
//              bottom: '50%',  
//              containLabel: true  
         },  
         xAxis : [  
             {  
                 type : 'category',  
                 boundaryGap : false,  
                 data : xdata,
               
               }  
         ],  
         yAxis : [  
             {  
                 type : 'value'  
             }  
         ],  
         series : [  
                   {  
                       name:today_day,  
                       type:'line',  
                       stack: '负荷',  
                       areaStyle: {normal: {}},  
                       data:tody_data
                   },
                   {  
                       name:yesterday_day,  
                       type:'line',  
                       stack: '负荷',  
                       areaStyle: {normal: {}},  
                       data:yesterday_data
                   }
               ]  
     };  
       
     echart.setOption(option,true);   
   
}            
            
            
if(partId!=""){
	search();
}       
 search();
function search(){
	var params="uri=pointType/pointNowValue/"+partId;
		params+="&params="
	    params+="{"
		params+="\"type\":";
		params+="\"fh\"";
		params+="}"
			
	var url=rootPath+"/com/base/InterfaceGetNetAction.php";
		 $.post(url,params,function(responseText){
			 var resultobj=eval("("+responseText+")");
			 processData0(resultobj)
		  }) 
	
}
function processData0(resultobj){
	 ////$("#pageNav").parent().after(JSON.stringify(resultobj));
	
	 // var resultobj=eval("("+responseText+")");
	var success=resultobj.success; 
    var code=resultobj.code; 
    var data=resultobj.data;
    var content="";   
    var online="";
    if(success&&data.length>0){
   	 content+="<tr align=\'center\'>";
   	 for(j=0;j<data.length;j++){ 
   		 var id=data[j]["id"];
 
			content+="<td>"+ClearTrim(data[j]["name"])+"</td>";  
	 	   }
   	 content+="</tr>";
   	 
   	 content+="<tr align=\'center\'>";
	 for(i=0;i<data.length;i++){ 
   		 var id=data[i]["id"];
 
			content+="<td>"+ClearTrim(data[i]["value"])+"</td>";  
	 	   }
	 content+="</tr>";
	   
   } 
    if(data.length==0){
		content+="<tr>";
		content+="<td colspan=9 align='center'>";
		content+="没有查询到数据";
		content+="</td>";
		content+="</tr>";

	}
    $("#tbody_content").empty().append(content);

	
}
if(partId!=""){
	 search1();
}  
search1();
function search1(){
	var params="uri=pointType/loadValue/"+partId;
		params+="&params="
	    params+="{"
		params+="\"type\":";
		params+="\"fh\"";
		params+="}"
			
	var url=rootPath+"/com/base/InterfaceGetNetAction.php";
		 $.post(url,params,function(responseText){
			 var resultobj=eval("("+responseText+")");
			 processData1(resultobj)
		  })       
	       
}
function processData1(resultobj){
	// $("#pageNav1").parent().after(JSON.stringify(resultobj));
	
	 // var resultobj=eval("("+responseText+")");
	var success=resultobj.success; 
    var code=resultobj.code; 
    var data=resultobj.data;
    var content="";   
    var online="";
    if(success&&data.length>0){
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
