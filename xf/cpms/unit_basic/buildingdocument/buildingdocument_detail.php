 
<?php include '../../../authen/include/page/top.php';?>
<style>
	.door-pic li{width:400px;margin:20px}
	.door-pic li img{float:left;margin-right:10px}
	.door-pic li p{color:#626c81;font-size:14px;line-height:32px;}
</style>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script src="../../../etc/js/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.min.js"></script>
<script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts.js'></script>
<script src='../../../etc/js/echarts/echarts-liquidfill-master/dist/echarts-liquidfill.js'></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
<link rel="stylesheet" href="../../../etc/js/layui/css/layui.css"  media="all">
<div class="hmui-tabu hmui-shadow mt10">
	<!-- 树形图 -->
	<div class="fl w200 p15 treebox" style="background:#FFFFFF;" id="lefttree_con">
		<div class="zTreeDemoBackground left">
			<ul id="treeDemo" class="ztree"></ul>
		</div>
	</div>
	<div  class="fr" style="width:calc(100% - 290px);background:#FFFFFF;padding:15px 30px 15px 20px;" id="main_con">
		<div style="height:500px">
			 	     <div class="fr">
			     
			        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
			
			    </div>
	 	</div>
 	
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
<script type="text/javascript" src="js/buildingdocument_detail.js"></script>
 