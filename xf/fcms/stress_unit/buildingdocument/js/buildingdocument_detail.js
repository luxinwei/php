$("#btn_build").bind("click", function(){window.location.href="practicetask_build.php?m="+m;});
var setting = {
		data: {
			simpleData: {
				enable: true
			}
		}
	};

	var zNodes =[
		{ id:1, pId:0, name:"建筑", open:true},
		{ id:11, pId:1, name:"部件"},
		{ id:111, pId:11, name:"设施"},
		{ id:1111, pId:111, name:"设施"},
	{ id:11111, pId:1111, name:"设施"},
		 
	];

$(document).ready(function(){
	$.fn.zTree.init($("#treeDemo"), setting, zNodes);

	
});
layui.use('element', function(){
	  var $ = layui.jquery
	  ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
});

$("#btn_history").bind("click", function(){window.location.href="buildingdocument_list.php";});
