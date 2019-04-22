//tree=====================================================================================
search();
function search(){
 var params={uri:"menus"};
var url=rootPath+"/com/base/InterfaceGetAction.php";
$.post(url,params,function(responseText){
	//   $("#tbody_content").parent().after(responseText);
	     var result=responseText;
	      var resultobj=eval("("+result+")");
	      var treecontent="";
	      for(var i=0;i<resultobj.data.length;i++){
	    	  if(treecontent!="")treecontent+=",";
	    	  var pId=resultobj.data[i]["parentId"];
	    	  if(resultobj.data[i]["parentId"]==null){
	    		  pId="";
	    	  }
	    	  treecontent+="\n{\"id\":\""+resultobj.data[i]["id"]+"\", \"pId\":\""+pId+"\", \"name\":\""+resultobj.data[i]["name"]+"\"}";
	      }
        var treecontent="["+treecontent+"]";
	 
//============================
//$("#tbody_content").html(treecontent);    //打印查询信息
//============================
	     var setting = {
				view: {
					addHoverDom: addHoverDom,
					removeHoverDom: removeHoverDom,
					selectedMulti: false
				},
				edit: {
					enable: true,
					editNameSelectAll: true,
					showRemoveBtn: showRemoveBtn,
					showRenameBtn: showRenameBtn
				},
				data: {
					simpleData: {
						enable: true
					}
				},
				callback: {
					beforeDrag: beforeDrag,
					beforeEditName: beforeEditName,
					beforeRemove: beforeRemove,
					beforeRename: beforeRename,
					onRemove: onRemove,
					onRename: onRename
				}
			};

		var zNodes =eval("("+treecontent+")");
	
		function beforeDrag(treeId, treeNodes) {
			return false;
		}
		
		var log, className = "dark";
		function beforeDrag(treeId, treeNodes) {
			return false;
		}
		
		//修改===================================================================================
		function beforeEditName(treeId, treeNode) {
			className = (className === "dark" ? "":"dark");
			showLog("[ "+getTime()+" beforeEditName ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
			var zTree = $.fn.zTree.getZTreeObj("treeDemo");
			zTree.selectNode(treeNode);
			setTimeout(function() {
				if (true) {
					zTree.editName(treeNode);
					var ids=treeNode.id;
					var pId=treeNode.pId;
 					var name=treeNode.name;
 	 				var url="operationmanagement_update.php?id="+ids+"&pId="+pId;
	 				 $("#operationmanagement_iframe").attr("src",url);
				}
			}, 0);
			return false;
		}
	
		//添加===================================================================================
		var newCount = 1;
		function addHoverDom(treeId, treeNode) {
		 
			var sObj = $("#" + treeNode.tId + "_span");
			if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
			var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
				+ "' title='add node' onfocus='this.blur();'></span>";
			sObj.after(addStr);
			var btn = $("#addBtn_"+treeNode.tId);
			if (btn) btn.bind("click", function(){
				var ids=treeNode.id;
				var pId=treeNode.pId;
 				 var url="operationmanagement_add.php?id="+ids+"&pId="+pId;
				$("#operationmanagement_iframe").attr("src",url);
				return false;
			});
		};
		//删除===================================================================================
		function beforeRemove(treeId, treeNode) {
			className = (className === "dark" ? "":"dark");
			showLog("[ "+getTime()+" beforeRemove ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
			var zTree = $.fn.zTree.getZTreeObj("treeDemo");
			zTree.selectNode(treeNode);
				    if(!confirm("确认进行此操作吗?"))return false;   
				    var id=treeNode.id
 				    var params={uri:"menus/"+id};
					var url=rootPath+"/com/base/InterfaceDeleteAction.php";
			 $.post(url,params,function(responseText){
					     var resultobj=eval("("+responseText+")"); 
					     var success=resultobj.success; 
					     var code=resultobj.code; 
					     if(success){
					           alert("成功！");
					           search();
					    }else{
					    	var message=resultobj.message; 
					    	alert("错误码："+code+message);
					    }	     
				    })    	    
			 
		}
		function removeHoverDom(treeId, treeNode) {
			$("#addBtn_"+treeNode.tId).unbind().remove();
		};
		function selectAll() {
			var zTree = $.fn.zTree.getZTreeObj("treeDemo");
			zTree.setting.edit.editNameSelectAll =  $("#selectAll").attr("checked");
		}
		
		function onRemove(e, treeId, treeNode) {
			showLog("[ "+getTime()+" onRemove ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
		}
		function beforeRename(treeId, treeNode, newName, isCancel) {
			className = (className === "dark" ? "":"dark");
			showLog((isCancel ? "<span style='color:red'>":"") + "[ "+getTime()+" beforeRename ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name + (isCancel ? "</span>":""));
			if (newName.length == 0) {
				setTimeout(function() {
					var zTree = $.fn.zTree.getZTreeObj("treeDemo");
					zTree.cancelEditName();
 				}, 0);
				return false;
			}
			return true;
		}
		function onRename(e, treeId, treeNode, isCancel) {
			showLog((isCancel ? "<span style='color:red'>":"") + "[ "+getTime()+" onRename ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name + (isCancel ? "</span>":""));
		}
		function showRemoveBtn(treeId, treeNode) {
			return true;
		}
		function showRenameBtn(treeId, treeNode) {
			return true;
		}
		function showLog(str) {
			if (!log) log = $("#log");
			log.append("<li class='"+className+"'>"+str+"</li>");
			if(log.children("li").length > 8) {
				log.get(0).removeChild(log.children("li")[0]);
			}
		}
		function getTime() {
			var now= new Date(),
			h=now.getHours(),
			m=now.getMinutes(),
			s=now.getSeconds(),
			ms=now.getMilliseconds();
			return (h+":"+m+":"+s+ " " +ms);
		}
		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
			$("#selectAll").bind("click", selectAll);
		});


		//var zNodes =resultobj.data;

});


}

