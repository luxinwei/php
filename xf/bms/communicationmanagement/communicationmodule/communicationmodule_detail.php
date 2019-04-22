
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
<style>
ul li{float: left; margin-left: 15px;}
</style>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
	<div class="fr">
		<input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table">
  <tr>
    <th width="15%">唯一标识</th>
    <td width="35%"><span id="sid"></span></td>
        <th width="15%">所属单位</th>
    <td width="35%"><span id="depName"></span></td>
  </tr>
 <tr>
	<th >模块名称</th>
	<td><span id="name"></span></td>
	<th >通讯模组类型</th>
	<td> 
		 <span id="comMouldCode"></span>
	</td>
</tr>
<tr>

	<th >安装位置</th>
    <td><span id="position"></span></td>
     <th>描述信息长度</th>
    <td ><span id="description"></span></td>
</tr>
  
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var comMouldCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("comMouldCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
 var id="<?php echo $id?>";
</script>        
<script type="text/javascript" src="js/communicationmodule_detail.js"></script>