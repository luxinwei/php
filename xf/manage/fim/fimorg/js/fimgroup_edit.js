$("#backhistory").bind("click", function(){window.location.href="fimgroup_list.php?orgid="+orgid+"&m="+m;});
myFormInit();
function myFormInit(){
 var fields={"title":"required;"};
var validator = $('#myform').validator({                                     
		stopOnError:false                                                    
		,timely:2                                                            
		,fields:fields                                                       
		,valid:function(form){
			 var url="fimGroupAction.php?action=edit&m="+m;
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
		 }                                                               
		,invalid:function(form,errors){                                  
			                                                               
		}                                                                
		});                                                              
}