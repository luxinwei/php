<?php include '../../../authen/include/page/top.php';?>

<?php 
$id=Fun::request("id");
?>


<div align="center" style="background-color:#FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
 <tr>
    <th>公告范围</th>
    <td>
        	 <select class="hmui-select w"  id="bulletinAreaCode">
	    <option value="">请选择公告范围</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("bulletinAreaCode", "")?>
	    </select> 
     </td>
    <th>公告范围值</th>
    <td><input  class="hmui-input w" id="scopeValue"/></td>
  </tr>
  <tr>
  <th>公告状态</th>
    <td>
       <select class="hmui-selec w"  id="dataStateCode">
	    <option value="">请选择公告状态</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("dataStateCode", "")?>
	    </select> 
    </td>
   <th>输入人姓名</th>
    <td><input class="hmui-input w" id="createUser"/></td>
  </tr>
    <tr>
   <th>输入日期</th>
    <td><input class="hmui-input w" id="createTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
  </tr>
  
  <tr>
  	<th>公告内容</th>
    <td colspan="3"><textarea  class="hmui-textarea w" id="content" rows="10" style="text-align: left;text-indent: 2em""></textarea></td>
  </tr>
  </table>

</div>
<script type="text/javascript">
var bulletinAreaCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("bulletinAreaCode")?>;  
var dataStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("dataStateCode")?>;  
var id="<?php echo $id?>"
</script>  
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/systembulletin_update.js"></script>