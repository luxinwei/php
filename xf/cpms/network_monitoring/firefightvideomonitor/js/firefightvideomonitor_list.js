$("#btn_build").bind("click", function(){window.location.href="practicetask_build.php?m="+m;});
//tree=====================================================================================
search();
function search(){
    var params={uri:"trees/device"};
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
       // $("#tbody_content").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
        var data = resultobj["data"];
        data=data[0].children;
        var setting = {	
        		callback: {
        			onClick: zTreeOnClick
        		}
        };
		var zNodes =data;
		
		function zTreeOnClick(event, treeId, treeNode, clickFlag) {	
			var params={uri:"camera_monitors/"+treeNode.id};
			var url = rootPath + "/com/base/InterfaceGetAction.php";
			$.post(url, params, function (responseText) {
		    //	 $("#detail_content").parent().after(responseText);
					var resultobj = eval("(" + responseText + ")");
					var success = resultobj.success;
					var code = resultobj.code;
					var content = "";
 				 
 			        if(data!=null){
 		        	content+="<li class=\"fl\">";
		        	content+="<div class=\"size\">";
		        	content+="<img alt='' src=\""+"img/iconcamera.png"+"\">";
		        	content+="</div>";
 		        	content+="<p>"+resultobj["data"]["name"]+"</p>";
		        	content+="<p>"+resultobj["data"]["position"]+"</p>";
 		        	content+="</li>";
		        	
			        	 
			        }
		        $("#detail_content").empty().append(content);
		    })
   		}	
		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
		});
 
    })
}

