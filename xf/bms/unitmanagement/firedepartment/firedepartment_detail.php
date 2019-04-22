<?php include '../../../authen/include/page/top.php';?>
<?php
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>
	


<div align="center" style="background-color: #FFFFFF;min-height:700px" class="mt10 p20 hmui-shadow">
<span  class="fr">
		<font>联网状态：联网</font>
		<input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
	<div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
  <tr>
    <th width="15%;"><font class="cred">*</font>消防部门名称</th>
    <td width="35%"><span id="firemanagename"></span></td>
    <th width="15%"><font class="cred">*</font>所属区域</th>
    <td width="35%"><span id="areaId"></span></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>部门详址</th>
    <td><span id="address"></span></td>
    <th><font class="cred">*</font>联系电话</th>
    <td><span id="telephone"></span></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>部门负责人姓名</th>
    <td><span id="liaisonOfficer"></span></td>
    <th><font class="cred">*</font>部门负责人电话</th>
    <td><span id="liaisonOfficerPhone"></span></td>
  </tr>
    <tr>
    <th width="160px;"><font class="cred">*</font>部门级别</th>
    <td><span id="fireServiceCode"></span></td>
    <th width="160px;"><font class="cred">*</font>管辖区域</th>
    <td><span id="precinct"></span></td>
  </tr>
   
    <tr>
    <th><font class="cred">*</font>上级单位名称</th>
    <td><span id="parentCenter"></span></td>
     
  </tr>
    
   
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
  var id="<?php echo $id?>";  //将传递到js文件 :必须写的

  var fireServiceCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("fireServiceCode")?>;
  var state_jsarray=[['0','暂停'],['1','正常']];

</script>
<script type="text/javascript" src="js/firedepartment_detail.js"></script>