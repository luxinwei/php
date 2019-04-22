<?php include '../../../authen/include/page/top.php';?>
<?php 
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>
<div align="center" style="background:#FFFFFF;min-height:725px;"  class="p20 mt10 hmui-shadow">
  <div class="fr">
    <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
  </div>
  <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table2">
   <tr>
    <th width="15%"><font class="cred"></font>名称</th>
    <td width="35%"><span id="mininame"></span></td>
    <th width="15%"><font class="cred"></font>位置</th>
    <td  width="35%"><span id="address"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>所属单位</th>
    <td><span id="depName"></span></td>
    <th><font class="cred"></font>编码</td>
    <td><span id="code"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>负责人</th>
    <td><span id="chargePerson"></span></td>
    <th><font class="cred"></font>联系电话</td>
    <td><span id="phone"></span></td>
  </tr>
    <tr>
    <th><font class="cred"></font>值班电话</th>
    <td ><span id="dutyPhone"></span></td>
      <th><font class="cred"></font>站点人数</td>
    <td><span id="personCount"></span></td>
  </tr>

</table>

</div>

<?php include '../../../authen/include/page/bottom.php';?>

<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
</script>           
<script type="text/javascript" src="js/mini_firestation_detail.js"></script>