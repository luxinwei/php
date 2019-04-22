<?php include '../../../authen/include/page/top.php';?>
<?php 
$file=base64_decode(Fun::request("file"));
$filename=$_GET["fileName"];
 $iconPosition= $_GET["iconPosition"];
?>
 
<div class="ddd">
<!-- <pre id="debug"></pre> -->
<div id="toolbar">
    <input type="file" name="file" onchange="imgPreview(this)"  id="btn_update"/> <br>
   <span>图片名称</span> <input id="fileName" type="text" value="<?php  echo $filename?>"/><br>
   
    <select type="button"  id="btn_chose" class="hmui-select ml10 mt10">
    <option value="">选择添加使用图标</option>
    <option value="img/icon_0003_应急照明.png">应急照明</option>
    <option value="img/icon_0000_消防电话.png">消防电话</option>
    <option value="img/icon_0001_电梯管理.png">电梯</option>
    </select><br>
    
    <input type="button" value="添加" id="btn_add" class="hmui-btn ml10 mt10"/><br>
    <input type="button" value="锁定" id="btn_lock" class="hmui-btn ml10 mt10"/><br>
    <input type="button" value="确定" id="btn_save" class="hmui-btn ml10 mt10"/><br>
    
 	<input type="hidden" name="file_base64" id="file_base64"> 
    <input id="file_img" type="hidden"/><br>
    <input id="file_base64" type="hidden"/><br>
       	  
</div>
<div id="canvas">
	<img src="<?php echo $file ?>" id="file_base64img"/>
</div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/layer/layer.js"></script>
<script type="text/javascript" src="js/context/context.js"></script>
<script type="text/javascript" src="js/drag.js" ></script>
<script type="text/javascript" src="js/Canvas2Image.js"></script>
<link rel="stylesheet" type="text/css" href="js/context/context.standalone.css">
 <style></style>
<style type="text/css">
.ddd{width: 100%;height: 900px;}
html,body{margin:0;padding:0;font:14px/1.5em simsun;overflow:hidden;}
#canvas{ width: 80%;height: 100%;float:right;position:absolute;margin-left:20%;top:40px;z-index:9;border:2px dashed #ccc;padding:10px;background:#fff;}
#myCanvas{width:100%;height:100%;border: 1px solid #c3c3c3;}
.transparent{filter:alpha(opacity=50);-moz-opacity:0.5;-khtml-opacity:0.5;opacity:0.5;}
.box{width:200px;height:100px;cursor:move;position:absolute;top:30px;left:30px;z-index:99;}
.box .bg{width:100%;height:100%;background-color:orange;}
.box .coor{width:10px;height:10px;overflow:hidden;cursor:se-resize;position:absolute;right:0;bottom:0;background-color:red;}
.box .content{position:absolute;left:50%;top:200%;z-index:99;text-align:center;font:bold 14px/1.5em simsun;}
#debug{position:absolute;right:10px;top:10px;z-index:88;border:1px solid #ccc;width:100px;height:100px;background:#fff;}
#toolbar{position:absolute;left:10px;top:10px;z-index:88;float: left; width:20%;margin-top: 30px;}
</style>
<script type="text/javascript">
 
</script> 
<script>
 
