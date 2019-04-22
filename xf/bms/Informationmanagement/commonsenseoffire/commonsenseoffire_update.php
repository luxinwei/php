<?php include '../../../authen/include/page/top.php';?>
<?php
$id=Fun::request("id");    //获取id 根据此id进行修改:必须要有的
?>



<div align="center" style="background-color: #FFFFFF;min-height: 700px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
	<div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
 <tr>
    <th width="15%">常识名称</th>
    <td width="35%"><input class="hmui-input w" id="commonname" /><span ></span></td>
    <th width="15%">输入人姓名</th>
    <td width="35%"><input  class="hmui-input w" id="createUser" /></td>
  </tr>
  <tr>
    <th></th>
    <td colspan="3"><textarea rows="4" class="hmui-textarea w pl10" id="content" placeholder="请输入文章内容"></textarea></td>
  </tr>
  </table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
    var id="<?php echo $id?>";   //将传递到js文件 :必须写的
</script>
<script type="text/javascript" src="js/commonsenseoffire_update.js"></script>