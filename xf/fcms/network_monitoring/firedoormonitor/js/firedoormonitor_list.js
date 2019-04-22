$("#btn_build").bind("click", function(){window.location.href="practicetask_build.php?m="+m;});


//tree=====================================================================================
$("#name").change(function(){
	$("#demo1").empty();
 
	search();
})

search();
function search(){
	var params={uri:"trees/part"};
	var name=$("#name").val();
	if(name!=""){
		var params={uri:"trees/part",name:name};
	}
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
         //$("#tbody_content").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
  
        var setting = {	
        		callback: {
        			onClick: zTreeOnClick
        		}
        };
		var zNodes = resultobj["data"];
		
		function zTreeOnClick(event, treeId, treeNode, clickFlag) {	
			 
   		}	
		$(document).ready(function(){
			  $.fn.zTree.init($("#treeDemo"), setting, zNodes);
 		});
   
    
    })
    
}

 