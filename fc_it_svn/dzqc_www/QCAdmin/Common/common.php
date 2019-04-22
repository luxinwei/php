<?php
function common_css() {
	
	$a = <<<aaa
<link rel="stylesheet" href="__PUBLIC__/admin/css/style.default.css" type="text/css" />
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="__PUBLIC__/admin/css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="__PUBLIC__/admin/css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="__PUBLIC__/admin/js/plugins/css3-mediaqueries.js"></script>
<![endif]-->
aaa;
	echo $a;

}

function common_js() {
	$a = <<<aaa
	
<script type="text/javascript">
var _PUBLIC_="__PUBLIC__/";
var _APP_="__APP__/";
</script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery.slimscroll.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery.flot.min.js"></script>

<script type="text/javascript" src="__PUBLIC__/admin/js/custom/general.js"></script>
<!--[if lt IE 9]>
	<script src="__PUBLIC__/admin/js/plugins/css3-mediaqueries.js"></script>
<![endif]-->
aaa;
	echo $a;

}