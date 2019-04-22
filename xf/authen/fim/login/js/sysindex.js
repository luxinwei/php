//$(function (){ $("#layout1").ligerLayout({space :1,bottomHeight :20,topHeight  :92,leftWidth :212,isRightCollapse :true,allowLeftResize :false,allowTopResize :false,allowBottomResize :false}); });
$(function (){ 
	var g=$("#layout1").ligerLayout({space :0,bottomHeight :20,topHeight  :80,leftWidth :234,isLeftCollapse:false,isRightCollapse :true,allowLeftResize :false,allowTopResize :false,allowBottomResize :false}); 
	

	var left_height=$(".l-layout-center").height();
	$("#defaulf_left").css({"background":"#5b8cff","float":"left","overflow-x":"hidden","overflow-y":"auto","width":"225px","height":""+left_height+"px"});
	$("#collapseleft").css({"height":""+left_height+"px"});
	$("#collapseleft").bind("click", function(){
		g.setLeftCollapse(true);
		$(".l-layout-collapse-left").html("<img src=\"js/img/dh.gif\" style=\"margin-top:350px;cursor:pointer;\"/>");
	
		
	});
	$(".l-layout-collapse-left").bind("click", function(){
		  g.setLeftCollapse(false);	
	});
	navfn(systitle);

});

$("#refresh").bind("click", function(){window.contentFrame.location.reload();});
$("#sysindexexit").bind("click", function(){window.location.href="loginAction.php?action=exit";});
$("#modifypwd").bind("click", function(){window.contentFrame.location.href="modify_pwd.php";});


$("#openIndex").bind("click", function(){
	var url=rootPath+"/web/index.php";
	window.open(url);
});

function navfn(navtitle){

	var content="";
	content+="<span class='fl'>"+navtitle+"</span>";
	content+="<span style=\"float:right;margin:10px 20px;\"><img src='../../../etc/img/icon_help.png' / ></span>";
	$(".l-layout-center .l-layout-header").html(content);
	
	
}
$("#createIndex").bind("click", function(){
	var params={isCreateHtml:1};
	var url=rootPath+"/web/index.php";
	jQuery.post(url,params,function(responseText){
	     var data=eval("("+responseText+")"); 
	     var success=data.success;                                
	 		if(success==0){                                          
		    	alert("生成失败");                                  
	   		}else if(success==1){                                     
	       		alert("生成成功!");                              
	         	                          
	   		}                                                                          
		})                                                                                    
});


$("#create_base_data").bind("click", function(){
	params=null;
	url="../../../install/index.php";
	$.post(url,params,function(responseText){
		 var data=eval("("+responseText+")");//转化为json串
		   var success=data.success;
		   if(success==0)alert("基础数据创建失败！");
		   if(success==1)alert("基础数据创建成功！");
		    
    })
	
});


$(document).ready(function(){
	$(".down-menu").hide();
	$("#down-menu").click(function (){
		$(".down-menu").slideToggle()
	});
	$(".popup").hide()
	$(".down-menu ul li").eq(0).click(function(){
		$(".popup").fadeToggle()
	});
	$(".popup-passwords").hide()
	$(".down-menu ul li").eq(1).click(function(){
		$(".popup-passwords").fadeToggle()
	});
	$(".close").click(function(){
		$(".popup").fadeToggle()
	});
	$(".close2").click(function(){
		$(".popup-passwords").fadeToggle()
	});
});
var exit_time=0;

