<?php include  dirname(__FILE__).'/../../../com/base/util/DB.class.php';?>
<?php include  dirname(__FILE__).'/../../../com/base/util/FimGroupUtil.class.php';?>
<?php include  dirname(__FILE__).'/../../../com/base/util/ParaUtil.class.php';?>
<?php include  dirname(__FILE__).'/../../../com/base/util/Fun.class.php';?>
<?php include  dirname(__FILE__).'/../../../authen/include/page/session_manage.php';?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<title><?php echo ParaUtil::getInstance()->getSystitle()?></title>

</head>
<body scroll="no">
<script type="text/javascript">
var rootPath="<?php echo str_ireplace("/manage/fim/login/sysindex.php","",$_SERVER ['PHP_SELF']);?>";
</script>
<?php  $fimgroupid=$sessionManageUserArray["FIMGROUPID"]; ?>

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
<link href="js/sysindex.css" rel="stylesheet" type="text/css">
		<div id="layout1">
			<div position="top">
				<?php include "sysindex_top.php";?>
			</div>

			<style>
				.down-menu{position:absolute;top:81px;right:40px;box-shadow:4px 4px 4px 0 rgba(176,206,250,0.27);border:1px solid #808ca3;border-radius:5px;background:#ffffff;z-index:99}
				.down-menu ul li {font-size:14px;line-height:40px;width:180px;color:#8f9aaf;height:40px;padding-left:10px;cursor:pointer}
				.down-menu ul li:nth-child(4){border-top:1px solid #d4dded}
				.down-menu ul li:hover{background:#4877e8;color:#FFFFFF}
				.down-menu ul li img{display:block;float: left;margin:10px}
				.down-menu ul li span{display:block;float: left}
				#triangle{position: absolute;width: 0;height: 0;border-left: 8px solid transparent;border-right: 8px solid transparent;border-bottom: 16px solid #ffffff;top:-10px;left:120px;}
				.popup{position: absolute;background:rgba(243,247,255,0.5);height:100%;width:100%;z-index:100;top:0;}
				.popup .popup-box{width:400px;height:300px;margin:100px auto;border-radius:5px;
					box-shadow:-4px 4px 6px rgba(176,206,250,0.3),4px 4px 6px rgba(176,206,250,0.3),4px 4px 6px rgba(176,206,250,0.3);background:#ffffff}
				.popup .popup-box .popup-top{width:100%;height:50px;background:#5b8cff;border-radius:5px 5px 0 0;}
				.popup .popup-box .popup-top span{display: block;float:left;color:#FFFFFF;font-size:18px;line-height:50px;margin-left:10px}
				.popup .popup-box .popup-top img{display: block;float:right;margin:16px 10px 0 0;cursor: pointer}
				.popup .popup-box .popup-main .main-tx img{width:80px;height:80px;display: block;margin:10px auto}
				.popup .popup-box .popup-main .main-words{margin:30px 0 0 80px}
				.popup .popup-box .popup-main .main-words p{color:#808CA3;font-size:16px;line-height:42px}

				.popup-passwords{position: absolute;background:rgba(243,247,255,0.5);height:100%;width:100%;z-index:100;top:0;}
				.popup-passwords .popup-box {width:400px;height:300px;margin:100px auto;border-radius:5px;
					box-shadow:-4px 4px 6px rgba(176,206,250,0.3),4px 4px 6px rgba(176,206,250,0.3),4px 4px 6px rgba(176,206,250,0.3);background:#ffffff}
				.popup-passwords .popup-box .popup-top{width:100%;height:50px;background:#5b8cff;border-radius:5px 5px 0 0;}
				.popup-passwords .popup-box .popup-top span{display: block;float:left;color:#FFFFFF;font-size:18px;line-height:50px;margin-left:10px}
				.popup-passwords .popup-box .popup-top img{display: block;float:right;margin:16px 10px 0 0;cursor: pointer}
				.popup-passwords .popup-box .popup-btns ul{margin-top:40px}
				.popup-passwords .popup-box .popup-btns ul li{width:367px;margin:18px auto 0}
				.popup-passwords .popup-box .popup-btns ul li span{color:#808CA3;font-size:16px;display:inline-block;width:80px;}
				.popup-passwords .popup-box .popup-btns ul li input{width:275px;height:34px;border:1px solid #cadaff;background:#f0f3fa;padding-left:5px;font-size:12px;color:#999999;}
				.popup-passwords .popup-box .popup-btns ul li input:focus{border:1px solid #4877e8}

			</style>
			<div class="down-menu">
				<div id="triangle"></div>
				<ul>
					<li>
						<img src="img/icon-18px(4).png">
						<span>用户信息查看</span>
					</li>
					<li>
						<img src="img/icon-18px(3).png">
						<span>修改密码</span>
					</li>
					<li>
						<img src="img/icon-18px(2).png">
						<span>修改联系方式</span>
					</li>
					<li id="sysindexexit">
						<img src="img/icon-18px(1).png">
						<span>退出系统</span>
					</li>
				</ul>
			</div>
			<!--用户信息查看-->
			<div class="popup">
				<div class="popup-box">
					<div class="popup-top">
						<span>用户信息查看</span>
						<img src="img/guanbi.png" class="close">
						<div class="clearfix"></div>
					</div>
					<div class="popup-main">
						<div class="main-tx">
							<img src="img/touxiang.png">
						</div>
						<div class="main-words">
							<p>用户名称：河南科技有限公司</p>
							<p>手机号码：15690870472</p>
						</div>
					</div>
				</div>
			</div>
			<!--修改密码-->
			<div class="popup-passwords">
				<div class="popup-box">
					<div class="popup-top">
						<span>修改密码</span>
						<img src="img/guanbi.png" class="close2">
						<div class="clearfix"></div>
					</div>
					<div class="popup-btns">
						<ul>
							<li>
								<span>原密码:</span>
								<input type="text" placeholder="请输入原密码">
							</li>
							<li>
								<span>新密码:</span>
								<input type="text" placeholder="请输入新密码">
							</li>
							<li>
								<span>确认密码:</span>
								<input type="text" placeholder="请在输入一次密码">
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div position="left" title="系统菜单" id="left">
					<div id="defaulf_left">
		             <?php include "sysindex_left.php";?>
		
					</div>
					<div id="collapseleft" ><img src="js/img/nh.gif" style="margin-top:350px;cursor:pointer;"/></div>

			</div>
			<div position="center" title="<?php echo ParaUtil::getInstance()->getSystitle()?>" id="navmenu">
				<iframe style="margin:0px; padding:0px;" id="contentFrame" name="contentFrame" src="main.php" frameborder="0" width="100%" height="100%"></iframe>
			</div>
			<div position="bottom">
				<?php include "sysindex_bottom.php";?>
			</div>
		</div>
</html>
<link href="js/sysindex.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" >
	var systitle="<?php echo ParaUtil::getInstance()->getSystitle()?>";
</script>
<script type="text/javascript" src="js/sysindex.js"></script>
