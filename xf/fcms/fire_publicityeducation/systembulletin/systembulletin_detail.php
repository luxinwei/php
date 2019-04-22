<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");
?>
 
<div align="center" class="mt10 p20 hmui-shadow" style="background:#FFFFFF;min-height:750px">
	<span  class="fr">
		<input type="button" value="编辑" id="btn_update" class="hmui-btn"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
<tr>
    <th width="160px;">公告内容</th>
    <td><span id="content"></span></td>
    <th  width="150px;">公告范围</th>
    <td><span id="bulletinAreaCode"></span></td>
  </tr>
  <tr>
    <th>公告内容范围值</th>
    <td><span id="scopeValue"></span></td>
    <th>公告保存状态</th>
    <td><span id="dataStateCode"></span></td>
  </tr>
    <tr>
    <th>输入人姓名</th>
    <td><span id="createUser"></span></td>
    <th>创建时间</th>
    <td><span id="createTime"></span></td>
 </tr>
</table>
</div>
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
 </script> 
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/systembulletin_detail.js"></script>