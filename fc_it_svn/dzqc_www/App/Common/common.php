<?php
function common_css() {
	
	$a = <<<aaa
<link rel="stylesheet" type="text/css" href="__PUBLIC__/www/plug/ui-dialog.css"/>
aaa;
	echo $a;

}

function common_js() {
	$a = <<<aaa
	
<script type="text/javascript">
var _PUBLIC_="__PUBLIC__/";
var _APP_="__APP__/";
</script>

<script type="text/javascript" src="__PUBLIC__/www/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/www/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/www/js/function.js"></script>
<script type="text/javascript" src="__PUBLIC__/www/js/plug.js"></script>
<script type="text/javascript" src="__PUBLIC__/www/js/jquery-ui.js"></script>
<script type="text/javascript" src="__PUBLIC__/www/plug/dialog-min.js"></script>
aaa;
	echo $a;

}