$("#backhistory").bind("click", function(){window.location.href="fimcodelibrary_list.php?codeno="+codeno+"&m="+m;});
myFormInit();
function myFormInit(){
 var fields={"itemno":"required;"};
var validator = $('#myform').validator({                                     
		stopOnError:false                                                    
		,timely:2                                                            
		,fields:fields                                                       
		,valid:function(form){ 
			 var url="fimCodelibraryAction.php?action=edit&m="+m;
			  var key=$("#key").val();
			  if(key=="")url="fimCodelibraryAction.php?action=add&m="+m;
      $.ajax({url:url,                                       
				type:'post',                                                 
				async: false,                                                
				dataType:"html",                                           
				data:$("#myform").serialize()+"&s="+Math.random(),       
				success:function(responseText){                              
					var data=eval("("+responseText+")");                 
		 			var success=data.success;                                
			 		if(success==0){                                          
				    	alert(data.msg);                                  
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