//$(function (){ $("#layout1").ligerLayout({space :1,bottomHeight :20,topHeight  :92,leftWidth :212,isRightCollapse :true,allowLeftResize :false,allowTopResize :false,allowBottomResize :false}); });
$(function (){ $("#layout1").ligerLayout({space :0,bottomHeight :20,topHeight  :67,leftWidth :195,isRightCollapse :true,allowLeftResize :false,allowTopResize :false,allowBottomResize :false}); });
$("#refresh").bind("click", function(){window.contentFrame.location.reload();});
$("#sysindexexit").bind("click", function(){window.location.href="loginAction.php?action=exit";});
$("#modifypwd").bind("click", function(){window.contentFrame.location.href="modify_pwd.php";});


$("#openIndex").bind("click", function(){
	var url=rootPath+"/web/index.php";
	window.open(url);
});

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
var curMenu = null;
var zTree_Menu = null;
var setting = {
	view: {
		showLine: true,
		showIcon :true,
		selectedMulti: false,
		dblClickExpand: false
	},
	data: {
		simpleData: {
			enable: true
		}
	},
	callback: {
		onNodeCreated: this.onNodeCreated,
		beforeClick: this.beforeClick
		//onClick: this.onClick
	}
};

function beforeClick(treeId, node) {
	if (node.isParent) {
		if (node.level === 0) {
			var pNode = curMenu;
			while (pNode && pNode.level !==0) {
				pNode = pNode.getParentNode();
			}
			if (pNode !== node) {
				var a = $("#" + pNode.tId + "_a");
				a.removeClass("cur");
				zTree_Menu.expandNode(pNode, false);
			}
			a = $("#" + node.tId + "_a");
			a.addClass("cur");

			var isOpen = false;
			for (var i=0,l=node.children.length; i<l; i++) {
				if(node.children[i].open) {
					isOpen = true;
					break;
				}
			}
			if (isOpen) {
				zTree_Menu.expandNode(node, true);
				curMenu = node;
			} else {
				zTree_Menu.expandNode(node.children[0].isParent?node.children[0]:node, true);
				curMenu = node.children[0];
			}
		} else {
			zTree_Menu.expandNode(node);
		}
	}
	return !node.isParent;
}
function onClick(e, treeId, node) {
	alert("Do what you want to do!");
}

$(document).ready(function(){
	//$.fn.zTree.init($("#treeDemo"), setting, zNodes);
	//zTree_Menu = $.fn.zTree.getZTreeObj("treeDemo");
	initMenu();
});
function initMenu(){
	  var bigmenu_content="";
	  for(var i=0;i<zNodes.length;i++){
			//bigmenu_content+="<li  onclick=\"leftMenu("+i+")\" class=\"show_"+(i+1)+"\"><a href=\"#\">"+zNodes[i].name+"</a></li>";
		  
		  bigmenu_content+="<li  onclick=\"leftMenu("+i+")\" class=\"show_"+(i+1)+"\"><i class=\""+zNodes[i].smallicon+" fa-2x\"></i><a href=\"#\">"+zNodes[i].name+"</a></li>";
	  }
	  $("#sysmenu").empty().append(bigmenu_content);
	  $(".l-layout-left").css("background-color","#2a9dd2");
      $("#left").css("background-color","#2a9dd2");
      leftMenu(0);
	 
}

function leftMenu(treeIndex){
	var treeNode=zNodes[treeIndex].children;
	$("#smallmenu_title").empty().append("&nbsp;&nbsp;"+zNodes[treeIndex].name);
	$.fn.zTree.init($("#treeDemo"), setting, treeNode);
	zTree_Menu = $.fn.zTree.getZTreeObj("treeDemo");
}

//=================================================
window.setInterval ("onlinetime()",1000);
function onlinetime(){
	exit_time++;
	var hours=parseInt(exit_time/3600);
	var min=parseInt(exit_time/60);
	var sec=parseInt(exit_time%60);
	if(hours>=1)min=parseInt(parseInt(exit_time%3600)/60);
	var str="你已经登录："+min+"分"+sec+"秒";
	if(hours>=1)str="你已经登录："+hours+"小时"+min+"分"+sec+"秒";
	document.getElementById("onlinetime1").innerHTML =str;
}

//======================================================================================
//isNoReadMsg();
//window.setInterval ("isNoReadMsg()",1000);
function isNoReadMsg(){
	var url=rootPath+"/com/manage/csm/csmOrderAction.php?action=indextixing";
	jQuery.ajax({url:url,
				type:'post',
				async: true,      //ajax同步
				dataType:"html",
				data:{},//URL参数
				success:function(responseText){
					document.getElementById("indextixing").innerHTML =responseText;
				},
				error:function(){}
	});
} 