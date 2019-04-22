$("#backhistory").bind("click", function(){window.location.href="fimgroup_list.php?m="+m;});

$(document).ready(function(){

	
	var setting = {
			check: {
				enable: true
			},
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
	$.fn.zTree.init($("#treeDemo"), setting, zNodes);
	zTree_Menu = $.fn.zTree.getZTreeObj("treeDemo");
	
});

function checkform(){
	var codeList="";
	var zTree = $.fn.zTree.getZTreeObj("treeDemo");
	var nodes = zTree.getCheckedNodes(true);
	for (var i=0;i<nodes.length;i++) {
		
		var node=nodes[i];
		if(codeList!="")codeList+=",";
		codeList+=node.id;
	}
	var params={groupid:groupid
	        ,newitemslist:codeList
           }
    var url="fimGroupAction.php?action=saveNewsitemsQx&m="+m;
	$.post(url,params,function(responseText){
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
   
   })
}