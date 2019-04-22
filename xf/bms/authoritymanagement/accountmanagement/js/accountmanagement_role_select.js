 

//查询处理=======================
$("#btn_search").bind("click", function(){
	search();
});
search();
function search(){
	
	var params=$("#myform").serialize()	;
	if(params!="")params+="&";
	params+="uri=roles";
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
	// $("#pageNav").parent().after(JSON.stringify(resultobj));
	
	 // var resultobj=eval("("+responseText+")");
	  var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
 	    		 var id=data[j]["id"]; 
 	    		 var appCode=data[j]["appCode"]; 
	    		 content+="<tr>"; 
	     		content+="<td align='center'>";                                                  
	    		content+="<input type=\"checkbox\" class=\"hmui-checkbox\" name=\"key\" value=\""+id+"\" appcode=\""+appCode+"\"/>";     
	    		content+="</td>";
				content+="<td>"+data[j]["name"]+"</td>";  
				content+="<td>"+data[j]["appCode"]+"</td>";  
				content+="<td>"+data[j]["description"]+"</td>";  
 				content+="</tr>"; 
		 	   }
		    if(data.length==0){
		    	content+="<tr>";                                                                                           
				content+="<td colspan=5 align='center'>";  
				content+="没有查询到数据"; 
				content+="</td>"; 
				content+="</tr>";
		    	
		    }
	    }else{
	    	var message=resultobj.message; 
	    	content+="<tr>";                                                                                           
			content+="<td colspan=5 align='center'>";  
			content+="错误码："+code+message; 
			content+="</td>"; 
			content+="</tr>";
	    }	                                                        
	return content;  
	
}
$("#selectFun").bind("click", function(){

  		  var row=checkBoxObj('key');                                          
		  //  if(row.row<=0){alert("请选择要删除的信息");return false;}
  		var appcode="";
			if(row.row<1){alert("请选择记录");return false;}
	    	//alert(row.value);
			
			$("[name='key']:checked").each(function(){	
			if(appcode!="")appcode+=",";
			appcode+=$(this).attr("appcode");
			})
		 
			var ret = [];
			var re = appcode.split(',');
			appcode.replace(/[^,]+/g, function($0, $1) {   
				(appcode.indexOf($0) == $1) && ret.push($0)
				})
				
  			
	    	var roleIds=row.value;
	        var obj=new Object();
	    	obj.roleIds               = roleIds;
	    	obj.appCodes              = ret;
	    	obj.userId                = id;
 	    	var str = JSON.stringify(obj);
  	    	var params={uri:"users/auth",commitData:str};
	    	var url=rootPath+"/com/base/InterfacePostAction.php";	 		 	
			$.post(url,params,function(responseText){
			     var resultobj=eval("("+responseText+")"); 
			     var success=resultobj.success; 
			     var code=resultobj.code; 
			     if(success){
			           alert("成功！");
 			       	
			    }else{
			    	var message=resultobj.message; 
			    	alert("错误码："+code+message);
			    	 
			    }	     
		    }) 	  
});
 