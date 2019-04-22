$("#btn_build").bind("click", function(){window.location.href="practicetask_build.php?m="+m;});
//tree=====================================================================================
$("#name").change(function(){
	$("#demo1").empty();
 
	search();
})

search();
function search(){
	var params={uri:"trees/device"};
	var name=$("#name").val();
	if(name!=""){
		var params={uri:"trees/device",name:name};
	}
    var url=rootPath+"/com/base/InterfaceGetAction.php";
    $.post(url,params,function(responseText){
        ////$("#tbody_content").parent().after(responseText);
        var resultobj=eval("("+responseText+")");
     


layui.use(['tree', 'layer'], function(){
	var layer = layui.layer
		,$ = layui.jquery;

	layui.tree({
		elem: '#demo1' //指定元素
		,target: '_blank' //是否新选项卡打开（比如节点返回href才有效）
		,click: function(item){ //点击节点回调
			layer.msg('当前节名称：'+ item.name + '<br>全部参数：'+ JSON.stringify(item));
			console.log(item);
		}
		,nodes: resultobj["data"],
	}
	);


	//生成一个模拟树
	var createTree = function(node, start){
		node = node || function(){
				var arr = [];
				for(var i = 1; i < 10; i++){
					arr.push({
						name: i.toString().replace(/(\d)/, '$1$1$1$1$1$1$1$1$1')
					});
				}
				return arr;
			}();
		start = start || 1;
		layui.each(node, function(index, item){
			if(start < 10 && index < 9){
				var child = [
					{
						name: (1 + index + start).toString().replace(/(\d)/, '$1$1$1$1$1$1$1$1$1')
					}
				];
				node[index].children = child;
				createTree(child, index + start + 1);
			}
		});
		return node;
	};

	layui.tree({
		elem: '#demo2' //指定元素
		,nodes: createTree()
	});

});

    })
}
layui.use('element', function(){
	  var $ = layui.jquery
	  ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
});

initx();
function initx(){
	
  
	var url="firefightspraymonitor_detail2.php";
 
	var params={}
	
	$.post(url,params,function(responseText){
		 $("#tbody_content").empty().append(responseText);     
	});

}