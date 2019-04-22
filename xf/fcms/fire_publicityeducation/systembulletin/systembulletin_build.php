<?php include '../../../authen/include/page/top.php';?>

<div align="center" style="background-color:#FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
<span  class="fr">
	<input type="button" value="保存" id="btn_save" class="hmui-btn ml10"/>
	<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
</span>
<div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="1200">
 <tr>
    <th width="15%"><font class="cred">*</font>公告内容</th>
    <td width="35%"><input  class="hmui-input w" id="content"/></td>
    <th width="15%"><font class="cred">*</font>公告范围</th>
      <td width="35%">
    	 <select class="hmui-select w"  id=bulletinAreaCode>
	    <option value="">请选择公告范围</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("bulletinAreaCode", "")?>
	    </select> 
     </td>
  </tr>
  <tr>
    <th>公告内容范围值</th>
    <td><input  class="hmui-input w" id="scopeValue"/></td>
    <th>公告保存状态</th>
    <td>
      <select class="hmui-select w"  id=dataStateCode>
	    <option value="">请选择保存状态</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("dataStateCode", "")?>
	    </select> 
    </td>
    </tr>
    <tr>
    <th>输入人姓名</th>
    <td><input  class="hmui-input w" id="createUser"/></td>
    <th>创建时间</th>
    <td><input  class="hmui-input w" id="createTime"/></td>
   </tr>
 
  </table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/systembulletin_build.js"></script>