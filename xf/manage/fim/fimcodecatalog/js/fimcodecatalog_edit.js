myFormInit();
function myFormInit(){

 var fields={"codeno":"required;"
	         ,"codename":"required;"
 };
var validator = $('#myform').validator({                                     
		stopOnError:false                                                    
		,timely:2                                                            
		,fields:fields                                                       
		,valid:function(form){  
			  var url="fimCodecatalogAction.php?action=edit&m="+m;
			  var key=$("#key").val();
			  if(key=="")url="fimCodecatalogAction.php?action=add&m="+m;
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
	          		}                                                      
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