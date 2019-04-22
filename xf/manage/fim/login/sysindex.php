<?php include_once dirname(__FILE__).'/../../../manage/include/page/session_manage.php';?>
<?php include_once  dirname(__FILE__).'/../../../com/base/util/FimGroupUtil.class.php';?>
<?php include_once  dirname(__FILE__).'/../../../com/base/util/ParaUtil.class.php';?>
<?php include_once  dirname(__FILE__).'/../../../manage/include/page/session_manage.php';?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<title><?php echo ParaUtil::getInstance()->getSystitle()?></title>
<link href="js/sysindex.css" rel="stylesheet" type="text/css">
</head>
<body scroll="no">
<script type="text/javascript">
var rootPath="<?php echo str_ireplace("/manage/fim/login/sysindex.php","",$_SERVER ['PHP_SELF']);?>";
</script>
<?php  $fimgroupid=$sessionManageUserArray["FIMGROUPID"]; ?>
<link href="js/sysindex.css" rel="stylesheet" type="text/css" />
<link href="../../../etc/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<!-- 
<link rel="stylesheet" type="text/css" href="../../../etc/js/ligerui/lib/ligerUI/skins/Aqua/css/ligerui-all.css" />
 -->
<link rel="stylesheet" type="text/css" href="../../../etc/js/ligerui/lib/ligerUI/skins/Aqua/css/ligerui-common.css" />
<link rel="stylesheet" type="text/css" href="../../../etc/js/ligerui/lib/ligerUI/skins/Aqua/css/ligerui-dialog.css" />
<link rel="stylesheet" type="text/css" href="../../../etc/js/ligerui/lib/ligerUI/skins/Aqua/css/ligerui-form.css" />
<link rel="stylesheet" type="text/css" href="../../../etc/js/ligerui/lib/ligerUI/skins/Aqua/css/ligerui-grid.css" />
<link rel="stylesheet" type="text/css" href="../../../etc/js/ligerui/lib/ligerUI/skins/Aqua/css/ligerui-layout.css" />
<link rel="stylesheet" type="text/css" href="../../../etc/js/ligerui/lib/ligerUI/skins/Aqua/css/ligerui-menu.css" />
<link rel="stylesheet" type="text/css" href="../../../etc/js/ligerui/lib/ligerUI/skins/Aqua/css/ligerui-tab.css" />
<link rel="stylesheet" type="text/css" href="../../../etc/js/ligerui/lib/ligerUI/skins/Aqua/css/ligerui-tree.css" />

<script  type="text/javascript" src="../../../etc/js/common/jquery.js"></script>
<script  type="text/javascript" src="../../../etc/js/ligerui/lib/ligerUI/js/core/base.js"></script>
<script  type="text/javascript" src="../../../etc/js/ligerui/lib/ligerUI/js/ligerui.min.js"></script>
<script  type="text/javascript" src="../../../etc/js/dialog/zDialog.js"></script>
<script  type="text/javascript" src="../../../etc/js/dialog/zDrag.js"></script>
<script  type="text/javascript" src="../../../etc/js/ztree/jquery.ztree.all.min.js"></script>
<link   rel="stylesheet" type="text/css" href="../../../etc/js/ztree/zTreeStyle.css" />

		<div id="layout1">
			<div position="top">
				<?php include "sysindex_top.php";?>
			</div>
			<div position="left" title="系统菜单" id="left">
			
			     <div id="syssecondmenu">
				     <div class="smallmenu">
				       <div class="hd" id="smallmenu_title">&nbsp;&nbsp;<strong>系统菜单 </strong></div>
				       <div class="bd"><ul id="treeDemo" class="ztree"></ul></div>
				     </div>
			     </div>
			     <div class="logininfo">
			       <div class="hd">&nbsp;&nbsp;<font color="#6699CC"><b>登陆用户</b></font></div>
			       <div class="bd">     
			                      <ul>
			                      <li>账号：<?php echo $sessionManageUserArray["USERACCOUNT"];?></li>
			                      <li>名称：<?php echo $sessionManageUserArray["NICKNAME"];?></li>
			                      <li>当前IP:<?php echo $_SERVER["REMOTE_ADDR"];?></li>
			                      
			                      <li>登录：<font color="#FF0000">(<?php echo $sessionManageUserArray["LOGINCOUNT"];?>)</font>次</li>
			                      <li id="onlinetime1">时间：2016-10-5 10:02:05</li>
			                      </ul>
			                                                                
			                 
			       </div>
			     </div>

			

			</div>
			<div position="center" title="<?php echo ParaUtil::getInstance()->getSystitle()?>" id="navmenu">
				<iframe style="margin:0px; padding:0px;" id="contentFrame" name="contentFrame" src="main.php" frameborder="0" width="100%" height="100%"></iframe>
			</div>
			<div position="bottom">
				<?php include "sysindex_bottom.php";?>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript" >
var zNodes=<?php echo(FimGroupUtil::getInstance()->getZTreeJson($fimgroupid))?>;
var exit_time=0;
</script>
<script type="text/javascript" src="js/sysindex.js"></script>
