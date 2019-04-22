$("#btn_build").bind("click", function(){window.location.href="practicetask_build.php?m="+m;});
//tree=====================================================================================
search();
function search(){
    var params={uri:"trees/device"};
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
       // //////$("#tbody_content").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
        var data = resultobj["data"];
        data=data[0].children;
        var setting = {	
        		callback: {
        			onClick: zTreeOnClick
        		}
        };
		var zNodes = data;
		
		function zTreeOnClick(event, treeId, treeNode, clickFlag) {	
			
			var url="firefightspraymonitor_detail2.php?Id="+treeNode.id;
			 $("#firefightspraymonitor_main_iframe").attr("src",url);
   		}	
		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
		});
 
    })
}

 

 