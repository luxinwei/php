myFormInit();
function myFormInit(){
 var fields={"title":"required;"};
var validator = $('#myform').validator({                                     
		stopOnError:false                                                    
		,timely:2                                                            
		,fields:fields                                                       
		,valid:function(form){ 
		  var url="fimorgAction.php?action=edit&m="+m;
		  var id=$("#id").val();
		  if(id=="")url="fimorgAction.php?action=add&m="+m;
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
		 }                                                               
		,invalid:function(form,errors){                                  
			                                                               
		}                                                                
		});                                                              
}

function SelectFontAwesome(){
	var iWidth=800;
	var iHeight=600;
	var iTop = (window.screen.availHeight-30-iHeight)/2; //获得窗口的垂直位置;
	var iLeft = (window.screen.availWidth-10-iWidth)/2; //获得窗口的水平位置;
	var tourl=rootPath+"/etc/css/font-awesome/index.html?activeid=smallicon";	
	window.open (tourl,'newwindow','height='+iHeight+',width='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=yes, resizable=no,location=no, status=no') 
}