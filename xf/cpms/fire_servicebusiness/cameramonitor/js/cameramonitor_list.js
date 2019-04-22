 
//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params=$("#myform").serialize()	;
	if(params!="")params+="&";
	params+="uri=camera_monitors";
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
	 // //$("#pageNav").parent().after(JSON.stringify(resultobj));
	 // var resultobj=eval("("+responseText+")");
	 var success=resultobj.success; 
     var code=resultobj.code; 
     var content="";   
     var online="";
     if(success){
    	 var data=resultobj.data;
    	 for(j=0;j<data.length;j++){ 
    		 var id=data[j]["id"];
    		 var hlsAddr=data[j]["hlsAddr"];
    		 var buildingName=data[j]["buildingName"];
    		 var name=data[j]["name"];
    		 var code=data[j]["code"];
    		content+="<tr align=\'center\'>";   
    		content+="<td align='center'>";                                                  
    		content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\"  videoaValue=\""+hlsAddr+"\" build=\""+buildingName+"\" partname=\""+name+"\"  code=\""+code+"\"/>";           
    		content+="</td>"; 
			content+="<td>"+data[j]["name"]+"</td>";  
			content+="<td>"+data[j]["impPartName"]+"</td>"; 
			content+="<td>"+data[j]["deviceName"]+"</td>";                        
			content+="<td>"+data[j]["code"]+"</td>";                        
			content+="<td>"+data[j]["ip"]+"</td>";                        
			content+="<td>"+data[j]["port"]+"</td>";                        
			content+="<td class=\"tc\">";   
			content+="<a class=\"hmui-btn-primary\" href=\"cameramonitor_detail.php?id="+id+"\"></a>";
 			content+="</td>"; 
			content+="</tr>"; 
			
	 	   }
	    if(data.length==0){
	    	content+="<tr>";                                                                                           
			content+="<td colspan=8 align='center'>";  
			content+="没有查询到数据"; 
			content+="</td>"; 
			content+="</tr>";
	    	
	    }

    }else{
    	var message=resultobj.message; 
    	content+="<tr>";                                                                                           
		content+="<td colspan=8 align='center'>";  
		content+="错误码："+code+message; 
		content+="</td>"; 
		content+="</tr>";
    }	                                                                
	return content;  
	
}
//跳转动作---进入添加页面================================================================================================
$("#btn_add").bind("click", function(){ 
	var tourl="cameramonitor_build.php";  
	window.location.href=tourl;
});
 
//跳转动作---进入修改页面  id=========================================
$("#btn_edit").bind("click", function(){
	var row=checkBoxObj('key');
	if(row.row<1||row.row>1){alert("请选择一条记录");return false;}
	var key=row.value;
	window.location.href="cameramonitor_update.php?id="+key;	 	 
});
$("#btn_look").bind("click", function(){ 
	 
	var i=1;
	var aa="";
	var builds="";
	 var partnames="";
	 var code="";
	$("[name='key'][checked]").each(function(){
		i=i+1;
		  url =  $(this).attr("videoaValue");
		  builds =  $(this).attr("build");
		  partnames =  $(this).attr("partname");
	 
		  code =  $(this).attr("code");
	 
		if(i==3){
				 alert("请选择一条数据");
		}
	
	})
	if(i==1){
	 alert("请选择一条数据");
	}
	if(i==2){
	 
		
		// url="http://hls.open.ys7.com/openlive/f01018a141094b7fa138b9d0b856507b.hd.m3u8";
		//alert(url);
		 url=encode64(url);
	 
		  var hre="cameramonitor_checkview.php?build="+builds+"&url="+url+"&partname="+partnames+"&code="+code;	
		  
 		window.location.href=hre;
		
	} 
});
//删除动作---删除单条数据=========================================
$("#btn_del").bind("click", function(){
	  var row=checkBoxObj('key');                                          
	  //  if(row.row<=0){alert("请选择要删除的信息");return false;}
		if(row.row<1){alert("请选择一条记录");return false;}
	    if(!confirm("确认进行此操作吗?"))return false;   
	    var id=row.value;
	    var params={uri:"camera_monitors/"+id};
	    alert(id);
		var url=rootPath+"/com/base/InterfaceDeleteAction.php";
		$.post(url,params,function(responseText){
		     var resultobj=eval("("+responseText+")"); 
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		   
		     if(success){
		           alert("成功！");
		           search();
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }	     
	    })    	    
});
 
 
 
