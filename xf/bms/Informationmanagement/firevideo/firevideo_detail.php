<?php include '../../../authen/include/page/top.php';?>



<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
<div style="width:1200px;height:400px;margin:20px auto;border:1px solid #ffffff">
	视频窗口
</div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
<tr>
    <th>视频名称</th>
    <td colspan="3"></td>
  </tr>
  <tr>
    <th width="15%">上传人</th>
    <td width="35%"><span id=""></span></td>
    <th width="15%">上传时间</th>
    <td width="35%"><span id=""></span></td>
  </tr>
  <tr>
    <th>视频简介</th>
    <td colspan="3"><span id=""></span></td>
  </tr>
  <tr>
    <th>上传视频</th>
    <td colspan="3">
    	<div style="background:url(img/bg-file.png) no-repeat;background-size: 100% auto; width:200px;height:200px" id="btn_video">
    	</div>
    </td>
 </tr>
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/firevideo_detail.js"></script>