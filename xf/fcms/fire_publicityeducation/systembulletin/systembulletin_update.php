<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");
?>
<blockquote class="hmui-nav hmui-shadow">
 
	<span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
</blockquote>



<div align="center" style="background-color:#FFFFFF;min-height:700px" class="mt10 p20 hmui-shadow">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
 <tr>
    <th><font class="cred">*</font>公告内容</th>
    <td><input  class="hmui-input" id="content"/></td>
    <th><font class="cred">*</font>公告范围</th>
      <td>
    	 <select class="hmui-input w"  id=bulletinAreaCode>
	    <option value="">请选择公告范围</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("bulletinAreaCode", "")?>
	    </select> 
     </td>
  </tr>
  <tr>
    <th>公告内容范围值</th>
    <td><input  class="hmui-input" id="scopeValue"/></td>
    <th>公告保存状态</th>
    <td>
      <select class="hmui-input w"  id=dataStateCode>
	    <option value="">请选择保存状态</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("dataStateCode", "")?>
	    </select> 
    </td>
    </tr>
    <tr>
    <th>输入人姓名</th>
    <td><input  class="hmui-input" id="createUser"/></td>
    <th>创建时间</th>
    <td><input  class="hmui-input" id="createTime"/></td>
   </tr>
 
  </table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>   
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var bulletinAreaCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("bulletinAreaCode")?>;  
var dataStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("dataStateCode")?>;  

 </script>        
<script type="text/javascript" src="js/systembulletin_update.js"></script>