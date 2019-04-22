
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>
 
<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">

   <div class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
<div id="tbody_content"></div>
<div class="hmui-griddetail">
<table width="1200" class="hmui-form">
 <tr><input type="hidden" id="depId"/>
    <th width="15%">巡查点</th>
    <td width="35%"><input class="hmui-input w" id="patrolPointId" patrolPointIdValue=""/></td>
    <th width="15%">巡查日期</th>
    <td width="35%"><input class="hmui-input w" id="patrolTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
  </tr>
  <tr>
    <th>巡查人姓名</th>
    <td><input class="hmui-input w" id="patrolName"/></td>
    <th>消防安全管理人姓名</th>
    <td>
	   <input class="hmui-input w" id="custodian"/>
    </td>
  </tr>
  <tr>
    <th>巡查类别</th>
    <td>
    	<select class="hmui-input w "  id="patrolType">
	    <option value="">巡查类别</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("patrolTypeCode", "")?>
	    </select>
    </td>
     <th>巡查结果</th>
    <td>
       	<select class="hmui-input w "  id="checkResultCode">
	    <option value="">巡查结果</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("checkResultCode", "")?>
	    </select>
    </td>
    </tr>
    <tr>
 
   <th>巡查内容</th>
    <td><textarea class="hmui-textarea" id="content"></textarea></td>
  </tr>
</table> 
</div>
 
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
var patrolTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("patrolTypeCode")?>;

</script>              
<script type="text/javascript" src="js/firepatrolrecod_update.js"></script>