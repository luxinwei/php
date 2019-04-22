<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>打造前程-校企平台--后台管理系统</title>

<?php  common_css(); common_js(); ?>
<script type="text/javascript" src="__PUBLIC__/admin/js/custom/index.js"></script>
</head>

<body class="withvernav">
<div class="bodywrapper">
    <div class="topheader">
        <div class="left">
            <h1 class="logo">校企平台.<span>打造前程</span></h1>
            <span class="slogan">后台管理系统</span>
            
            <div class="search">
            	<form action="" method="post">
                	<input type="text" name="keyword" id="keyword" value="请输入" />
                    <button class="submitbutton"></button>
                </form>
            </div><!--search-->
            
            <br clear="all" />
            
        </div><!--left-->
        
        <div class="right">
        	<!--<div class="notification">
                <a class="count" href="ajax/notifications.html"><span>9</span></a>
        	</div>-->
            <div class="userinfo">
            	<img src="__PUBLIC__/admin/images/thumbs/avatar.png" alt="" />
                <span><?php echo ($user); ?></span>
            </div><!--userinfo-->
            
            <div class="userinfodrop">
            	<div class="avatar">
                	<a href=""><img src="__PUBLIC__/admin/images/thumbs/avatarbig.png" alt="" /></a>
                    <div class="changetheme">
                    	切换主题: <br />
                    	<a class="default"></a>
                        <a class="blueline"></a>
                        <a class="greenline"></a>
                        <a class="contrast"></a>
                        <a class="custombg"></a>
                    </div>
                </div><!--avatar-->
                <div class="userdata">
                	<h4><?php echo ($user); ?></h4>
                    <span class="email"></span>
                    <ul>
                    	<!--<li><a href="#">编辑资料</a></li>
                        <li><a href="#">账号设置</a></li>-->
                        <li><a href="<?php echo U('Login/changePwd');?>" target="iframepage">修改密码</a></li>
                        <li><a href="<?php echo U('Login/logout');?>">退出</a></li>
                    </ul>
                </div><!--userdata-->
            </div><!--userinfodrop-->
        </div><!--right-->
    </div><!--topheader-->
    
    
    <div class="header">
    	<ul class="headermenu">
        	<li class="current"><a href="#"><span class="icon icon-flatscreen"></span>首页</a></li>
            <li><a href="#"><span class="icon icon-pencil"></span>管理</a></li>
            <li><a href="#"><span class="icon icon-message"></span>查看消息</a></li>
            <li><a href="#"><span class="icon icon-chart"></span>统计报表</a></li>
        </ul>
        
       <div class="headerwidget">
        	<div class="earnings">
            	<div class="one_half">
                	<h4></h4>
                    <h2></h2>
                </div><!--one_half-->
                <div class="one_half last alignright">
                	<h4> </h4>
                    <h2> </h2>
                </div><!--one_half last-->
            </div><!--earnings-->
        </div><!--headerwidget-->
        
    </div><!--header-->
    
    <div class="vernav2 iconmenu">
    	<ul>
        	<!--
        	<li><a href="#formsub" class="editor">权限管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub">
               		<li><a href="<?php echo U('Rbac/addRole');?>" target="iframepage">添加角色</a></li>
                    <li><a href="<?php echo U('Rbac/roleList');?>" target="iframepage">角色管理</a></li>
                    <li><a href="<?php echo U('Rbac/addNode');?>" target="iframepage">添加节点</a></li>
                    <li><a href="<?php echo U('Rbac/nodeList');?>" target="iframepage">节点管理</a></li>
                    <li><a href="<?php echo U('Rbac/addUser');?>" target="iframepage">添加用户</a></li>
                    <li><a href="<?php echo U('Rbac/userList');?>" target="iframepage">用户管理</a></li>
                </ul>
            </li>
            <li><a href="#addons" class="addons">实名认证</a>
            	<span class="arrow"></span>
            	<ul id="addons">
               		<li><a href="<?php echo U('Audit/realNameAudit');?>" target="iframepage">实名认证列表</a></li>
                    <li><a href="profile.html">资料页面</a></li>
                    <li><a href="productlist.html">产品列表</a></li>
                    <li><a href="photo.html">图片视频分享</a></li>
                    <li><a href="gallery.html">相册</a></li>
                    <li><a href="invoice.html">购物车</a></li>
                </ul>
            </li>
            -->
				
		<?php if(is_array($menuTree)): $k = 0; $__LIST__ = $menuTree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mrow): $mod = ($k % 2 );++$k; if(is_array($mrow["child"])): $k2 = 0; $__LIST__ = $mrow["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mrow2): $mod = ($k2 % 2 );++$k2;?><li>
		
		<a href="#formsub<?php echo ($k2); ?>" class="editor"><?php echo ($mrow2["self"]["title"]); ?></a>
		
		
            	<span class="arrow"></span>
            	<ul id="formsub<?php echo ($k2); ?>">
            	
               		 <?php if(is_array($mrow2["child"])): $k3 = 0; $__LIST__ = $mrow2["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mrow3): $mod = ($k3 % 2 );++$k3;?><li><a href='<?php
 echo U($mrow2[self][name]."/".$mrow3[self][name]); ?>' target="iframepage"><?php echo ($mrow3["self"]["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>   
               		
               		
                </ul>
            </li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>   		
		 
            
           
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
        
    <div class="centercontent">
        
        
        <iframe name="iframepage"  id="iframepage" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
        
        onLoad="iFrameHeight()" ></iframe>
    
    
</div><!--bodywrapper-->
<script type="text/javascript">   	
function iFrameHeight() {   
	var ifm= document.getElementById("iframepage");   
	var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;   
	if(ifm != null && subWeb != null) {
	   ifm.height = subWeb.body.scrollHeight;
	   ifm.width = subWeb.body.scrollWidth;
	}   
}   
</script>
</body>
</html>