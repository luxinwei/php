<?php include '../../../authen/include/page/top.php';?>
<?php
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
    <div id="detail"></div>
<table width="1200" class="hmui-table2">
     <tr>
    <th width="15%"><font class="cred"></font>单位名称</th>
    <td width="35%"><span id="depName"></span></td>
        <th width="15%"><font class="cred"></font>巡查内容</th>
    <td width="35%"><span id="content"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>巡查部位</th>
    <td><span id="patrolPointId"></span></td>
     <th><font class="cred"></font>巡查人姓名</th>
    <td><span id="patrolName"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>巡查日期</th>
    <td><span id="patrolTime"></span></td>
	<th><font class="cred"></font>巡查类别</th>
    <td><span id="patrolTypeCode"></span>
    </td>
    
  </tr>
  <tr>
    <th><font class="cred"></font>消防安全管理人姓名</th>
    <td><span id="custodian"></span></td>
  	<th><font class="cred"></font>巡查人结果</th>
    <td><span id="checkResultCode"></span></td>
  </tr>
 
</table>
 </div>
<?php include '../../../authen/include/page/bottom.php';?>   
<script type="text/javascript">
    var id="<?php echo $id?>";  //将传递到js文件 :必须写的
    var patrolTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("patrolTypeCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
    var checkResultCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("checkResultCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
    
</script>     
<script type="text/javascript" src="js/firepatrolrecod_detail.js"></script>