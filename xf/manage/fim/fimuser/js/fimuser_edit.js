$("#backhistory").bind("click", function(){window.location.href="fimuser_list.php?m="+m;});
singlePicUpload();
myFormInit();
linkAreaInit();
function linkAreaInit(){
 	var companyarea=$("#linkarea").val();
 	var province="";
 	var city="";
 	var area="";
 	var placeArray=companyarea.split("-");
	if(placeArray.length>=0)province=placeArray[0];
	if(placeArray.length>=2)city=placeArray[1];
	if(placeArray.length>=3)area=placeArray[2];
 	new PCAS("province","city","area",province,city,area);
}
function asynArea(){
	var companyarea="";
    var province=$("#province").val();
	var city=$("#city").val();
	var area=$("#area").val();
	if(province==""&&city==""&&area==""){
	}else{
	    companyarea=$("#province").val()+"-"+$("#city").val()+"-"+$("#area").val();
	}
	$("#linkarea").attr("value",companyarea);
}


function myFormInit(){
 var fields={"useraccount":"required;","nickname":"required;"};
 var fields={
		 useraccount:{rule:"账号:required;" }
		 ,nickname:  {rule:"昵称:required;"}
		 ,mobile:    {rule:"手机:mobile;"}
		 ,email:     {rule:"邮箱:email;"}
		 ,linkpost:     {rule:"邮编:postcode;"}
		// ,orgid:  {rule:"机构:required;"}
		 //,fimgroupid:  {rule:"岗位:required;"}
		} 
var validator = $('#myform').validator({                                     
		stopOnError:false                                                    
		,timely:2                                                            
		,fields:fields                                                       
		,valid:function(form){ 
			 var me = this;        // 提交表单之前，hold住表单，防止重复提交
			  me.holdSubmit();  
			  asynArea();     
			var url="FimUserAction.php?action=edit&m="+m;
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



$("#orgid").change(function(){
	var orgid=$("option:selected",this).val();
	var params={orgid:orgid};
	var url="FimUserAction.php?action=groups&m="+m;
	$.post(url,params,function(responseText){
		$("#fimgroupid").empty().append(responseText);
	})
});