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
<table width="1200" class="hmui-table2">
   <tr>
    <th width="16%">名称</th>
    <td  width="34%"><span id="mininame"></span></td>
    <th   width="16%">编码</th>
    <td  width="34%"><span id="code"></span> </td>
  </tr>
  <tr>
    <th>所在地图位置</th>
    <td><span id="address"></span></td>
	 <th>所在地图坐标</th>
    <td><span id="position"></span></td>
  </tr>
  <tr>
    <th>负责人</th>
    <td><span id="chargePerson"></span></td>
    <th>联系电话</th>
    <td><span id="phone"></span></td>
  </tr>
    <tr>
    <th>值班电话</th>
    <td ><span id="dutyPhone"></span></td>
      <th>站点人数</th>
    <td><span id="personCount"></span><span>（个）</span></td>
  </tr>
   <tr>
    <th>微型消防站关联人员</th>
     <td ><input type="button" value="查看人员" id="btn_look" class="hmui-btn" /></td>
  
  </tr>
</table>
</div>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
 </script>         
<script type="text/javascript" src="js/mini_firestation_detail.js"></script>