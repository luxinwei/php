<?php include '../../../authen/include/page/top.php';?>

<div class="hmui-shadow">

<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入建筑名称" class="hmui-input"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	
</form>

	<div class="">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
	<tr>
 		<th>编码</th>
		<th>建筑名称</th>
		<th>建筑类别</th>
	</tr>
	<tbody id="tbody_content"></tbody>                                                                  
</table>
</div>
<div id="pageNav"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var buildingTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingTypeCode")?>;  
</script>           
<script type="text/javascript" src="js/select_build_list.js"></script>