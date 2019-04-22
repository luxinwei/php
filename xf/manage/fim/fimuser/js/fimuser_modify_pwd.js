$("#backhistory").bind("click", function(){window.location.href="fimuser_list.php?m="+m;});
$("#okfn").bind("click", function(){
	var url="FimUserAction.php?action=modifypwd&m="+m;
    $.ajax({url:url,                                       
				type:'post',                                                 
				async: false,                                                
				dataType:"html",                                           
				data:$("#myform").serialize()+"&s="+Math.random(),       
				success:function(responseText){                              
					var data=eval("("+responseText+")");                 
		 			var success=data.success;                                
			 		if(success==0){                                          
				    	alert("操作失败!");                                  
	          		}else if(success==1){                                     
                		alert("操作成功!");                              
	                	window.location.reload();                             
	          		}else if(success==2){                                    
		      		}else if(success==3){                                     
		      		};                                                       
	       		},                                                           
	    		error:function(){                                            
        		 alert("错误");                                        
      		}                                                        
      		});        
	
	
	
});
