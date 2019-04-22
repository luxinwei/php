
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
$partId=Fun::request("partId");  
 
?>
 <body style="background:#FFFFFF;">

<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
         <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<div id="tbody_content"></div>

<table class="hmui-table2" width="1200">
<tr>
  	<th>报警时间</th>
    <td><span id="time"></span></td>
    <th >报警类型</th>
    <td><span id="type"></span></td>
</tr>
<tr>
    <th >报警内容</th>
    <td><span id="content"></span></td>
  	<th>当前状态</th>
    <td><span id="state"></span></td>
</tr>
  <tr>
    <th width="15%">所属建筑</th>
    <td width="35%"><span id="buildingName"></span></td>
    <th width="15%">所属部位</th>
    <td width="35%"><span id="impName"></td>   
</tr> 
<tr>
  	<th>所属设施</th>
    <td><span id="deviceName"></span></td>
    <th >是否误报</th>
    <td><span id="disposeTime"></span></td>
</tr>
<tr>
    <th>处理时间</th>
    <td><span id="disposeTime"></span></td>
  	<th>处理结果</th>
    <td><span id="result"></span></td>
</tr>
</table>
</div>
</body>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var state_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingFireDangerCode")?>;
var id="<?php echo $id?>";
var partId="<?php echo $partId?>";
var state_jsarry=[['0','未处理'],['1','已处理']];
</script>           
<script type="text/javascript" src="js/electricfiremonitor_detail9.js"></script>