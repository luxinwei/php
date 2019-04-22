<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id")
?>


<div align="center" class="mt10 p20 hmui-shadow" style="background:#FFFFFF;min-height:750px">
    <span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
<div style="width:1200px;height:400px;margin:20px auto;border:1px solid #ffffff">
	视频窗口
</div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
<tr>
    <th width="15%">视频名称</th>
    <td width="35%"><span id="name"></span></td>
    <th width="15%">视频简介</th>
    <td width="35%"><span id="description"></span></td>
  </tr>
  <tr>
    <th>上传人</th>
    <td><span id="uploadUser"></span></td>
    <th>上传时间</th>
    <td><span id="createTime"></span></td>
  </tr>
 
</table>

</div>
<div id="detail"></div>
<script type="text/javascript">
    var id="<?php echo $id?>";  //将传递到js文件 :必须写的
</script>    
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/firevideo_detail.js"></script>