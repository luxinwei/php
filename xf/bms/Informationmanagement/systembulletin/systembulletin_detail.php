<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");
?>


<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <span  class="fr">
		<input type="button" value="编辑" id="btn_edit" class="hmui-btn"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
<table width="1200" class="hmui-table2">
      <tr>
    <th width="15%">公告范围</th>
    <td width="35%"><span id="bulletinAreaCode"></span></td>
    <th width="15%">公告范围值</th>
    <td width="35%"><span id="scopeValue"></span></td>
   </tr>
    <tr>
        <th>公告状态</th>
    <td><span id="dataStateCode"></span></td>
   <th>输入人姓名</th>
    <td><span id="createUser"></span></td>
  </tr>
  <tr>
   <th>输入日期</th>
    <td><span id="createTime"></span></td>
  </tr>
  <tr>
     <th>公告内容</th>
     <td colspan="3"><div id="content" style="height: 300px; text-align: left;text-indent: 2em"></div></td>
  </tr>
</table>
</div>
<script type="text/javascript">
var bulletinAreaCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("bulletinAreaCode")?>;  
var dataStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("dataStateCode")?>;  
var id="<?php echo $id?>"
</script>  
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/systembulletin_detail.js"></script>