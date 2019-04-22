 
<?php include '../../../authen/include/page/top.php';?>
<style>
	.door-pic li{padding:20px;margin:20px;border:1px solid #b9c1d2}
	.door-pic li img{float:left;margin-right:10px;width:150px}
	.door-pic li p{color:#626c81;font-size:14px;line-height:32px;}
	.size{width:150;height:150px;overflow: hidden}
</style>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script src="../../../etc/js/layui/layui.js" charset="utf-8"></script>
<script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts.js'></script>
<script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts-liquidfill.js'></script>
<link rel="stylesheet" href="../../../etc/js/layui/css/layui.css"  media="all">
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
<div class="hmui-tabu hmui-shadow mt10">
	<!-- 树形图 -->
	<div class="fl w200 p15 treebox" style="background:#FFFFFF;" id="lefttree_con">
                <ul id="treeDemo" class="ztree"></ul>
		</div>
		<div id="tbody_content"></div>
	<div  class="fr" style="width:calc(100% - 290px);background:#FFFFFF;padding:15px 30px 15px 20px;min-height:770px" id="main_con">
		<ul class="door-pic" id="detail_content">
		<!-- 	<li class="fl">
				<div class="size">
					<img alt="" src="img/iconcamera.png">
				</div>
				<p>名称</p>
				<p>状态</p>
			</li>
			<li class="fl">
				<div class="size">
					<img alt="" src="img/iconcamera.png">
				</div>
				<p>名称</p>
				<p>状态</p>
			</li>
			<li class="fl">
				<div class="size">
					<img alt="" src="img/iconcamera.png">
				</div>
				<p>名称</p>
				<p>状态</p>
			</li>
			<li class="fl">
				<div class="size">
					<img alt="" src="img/iconcamera.png">
				</div>
				<p>名称</p>
				<p>状态</p>
			</li>
			<li class="fl">
				<div class="size">
					<img alt="" src="img/iconcamera.png">
				</div>
				<p>名称</p>
				<p>状态</p>
			</li>
			<li class="fl">
				<div class="size">
					<img alt="" src="img/iconcamera.png">
				</div>
				<p>名称</p>
				<p>状态</p>
			</li> -->
			<div class="cb"></div>
		</ul>
	</div>
	<div class="cb"></div>
</div>
 
<?php include '../../../authen/include/page/bottom.php';?>
 
<script type="text/javascript">
	$(document).ready(function(){
		var left_height=$("#main_con").height();
		$("#lefttree_con").css({"overflow-y":"auto","height":""+left_height+"px"});
	})
var bodyheight=$(document).height();
$(".iframe_content").height(bodyheight);
</script> 
<script type="text/javascript" src="js/firefightvideomonitor_list.js"></script>
 