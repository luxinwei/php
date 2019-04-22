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
        <th width="15%">主机名称</th>
        <td width="35%"><span id="name"></span></td>
        <th width="15%">主机sid</th>
        <td width="35%"><span id="sid"></span></td>
      </tr>
      <tr>
        <th>通讯模组</th>
        <td><span id="moduleId"></span></td>
        <th>生产厂商</td>
        <td><span id="manufacturer"></span></td>
      </tr>
      <tr>
        <th>型号</th>
        <td><span id="model"></span></td>
        <th>编号</th>
        <td ><span id="number"></span></td>
      </tr>
       <tr>
        <th>描述</th>
        <td><span id="description"></span></td>
        <th>删除状态</th>
        <td ><span id="delFlag"></span></td>
      </tr>
</table>
</div>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var yesornot_jsarry=[["1","是"],["0","否"]];
var id="<?php echo $id?>";
</script>           
<script type="text/javascript" src="js/fireengine_detail.js"></script>