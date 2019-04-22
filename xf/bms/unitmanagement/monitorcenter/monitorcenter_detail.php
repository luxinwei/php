<?php include '../../../authen/include/page/top.php';?>
<?php 
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>

<div align="center" style="background-color: #FFFFFF;min-height:750px;" class="hmui-shadow p20">
  <span  class="fr">
		<font>联网状态：联网</font>
		<input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
  <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200" id="detail">
  <tr>
    <th width="15%"><font class="cred">*</font>中心名称</th>
    <td width="35%"><span id="centername"></span></td>
    <th width="15%"><font class="cred">*</font>所属区域</th>
    <td width="35%"><span id="address"></span></td>
  </tr>
  <tr>
    <th ><font class="cred">*</font>中心详地址</th>
    <td><span id="position"></span></td>
    <th ><font class="cred">*</font>联系电话</th>
    <td><span id="telephone"></span></td>
  </tr>
  <tr>
    <th ><font class="cred">*</font>中心负责人姓名</th>
    <td><span id="chargePerson"></span></td>
    <th><font class="cred">*</font>中心负责人联系方式</th>
    <td><span id="chargePhone"></span></td>
  </tr>
  <tr>
  <th><font class="cred">*</font>中心级别</th>
    <td><span id="monitorCenterRankCode"></span></td>
    <th><font class="cred">*</font>上级中心名称</th>
    <td><span id="parentCenter"></span></td> 
  </tr>
  <tr>
    <th><font class="cred">*</font>冗余备份中心名称</th>
    <td></td>
    <th><font class="cred">*</font>状态</th>
    <td><span id="pauseFlag"></span></td>
  </tr>

   
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var monitorCenterRankCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("monitorCenterRankCode")?>;
var pauseFlag_jsarray=[['0','暂停'],['1','正常']];
   
</script>           
<script type="text/javascript" src="js/monitorcenter_detail.js"></script>