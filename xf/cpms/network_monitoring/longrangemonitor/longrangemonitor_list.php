
<?php include '../../../authen/include/page/top.php';?>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script src="../../../etc/js/layui/layui.js" charset="utf-8"></script>
<script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts.js'></script>
<script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts-liquidfill.js'></script>
<link rel="stylesheet" href="../../../etc/js/layui/css/layui.css"  media="all">
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
<style>
	.door-control li p{text-align: center;color:#626c81;font-size:14px;line-height:32px}
	.door-control li{border:1px solid #b9c1d2;margin:20px;text-align: center}
	.door-control li img{width:150px}
</style>
<div class="hmui-tabu mt10 hmui-shadow">
<!-- 树形图 -->
	<div class="fl w200 p15 treebox" style="background:#FFFFFF;"  id="lefttree_con">
                <ul id="treeDemo" class="ztree"></ul>
		</div>
	<!-- </td> -->
	<div class="fr" style="width:calc(100% - 290px);background:#FFFFFF;padding:15px 30px 15px 20px;min-height:700px" id="main_con">
		<ul class="door-control" id="tbody_content">
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
<script type="text/javascript" src="js/longrangemonitor_list.js"></script>
 