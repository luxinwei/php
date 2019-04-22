$("#saveok").bind("click", function(){
	var parentid=$("#parentid").val();
	var newparentid=$("#newparentid").val();
	if(newparentid==parentid){
		alert("栏目没有调整!");
		return false;
	}
	 var params={keyvalue:keyvalue,newparentid:newparentid};
	 var url="fimorgAction.php?action=changeitem&m="+m;
     $.ajax({url:url,                                       
				type:'post',                                                 
				async: false,                                                
				dataType:"html",                                           
				data:params,       
				success:function(responseText){
					var data=eval("("+responseText+")");                 
		 			var success=data.success;                                
			 		if(success==0){                                          
				    	alert("操作失败!");                                  
	          		}else if(success==1){ 
                 		setTimeout(function(){
	                 				alert('操作成功！');
	                 				if(parent.treeStore!=null)parent.treeStore.reload();  
	                 				window.location.reload();
                 		           },1000); 
	          		}else if(success==2){                                    
		      		}else if(success==3){                                     
		      		};                                                       
	       		},                                                           
	    		error:function(){                                            
         		 alert("错误");                                        
       		}                                                        
       		});       
	
	
	
});
