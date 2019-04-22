<?php include '../../../authen/include/page/top.php';?>
<?php
$id=Fun::request("id");    //获取id 根据此id进行修改:必须要有的
$libsArray=array("1"=> "正常","0"=> "暂停");
?>



<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
  <span  class="fr">
		<font>联网状态：联网</font>
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
  <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
  <tr>
    <th width="15%;"><font class="cred">*</font>消防部门名称</th>
    <td width="35%"><input class="hmui-input w" id="firemanagename"/></td>
    <th width="15%;"><font class="cred">*</font>所属区域</th>
    <td width="35%;"><input class="hmui-input w hand" id="areaId" areaIdValue="" value="" /></td>
  
  </tr>

    <tr>
    <th><font class="cred">*</font>联系电话</th>
    <td><input class="hmui-input w" id="telephone" /></td>
    <th><font class="cred">*</font>部门负责人姓名</th>
    <td><input class="hmui-input w"id="liaisonOfficer" /></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>部门负责人电话</th>
    <td><input class="hmui-input w" id="liaisonOfficerPhone" /></td>
    <th><font class="cred">*</font>部门级别</th>
    <td><input class="hmui-input w" id="fireServiceCode" /></td>
  </tr>
   <tr>
    <th><font class="cred">*</font>管辖区域</th>
    <td><input class="hmui-input w" id="precinct" /></td>
     <th><font class="cred">*</font>上级单位名称</th>
    <td><input class="hmui-input w" id="parentCenter" /></td>
  </tr>   
   <tr>
    <th><font class="cred">*</font>部门详址</th>
    <td class="pr"><input id="address" class="hmui-input w" /><input type="button" id="btn_map"/><input type="hidden" id="position" /></td>
  </tr> 
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
  var id="<?php echo $id?>";   //将传递到js文件 :必须写的
</script>
<script type="text/javascript" src="js/firedepartment_update.js"></script>