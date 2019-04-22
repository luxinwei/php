
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");
?>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
 
<div class="mt10 hmui-shadow">
<!-- 树形图 -->
	<div class="fl p15 treebox" style="width:200px;background:#FFFFFF;"  id="lefttree_con">
 		<ul id="treeDemo" class="ztree"></ul>
 	</div>

	<div class="fr" style="width:calc(100% - 290px);background:#FFFFFF;padding:15px 30px 15px 20px;min-height:750px" id="main_con">
		
		 <iframe id="menumanagement_iframe" name="menumanagement_iframe" frameborder=0   style="width:100%;min-height:760px;" src="" ></iframe>
	

 	 
 </div>
 <div id="tbody_content"></div>
<?php include '../../../authen/include/page/bottom.php';?>
 
<script type="text/javascript">
	$(document).ready(function(){
		var left_height=$("#main_con").height();
		$("#lefttree_con").css({"overflow-y":"auto","height":""+left_height+"px"});
	})
var bodyheight=$(document).height();
$(".iframe_content").height(bodyheight);
 
var id="<?php echo $id?>";
 </script> 
<script type="text/javascript" src="js/menumanagement_detail.js"></script>
 