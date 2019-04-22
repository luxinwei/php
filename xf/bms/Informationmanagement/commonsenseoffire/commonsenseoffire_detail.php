<?php include '../../../authen/include/page/top.php';?>
<?php
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>



<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
		<input type="button" value="编辑" class="hmui-btn" id="btn_edit"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
  <tr>
    <th width="160px;">常识名称</th>
    <td ><span id="commonname"></span></td>

    <th width="160px;">输入人姓名</th>
    <td><span id="createUser"></span></td>
  </tr>
  <tr>
      <th></th>
      <td colspan="3"><span id="content"></span></td>
  </tr>
  
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
    var id="<?php echo $id?>";  //将传递到js文件 :必须写的
</script>
<script type="text/javascript" src="js/commonsenseoffire_detail.js"></script>