$(function(){
	//初始化计数器
	var num = 0;
	//区块锁定标识
	var lock = false;
	//加载layer拓展
	layer.config({
	    extend: 'extend/layer.ext.js'
	});
	//右键菜单参数
	context.init({
	    fadeSpeed: 100,
	    filter: function ($obj){},
	    above: 'auto',
	    preventDoubleContext: true,
	    compress: false
	});
	//调试输出方法
	function debug(msg){
		$("#debug").text(msg);
	}
	function createBox(data){
		var dataId = data.id || '';
		var value = data.text || '';
		var color = data.color || '';
		var icon = data.icon || '';
		var height = data.height || 0;
		var width = data.width || 0;
		var pageX = data.pageX || 50;                                                        
		var pageY = data.pageY || 50;
		var showcon='<div class="box" rel="'+curNum+'" dataId="'+dataId+'"><div class="bg" style="background-color:'+color+';border-radius:10px;" title="'+value+'"></div><pre class="content" style="display:none;">'+value+'</pre></div>';
		if(icon!=""){
			showcon='<div class="box" rel="'+curNum+'" dataId="'+dataId+'" icon="'+icon+'"><div class="bg" style="width:0;height:0;" title="'+value+'"><img style="width:20px;height:20px;" src="'+icon+'"/></div><pre class="content" style="display:none;">'+value+'</pre></div>';
		}
		
		
		 
		//更新计数器并记录当前计数
		var curNum = num++;
		//创建区域块
		var pos = $("#canvas").position();
		var box = $(showcon).css({
			width : width,
			height : height,
			top : pageY > 0 ? pageY : (pos.top > 0 ? 0 : pos.top * -1 + 50),
			left : pageX > 0 ? pageX : (pos.left > 0 ? 0 : pos.left * -1 + 30)
		}).appendTo("#canvas");
		
		//计算文本位置
		box.find('.content').css({
			marginLeft : box.find('.content').width()/2*-1,
			marginTop : box.find('.content').height()/2*-1
		});
		//创建右键菜单
		context.attach('.box[rel='+curNum+']', [
			{header: '操作'},
			{text: '编辑说明', action: function(e){
			    	e.preventDefault();
			    	layer.prompt({
						title: '请输入说明',
						formType: 2,
						value: $('.box[rel='+curNum+'] .content').text()
					}, function(value, index, elem){
						layer.close(index);
						var curCont = $('.box[rel='+curNum+'] .content');
						curCont.text(value).css({
							marginLeft : curCont.width()/2*-1,
							marginTop : curCont.height()/2*-1
						});
					});
			    }
			},
			{text: '更改区域尺寸', action: function(e){
					e.preventDefault();
					layer.prompt({
						title: '请输入区域尺寸（宽,高），最小值：30',
						formType: 0,
						value: $('.box[rel='+curNum+']').width()+","+$('.box[rel='+curNum+']').height()
					}, function(value, index, elem){
						var reg = /^[0-9]+,[0-9]+$/;
						if(!reg.test(value)){
							alert('输入格式不正确，例：100,200');
							return;
						}
						var size = value.split(',');
						var box = $('.box[rel='+curNum+']');
						box.css({
							width : size[0] < 30 ? 30 : size[0],
							height : size[1] < 30 ? 30 : size[1]
						});
						layer.close(index);
					});
				}
			},
			{text: '删除区域', action: function(e){
			    	e.preventDefault();
					$('.box[rel='+curNum+']').remove();
			    }
			},
			{divider: true},
			{header: '更改颜色'},
			{text: '<font color="orange">橙色</font>', action: function(e){
			    	e.preventDefault();
			    	$('.box[rel='+curNum+'] .bg').css('background-color', 'orange');
			    }
			},
			{text: '<font color="red">红色</font>', action: function(e){
			    	e.preventDefault();
			    	$('.box[rel='+curNum+'] .bg').css('background-color', 'red');
			    }
			},
			{text: '<font color="blue">蓝色</font>', action: function(e){
			    	e.preventDefault();
			    	$('.box[rel='+curNum+'] .bg').css('background-color', 'blue');
			    }
			},
			{text: '<font color="green">绿色</font>', action: function(e){
			    	e.preventDefault();
			    	$('.box[rel='+curNum+'] .bg').css('background-color', 'green');
			    }
			},
			{text: '<font color="purple">紫色</font>', action: function(e){
			    	e.preventDefault();
			    	$('.box[rel='+curNum+'] .bg').css('background-color', 'purple');
			    }
			},
			{text: '<font color="yellow">黄色</font>', action: function(e){
			    	e.preventDefault();
			    	$('.box[rel='+curNum+'] .bg').css('background-color', 'yellow');
			    }
			}
		]);
	}
	//添加区域
	$("#btn_add").click(function(){
		
		var icon=$("#btn_chose").val();
		//var icon="https://common.cnblogs.com/images/wechat.png";
		//弹出区域说明输入框
		layer.prompt({
			title: '请输入说明',
			formType: 2 //0:input,1:password,2:textarea
		}, function(value, index, elem){
			layer.close(index);
			createBox({
				text : value,
				width : 20,
				height : 20,
				icon:icon,
				color : "#fd0404"
			});
		});
	});
	//锁定区域
	$('#btn_lock').click(function(){
		if(lock){
			$(this).val("锁定区域");
			lock = false;
			$('.box .coor').show();
		}else{
			$(this).val("解锁区域");
			lock = true;
			$('.box .coor').hide();
		}
	});
	//获取所有区块
	$('#btn_save').click(function(){
 		var data = [];
		$('.box').each(function(){
			var box = {};
			box['id'] = $(this).attr('dataId');
			box['text'] = $(this).find('.content').text();
			box['color'] = $(this).find('.bg').css('background-color');
			box['icon'] = $(this).attr('icon');
			box['height'] = $(this).height();
			box['width'] = $(this).width();
			box['pageX'] = $(this).position().left;
			box['pageY'] = $(this).position().top;
			console.dir(box);
			data.push(box);
		});
		var file_base64img = $("#file_base64").val();
		var file_img = $("#file_img").val();
		var filename = $("#fileName").val();
 
		if(filename==""){
			alert("图片名称不能为空");
			return;
		}
	 
		if(file_img==""){
			alert("图片不能为空");
			return;
		}
 	//	$("btn_addImg").attr("src",file_base64img);
	//	$("#file",window.parent.document).val(file_base64img);
	//	$("#imgData",window.parent.document).val(JSON.stringify(data));
		 window.opener.document.getElementById("btn_addImg").src=file_img;
		 window.opener.document.getElementById("fileName").value=filename;
		 window.opener.document.getElementById("filebase64").value=file_img;
		 window.opener.document.getElementById("file").value= file_base64img;
		 window.opener.document.getElementById("iconPosition").value= JSON.stringify(data);
          window.close();
		
		 
	});
	//创建拖拽方法
	$("#canvas").mousedown(function(e){
		var canvas = $(this);
	    e.preventDefault();
	    var pos = $(this).position();
	    this.posix = {'x': e.pageX - pos.left, 'y': e.pageY - pos.top};
	    $.extend(document, {'move': true, 'move_target': this, 'call_down' : function(e, posix){
	    	canvas.css({
	    		'cursor': 'move',
	    		'top': e.pageY - posix.y,
				'left': e.pageX - posix.x
			});
	    }, 'call_up' : function(){
	    	canvas.css('cursor', 'default');
	    }});
	}).on('mousedown', '.box', function(e) {
		if(lock) return;
	    var pos = $(this).position();
	    this.posix = {'x': e.pageX - pos.left, 'y': e.pageY - pos.top};
	    $.extend(document, {'move': true, 'move_target': this});
	    e.stopPropagation();
	}).on('mousedown', '.box .coor', function(e) {
		var $box = $(this).parent();
	    var posix = {
	            'w': $box.width(), 
	            'h': $box.height(), 
	            'x': e.pageX, 
	            'y': e.pageY
	        };
	    $.extend(document, {'move': true, 'call_down': function(e) {
	    	$box.css({
	            'width': Math.max(30, e.pageX - posix.x + posix.w),
	            'height': Math.max(30, e.pageY - posix.y + posix.h)
	        });
	    }});
	    e.stopPropagation();
	});
	 //测试加载
	 var loadData =<?php echo $iconPosition;?>; 
	$.each(loadData, function(i, row){
		createBox(row);
	});  
});

</script>          
<script type="text/javascript" src="js/firefightingdevice_pic.js"></script>

