	
 		
//============================================
 		search();
		function search(){                          //查询
			var params={uri:"roles/menus/baseManagement",id:id};
			var url=rootPath+"/com/base/InterfaceGetroleAction.php";
			$.post(url,params,function(responseText){	
				 // $("#pageNav").parent().after(responseText); 
			     var resultobj=eval("("+responseText+")");
			     var success=resultobj.success; 
			     var code=resultobj.code; 
			     var data=resultobj.data;
 			     var setting = {
			     			check: {
			     				enable: true,
			     				chkStyle: "checkbox",
			     				chkboxType: { "Y": "s", "N": "s" }
			     			},
			     			data: {
			     				simpleData: {
			     					enable: true
			     				}
			     			},
			     			callback: {
			     				onCheck: zTreeOnCheck
			     			}
			     		};

			     		var zNodes =data;
			     		$(document).ready(function(){
			     			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
			      
			     		});
			     		
			     		function zTreeOnCheck(event, treeId, treeNode) {
			     		   // alert(treeNode.id + ", " + treeNode.name + "," + treeNode.checked+","+treeNode.nodeId);
			     		  //  alert(treeNode.checked);
			     	 
			     		};
			     		
		    })
		}
		function  aa(){
 				var treeObj=$.fn.zTree.getZTreeObj("treeDemo"),  
	            nodes=treeObj.getCheckedNodes(true),  
	            v="";  
	            for(var i=0;i<nodes.length;i++){  
	            	if(nodes[i].nodeId==null||nodes[i].nodeId==""){
	 
	            	}else{
	            		v+=nodes[i].nodeId + ",";  
	            	}
	            }
	          
 	        	$("#confMenuIds",window.parent.document).attr("confMenuIdsValue",v)
	        //	$("#confMenuIds",window.parent.document).val(v);
	        	window.parent.SelectDataHideDiv("confMenuIds");
	        	return false;
		}
		 