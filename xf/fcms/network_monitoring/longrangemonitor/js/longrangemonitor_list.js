
//tree=====================================================================================
$("#name").change(function(){
	$("#demo1").empty();
 
	search();
})

search();
function search(){
	var params={uri:"trees/device"};
	var name=$("#name").val();
	if(name!=""){
		var params={uri:"trees/device",name:name};
	}
     var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
      //  ////$("#tbody_content").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
        var setting = {	
        		callback: {
        			onClick: zTreeOnClick
        		}
        };
		var zNodes = resultobj["data"];
		
		function zTreeOnClick(event, treeId, treeNode, clickFlag) {	
			
			var url="longrangemonitor_detail2.php?Id="+treeNode.id;
			 $("#longrangemonitor_main_iframe").attr("src",url);
   		}	
		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
		});

 

    })
}

search1();
function search1(){                          //查询
	var params={uri:"remote_control/switch"};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		 // //////$("#tbody_content").parent().after(responseText); 
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var id=data[j]["id"];
	    		content+="<li class=\"fl w200 p20\">";                                                                                           
				content+="<p>"+data[j]["name"]+"</p>";                                                  
				content+="<p>"+data[j]["deviceName"]+"</p>";                                                  
				content+="<p>"+data[j]["partName"]+"</p>";                                                  
				content+="<p><img src=\"img/opcl.png\"></p>";           
	 
				
	 
				
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
	     $("#tbody_content").empty().append(content);               //
 })
}

 