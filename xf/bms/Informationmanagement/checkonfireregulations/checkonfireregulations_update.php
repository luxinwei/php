<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");    //获取id 根据此id进行修改:必须要有的
?>



<div align="center" style="background-color: #FFFFFF;min-height:700px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
        
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
 <tr>
    <th width="15%"><font class="cred">*</font>法规名称</th>
    <td width="35%"><input class="hmui-input w" id="statutename"/></td>
    <th width="15%"><font class="cred">*</font>法规类别</th>
      <td width="35%">
    <select class="hmui-select w"  id="fireLawCode">
    <option value=""><font class="cred">*</font>请选择法规级别</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("fireLawCode", "")?>
    </select> 
    </td>
  </tr>
  <tr>
    <th><font class="cred">*</font>颁布机关</th>
    <td><input class="hmui-input w" id="promulgateOffice"/></td>
    <th><font class="cred">*</font>批准机关</th>
    <td><input class="hmui-input w" id="approveOffice"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>颁布文号</th>
    <td><input class="hmui-input w" id="promulgateNo"/></td>
    <th><font class="cred">*</font>输入人姓名</th>
    <td><input class="hmui-input w" id="createUser"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>颁布日期</th>
    <td><input class="hmui-input w" id="promulgateDate"/></td>
    <th><font class="cred">*</font>实施日期</th>
    <td><input class="hmui-input w" id="implementDate"/></td>
  </tr>
  <tr>
      <th>法规内容</th>
    <td colspan="3"><textarea rows="4" class="hmui-textarea pl10 w" id="content"></textarea></td>
  </tr>
  </table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>   
<script>
var id="<?php echo $id?>";   //将传递到js文件 :必须写的
</script>       
<script type="text/javascript" src="js/checkonfireregulations_update.js"></script>