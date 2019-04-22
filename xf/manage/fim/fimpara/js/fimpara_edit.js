$("#backhistory").bind("click", function(){window.location.href="fimpara_list.php?m="+m;});
myFormInit();
function myFormInit(){
 var fields={"paracode":"required;"};
var validator = $('#myform').validator({                                     
		stopOnError:false                                                    
		,timely:2                                                            
		,fields:fields                                                       
		,valid:function(form){                                               
      $.ajax({url:"fimParaAction.php?action=edit&m"+m,                                       
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