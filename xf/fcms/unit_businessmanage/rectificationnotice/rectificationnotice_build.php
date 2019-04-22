<?php include '../../../authen/include/page/top.php';?>



<div align="center" style="background:#FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
  <span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn ml10"/>
 		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>

	</span>
  <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="1200">
  <tr>
    <th width="160px;"><font class="cred"></font>编号</th>
    <td><input class="hmui-input w" id="code"/></td>
    <th  width="150px;"><font class="cred"></font>文件上传</th>
    <td><input class="hmui-btn" value="文件上传" type="button" style="width:220px"/></td>
  </tr>
  <tr>
    <th><font class="cred"></font>颁布单位</th>
    <td><input class="hmui-input w" id="monitorCenterId"/></td>
    <th><font class="cred"></font>整改单位</th>
    <td>
    <input class="hmui-input w hand" id="depId" depIdValue="" value="" />
    </td>
  </tr>
  <tr>
    <th><font class="cred"></font>检查时间</th>
    <td><input class="hmui-input w" id="checkTime"/></td>
    <th><font class="cred"></font>整改期限</th>
    <td><input class="hmui-input w" id="rectificationDeadline"/></td>
  </tr>
    <tr>
    <th><font class="cred"></font>整改状态</th>
    <td>
     <select class="hmui-select w"  id="rectificationStateCode">
    <option value="">请选择整改状态</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("rectificationStateCode", "")?>
    </select>
    </td>
  </tr>
  <tr>
    <th><font class="cred"></font>违规内容</th>
    <td colspan="3"><textarea rows="4" class="hmui-textarea w pl10" id="illegalContent"></textarea></td>
  </tr>
   <tr>
    <td></td>
   <td></td>
  </tr>
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/rectificationnotice_build.js"></script>