$("#btn_reset").bind("click", function(){
//	window.location.href="buildingfireelevator_build.php?m="+m;
	window.location.reload(); 
	});
 
 

search();
function search(){
   var params={uri:"system_menus/"+detailid};
  var url=rootPath+"/com/base/InterfaceGetAction.php";
  $.post(url,params,function(responseText){
	  //  //$("#tbody_content").parent().after(responseText);
	      var resultobj=eval("("+responseText+")");
	      var data=resultobj["data"];
	      for(j=0;j<data.length;j++){
	     
 	    	  if(data[j].id==id){
 	    		  $("#name").val(data[j]["name"]);
	    		  $("#appCode").val(data[j]["appCode"]);
	    		  $("#parentId").val(data[j]["parentId"]);
	    		  $("#menuId").val(data[j]["menuId"]);
	    		  $("#sortNum").val(data[j]["sortNum"]);
	    		  $("#level").val(data[j]["level"]);
	    		  $("#menuIds").val(data[j]["menuIds"]);
	    	  }
	      
	      }
	      
 	    /*  var treecontent="";
	      for(var i=0;i<resultobj.data.length;i++){
	    	  if(treecontent!="")treecontent+=",";
	    	  var pId=resultobj.data[i]["parentId"];
	    	  if(resultobj.data[i]["parentId"]==null){
	    		  pId="";
	    	  }
	    	  treecontent+="\n{\"id\":\""+resultobj.data[i]["id"]+"\", \"pId\":\""+pId+"\", \"name\":\""+resultobj.data[i]["name"]+"\"}";
	      }
         var treecontent="["+treecontent+"]";
         //$("#tbody_content").parent().after(treecontent);
	 
         eval("("+treecontent+")");
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

	     		var zNodes = eval("("+treecontent+")");
	     		$(document).ready(function(){
	     			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
	      
	     		});
	     		function zTreeOnCheck(event, treeId, treeNode) {
	     		   // alert(treeNode.id + ", " + treeNode.name + "," + treeNode.checked+","+treeNode.nodeId);
	     		  //  alert(treeNode.checked);
	     	 
	     		};*/
	 })
}
	      

 


//保存信息
$("#btn_save").bind("click", function(){
 	var name              = $("#name").val();
	var appCode              = $("#appCode").val();
	var parentId              = $("#parentId").val();
	var menuId              = $("#menuId").val();
	var sortNum              = $("#sortNum").val();
	var level              = $("#level").val();
	var menuIds             = $("#menuIds").val();
	menuIds=menuIds.substr(0,menuIds.length-1)
//	if(!Mibile_Validation.notEmpty(buildingId,"建筑名称不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(position,"电梯位置不能为空"))return; 
//	if(!Mibile_Validation.notEmpty(holdWeight,"电梯载重不能为空"))return; 
	
	
     var obj=new Object();
	obj.id                    =id;
	obj.name                  = name;
	obj.appCode               = appCode;
	obj.parentId                 = parentId;
	obj.menuId                 = menuId;
	obj.sortNum                 = sortNum;
	obj.level                 = level;
	obj.menuIds                 = menuIds;
	var str = JSON.stringify(obj);
 	var params={uri:"system_menus",commitData:str};
	var url=rootPath+"/com/base/InterfacePutAction.php";
	$.post(url,params,function(responseText){	
		//////$("#detail").parent().after(responseText);
		 var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
		    	 alert("成功");
		    	 parent.location.href="menumanagement_detail.php?id="+detailid; 
		    }else{
		    	var message=resultobj.message; 
		    	alert("错误码："+code+message);
		    }   
     })
})

function selectAll() {
	 var lst1 = window.document.getElementByName("menuIds");
	 var length = lst1.options.length;
	 var row="";
	 for (var i = 0; i < length; i++) {
		 var v = lst1.options[i].text; //option内的value
		 var t = lst1.options[i].text; //显示的文本
		 row+=v;
		 row+=",";
	 }
	 row = row.substr(0, row.length - 1); 
	$("#menuIds").val(row);
	//$("#btn_chose",window.parent.document).val(title);

}

//===================================================菜单功能=======================================================
$("#btn_search").bind("click", function(){
	search2();
});
search2()
function search2( ){
	var name=$("#key").val();
	var params={uri:"menus"};
    if(name!=""){
    	
    	params={uri:"menus",name:name};
    }
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
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
         //$("#tbody_content").parent().after(treecontent);
	 
         eval("("+treecontent+")");
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

	     		var zNodes = eval("("+treecontent+")");
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
	var content=""
	    	 
     for(var i=0;i<nodes.length;i++){  
     	if(nodes[i].id==null||nodes[i].id==""){

     	}else{
     		v+=nodes[i].id + ","; 
     		content+="<option value="+nodes[i].id+">"+nodes[i].name+"</option>";
     	}
     }
    $("#menuId").append(content);
    //	$("#menuIds",window.parent.document).attr("confMenuIdsValue",v)
  	$("#menuIds").val(v);
   	
  	var  content="";
 }


//===================================================菜单=======================================================
/*
search2()
function search2( ){
	var params={uri:"system_menus/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
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
         //$("#tbody_content").parent().after(treecontent);
	 
         eval("("+treecontent+")");
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

	     		var zNodes = eval("("+treecontent+")");
	     		$(document).ready(function(){
	     			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
	      
	     		});
	     		function zTreeOnCheck(event, treeId, treeNode) {
	     		   // alert(treeNode.id + ", " + treeNode.name + "," + treeNode.checked+","+treeNode.nodeId);
	     		  //  alert(treeNode.checked);
	     	 
	     		};
 })
}
*/