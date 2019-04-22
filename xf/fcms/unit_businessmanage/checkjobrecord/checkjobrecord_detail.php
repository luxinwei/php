
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
 
<div align="center" class="mt10 p20 hmui-shadow" style="background:#FFFFFF;min-height:750px">
	<span  class="fr">
			<input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
	
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
<tr>
    <th width="15%"><font class="cred"></font>查岗发起人名称</th>
    <td width="35%"><span id="user"></span></td>
    <th width="15%"><font class="cred"></font>查岗结果 </th>
    <td width="35%"><span id="result"></span> </td>
  </tr>
  <tr>
    <th><font class="cred"></font>查岗单位</th>
    <td><span id="depName"></span></td>
    <th><font class="cred"></font>被查单位</th>
    <td><span id="checkedDepId"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>发起时间</th>
    <td><span id="startTime"></span></td>
    <th><font class="cred"></font>结束时间</th>
    <td><span id="endTime"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>视频截图名称</th>
    <td><span id="fileName"></span></td>

  </tr>
  <tr>
  	 <th><font class="cred"></font>视频截图</th>
    <td>
    <img src=" " id="file">
    </td>
  </tr>
  	
</table>
</div>
 
<?php include '../../../authen/include/page/bottom.php';?>
<div id="detail"></div>
<script type="text/javascript">
var id="<?php echo $id?>";
var result_jsarry=[['0','不和格'],['1','合格']];
 </script>    
<script type="text/javascript" src="js/checkjobrecord_detail.js"></script>