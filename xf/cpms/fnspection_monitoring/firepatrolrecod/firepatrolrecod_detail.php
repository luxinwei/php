<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");
?>
 
<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
    <div class="fr">
         <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table2">
 <tr><input type="hidden" id="depId"/>
    <th width="15%">巡查点</th>
    <td width="35%"><span id="patrolPointId"></span></td>
    <th width="15%">巡查日期</th>
    <td width="35%"><span id="patrolTime"></span></td>
  </tr>
  <tr>
    <th>巡查人姓名</th>
    <td><span id="patrolName"></span></td>
    <th>消防安全管理人姓名</th>
    <td>
	   <span id="custodian"></span>
    </td>
  </tr>
  <tr>
    <th>巡查类别</th>
    <td><span id="patrolType"></span></td>
    <th>巡查结果</th>
    <td>
    <span id="checkResultCode"></span>
    </td>
    </tr>
    <tr>
        <th>巡查内容</th>
   		 <td> <span id="content"></span></td>
 
  </tr>
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?> 
<script type="text/javascript">
var id="<?php echo $id?>";
var patrolTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("patrolTypeCode")?>;
var checkResultCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("checkResultCode")?>;

</script>         
<script type="text/javascript" src="js/firepatrolrecod_detail.js"></script>