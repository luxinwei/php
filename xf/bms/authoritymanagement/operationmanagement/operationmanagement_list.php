
<?php include '../../../authen/include/page/top.php';?>
 
   <script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>
 
<div class="mt10 hmui-shadow">
<!-- 树形图 -->
	<div class="fl p15 treebox" style="width:20%;background:#FFFFFF;"  id="lefttree_con">
 		<ul id="treeDemo" class="ztree"></ul>
 	</div>

	<div class="fr" style="width:calc(90% - 290px);background:#FFFFFF;padding:15px 30px 15px 20px;min-height:760px" id="main_con">
		
		 <iframe id="operationmanagement_iframe" name="operationmanagement_iframe" frameborder=0   style="width:100%;min-height:760px;" src="" ></iframe>
	

 	 
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
 
 
 </script> 
<script type="text/javascript" src="js/operationmanagement_list.js"></script>
 