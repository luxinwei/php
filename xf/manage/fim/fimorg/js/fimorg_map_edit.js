$("#btn_his").bind("click", function(){window.location.href="fimorg_gridlist.php?&m="+m;  });
function save(){
	var orgid=document.getElementById("orgid").value;
	var mapx=document.getElementById("mapx").value;
	var mapy=document.getElementById("mapy").value;
	var address=document.getElementById("address").value;
	if(mapx==""||mapy==""){
		alert("请点击地图创建标注");
		return false;
	}
	var url="fimorgAction.php?action=savemapinfo&m="+m;
	var params={orgid:orgid,mapx:mapx,mapy:mapy,address:address}
	$.post(url,params,function(responseText){
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
							
	});	
}

function clearfn(){
	var orgid=document.getElementById("orgid").value;
    var mapx="";
	var mapy="";
	var address=document.getElementById("address").value;
	var url="fimorgAction.php?action=savemapinfo&m="+m;
	var params={orgid:orgid,mapx:mapx,mapy:mapy,address:address}

	$.post(url,params,function(responseText){
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
							
	});	

}