<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");
?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
	<div class="fr">
		<input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table">
        <tr>
            <th width="15%">角色名称</th>
            <td width="35%"><span id="name"></span></td>
        	<th width="15%">应用产品</th>
            <td width="35%"><span id="appCode"></span></td>
        </tr>
 		<tr>
        	<th  width="150px;">权限管理</th>
            <td colspan="3"></td>
        </tr>
        <tr>
        	<th  width="150px;">描述</th>
            <td colspan="3"><span id="description"></span></td>
        </tr>
    </table>
</div>
<script type="text/javascript">
var id="<?php echo $id?>";
</script> 
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript" src="js/rolemanagement_detail.js"></script>