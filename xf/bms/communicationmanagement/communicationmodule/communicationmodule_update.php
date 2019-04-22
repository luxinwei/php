<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");    //获取id 根据此id进行修改:必须要有的
?>
	
<div align="center" style="background-color: #FFFFFF;min-height:750px" id="detail" class="p20 mt10 hmui-shadow">
<span class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
	<div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="1200">
    
  <tr>
    <th width="15%"><font class="cred">*</font>唯一标示</th>
    <td width="35%"><input class="hmui-input w" id="sid" /></td>
    <th width="15%"><font class="cred">*</font>所属单位</th>
    <td width="35%">
    <input class="hmui-input w hand" id="depId" depIdValue="" value="" />
    </td>
  </tr>
    <tr>
    <th><font class="cred">*</font>模块名称</th>
    <td><input class="hmui-input w" id="modelname"  /></td>
    <th><font class="cred">*</font>模块类型</th>
    <td>
     <select class="hmui-select w"  id="comMouldCode">
    <option value="">请选择</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("comMouldCode", "")?>
    </select>
    </td>
  </tr>
   <tr>
    <th><font class="cred">*</font>安装位置</th>
    <td><input class="hmui-input w" id="position" /></td>
    <th><font class="cred">*</font>描述信息</th>
    <td><input class="hmui-input w" id="description" /></td>
  </tr>
 
   
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";   //将传递到js文件 :必须写的
</script>           
<script type="text/javascript" src="js/communicationmodule_update.js"></script>