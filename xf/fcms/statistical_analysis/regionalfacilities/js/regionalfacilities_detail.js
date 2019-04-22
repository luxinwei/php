$("#btn_build").bind("click", function(){window.location.href="practicetask_build.php?m="+m;});


//tree=====================================================================================
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
		,nodes: [ //节点
			{
				name: '建筑'
				,id: 1
				,alias: 'changyong'
				,children: [
				{
					name: '部位'
					,id: 11
					,href: ''
					,alias: 'weidu'
				}, {
					name: '部位'
					,id: 12
				}, {
					name: '部位'
					,id: 13
				}
			]
			}, {
				name: '建筑'
				,id: 2
				,spread: true
				,children: [
					{
						name: '部位'
						,id: 21
						,spread: true
						,children: [
						{
							name: '所属设施'
							,id: 211
							,children: [
							{
								name: '设施1'
								,id: 2111
							}, {
								name: '设施2'
								,id: 2112
							}, {
								name: '设施3'
								,id: 2113
							}
						]
						}, {
							name: '建筑'
							,id: 212
						}, {
							name: '建筑'
							,id: 213
						}
					]
					}, {
						name: '部位'
						,id: 22
						,children: [
							{
								name: '设施1'
								,id: 221
							}, {
								name: '设施2'
								,id: 222
							}, {
								name: '设施3'
								,id: 223
							}
						]
					}
				]
			}
			,{
				name: '建筑'
				,id: 3
				,alias: 'changyong'
				,children: [
					{
						name: '设施'
						,id: 31
						,alias: '冰河世纪'
					}, {
						name: '部位'
						,id: 12
						,children: [
							{
								name: '所属设施'
								,id: 121
							}
							,{
								name: '所属设施'
								,id: 122
							}
						]
					}
				]
			}
		]
	});


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



	

 