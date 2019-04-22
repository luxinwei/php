 
//返回列表==========================================
$("#btn_history").bind("click", function(){window.location.href="inspectiontask_detail.php?id="+id;});
 
$("#btnRight").click(function () {
	 //数据option选中的数据集合赋值给变量vSelect
	 var vSelect = $("#leftSelector option:selected");
	 //克隆数据添加到 rightSelector 中
	 vSelect.clone().appendTo("#rightSelector");
	 //同时移除 leftSelector 中的 option
	 vSelect.remove();
});
//right move
$("#btnLeft").click(function () {
	 var vSelect = $("#rightSelector option:selected");
	 vSelect.clone().appendTo("#leftSelector");
	 vSelect.remove();
});
function selectAll() {
	 var lst1 = window.document.getElementById("rightSelector");
	 var length = lst1.options.length;
	 var row="";
	 for (var i = 0; i < length; i++) {
		 var v = lst1.options[i].value; //option内的value
		 var t = lst1.options[i].text; //显示的文本
		 row+=v;
		 row+=",";
	 }
	 row = row.substr(0, row.length - 1); 
		$("#patrolPoints",window.parent.document).attr("Value",row)
		//$("#btn_chose",window.parent.document).val(title);


		window.parent.SelectDataHideDiv("btn_chose");
 
	  

}

 

search()
function search(){                       
	var params={uri:"mini_fire_stations/users/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		
		$("#rightSelector_body").after(responseText); 
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 search2(resultobj.data);
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var id=data[j]["id"];                                                                                        
				content+="<option value=\""+data[j]["id"]+"\">"+data[j]["name"]+"</option>";                                              
		 	   }
	

	    }else{
	    	var message=resultobj.message; 
	         alert("错误码"+code+message);
	    }	         
	     
	     $("#rightSelector").empty().append(content);            //
 })

}
 
function search2(data1){
	var params={uri:"users"};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		$("#leftSelector_body").after(responseText); 
	     var resultobj=eval("("+responseText+")");
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var content="";   
	     if(success){
	    	 var data=resultobj.data;
	    	 for(j=0;j<data.length;j++){ 
	    		 var isExist=0;
	    		 for(k=0;k<data1.length;k++){ 
	    			 if(data1[k]["id"]==data[j]["id"]){
	    				 isExist=1;
	    				 break;
	    			 }
	    		 }
	    		 if(isExist==1)continue;
	       		 
	    		 var id=data[j]["id"];                                                                                        
				content+="<option value=\""+data[j]["id"]+"\">"+data[j]["name"]+"</option>";                                              
		 	   }
		   

	    }else{
	    	var message=resultobj.message; 
	    	  alert("错误码"+code+message);
	    }	         
	     
	     $("#leftSelector").empty().append(content);                 //
 })	 

}
 




