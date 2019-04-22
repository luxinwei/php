$("#backhistory").bind("click", function(){window.location.href="fimgroup_list.php?m="+m;});
function checkform(){
var menuList="";
var obj=document.getElementsByName("menuListInfo");
for(i=0;i<obj.length;i++){	
			if(obj[i].checked==true){
			    if(menuList!="")menuList+=",";
				menuList+=obj[i].value;					
			}				
		}	
var params={groupid:groupid
	        ,menuList:menuList
           }
    var url="fimGroupAction.php?action=saveqx&m="+m;
    jQuery.ajax({url:url,
			type:'post',
			async: false,      //ajax同步
			dataType:"html",
			data:params,//URL参数
			success:function(responseText){
			   var data=eval("("+responseText+")");//转化为json串
			   var success=data.success;
				   if(success==0){
				    alert("权限配置失败!");
				   }else if(success==1){  
				    alert("权限配置成功!");
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
//------------------------------------------------------------------------------------------
function openContent(id){
var obj=document.getElementById("content_"+id);
	if (obj.style.display == "none"){
		   obj.style.display="block";
	}else{
		  obj.style.display="none";
	}
}			
//------------------------------------------------------------------------------------------
function selectChildCheckBox(s){
			var a=s.value;
			$("input[name='menuListInfo']").each(function (){
			if($(this).attr("parentValue")==a){
			            this.checked=s.checked;
						selectChildCheckBox(this);
			}
			});
			/*
			var b=document.getElementsByName("menuListInfo");
			for(var i=0;i<b.length;i++){		
					if(b[i].parentValue==a){	
						b[i].checked=s.checked;
						selectChildCheckBox(b[i]);
					}
			}
			*/
		}
		
		function selectParentCheckBox(s){
			//var a=s.parentValue;
			var a=$(s).attr("parentValue");
			var b=$("input[name='menuListInfo']");
			for(var i=0;i<b.length;i++){		
					if(b[i].value==a){	
						if(s.checked){
							if(!b[i].checked){
								b[i].checked=true;
								selectParentCheckBox(b[i]);
							}
						}
						
						if(!s.checked){
							b[i].checked=false;
							$("input[name='menuListInfo']").each(function (){
							if($(this).attr("parentValue")==b[i].value){
							            if(this.checked)b[i].checked=true;
							}
							});
							/*
							var c=document.getElementsByName("menuListInfo");
							for(var j=0;j<c.length;j++){
								if(c[j].parentValue==b[i].value){	
									if(c[j].checked)b[i].checked=true;
								}
							}
							*/
							if(b[i].checked==false)
							selectParentCheckBox(b[i]);
						}
					}
			}
		}

	    	    