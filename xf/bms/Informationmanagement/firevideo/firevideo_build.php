<?php include '../../../authen/include/page/top.php';?>



<div align="center" style="background-color: #FFFFFF;min-height: 750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
    	<input type="button" value="保存" id="btn_save" class="hmui-btn ml10"/>
 		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
        
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
 <tr>
    <th width="15%">常识名称</th>
    <td width="35%"><input class="hmui-input w" id="commonname" maxlength="100"/></td>
    <th width="15%">输入人姓名</th>
    <td width="35%"><input  class="hmui-input w" id="createUser" maxlength="20" /></td>
  </tr>
  <tr>
    <th>视频简介</th>
    <td colspan="3">
    	<textarea rows="4" class="hmui-textarea w pl10" id="content" placeholder="请输入文章内容" maxlength="1000"></textarea>
    </td>
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
<script type="text/javascript" src="js/firevideo_build.js"></script>