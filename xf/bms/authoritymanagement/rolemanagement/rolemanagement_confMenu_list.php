<?php include '../../../authen/include/page/top.php';?>
<script type="text/javascript" src="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/jquery.ztree.all.js"></script>
<link href="<?php echo ParaUtil::getInstance()->getRoot()?>/etc/js/ztree/zTreeStyle.css" rel="stylesheet" type="text/css"></link>

<div class="hmui-shadow">

  
<div class="content_wrap">
	<div class="zTreeDemoBackground left pr">
		<ul id="treeDemo" class="ztree"></ul>
	</div>
 		<input type="button"  onclick="aa()" id="btn_aa" value="确定" class="hmui-btn  ml10" style="top:10px;right:20px;position:fixed"/>
</div>
</div>
<div id="pageNav"></div>

<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
 </script>           
<script type="text/javascript" src="js/rolemanagement_confMenu_list.js"></script>