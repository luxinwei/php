<?php include '../../../authen/include/page/top.php';?>

<div class="hmui-shadow">

<form  id="myform" class="alert_info">
<input name="name"  placeholder="请输入建筑名称" class="hmui-input"/>
<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	
</form>

	<div class="">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="500">
	<tr>
 		<th>编号</th>
		<th>appCode</th>
 	</tr>
	<tbody id="tbody_content"></tbody>                                                                  
</table>
</div>
<div id="pageNav"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var buildingTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingTypeCode")?>;  
</script>           
<script type="text/javascript" src="js/select_app_list.js"></script>