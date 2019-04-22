<?php include '../../../authen/include/page/top.php';?>
<?php 
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>



<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="反馈" id="btn_edit" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<div id="tbody_content" class="w800"></div>

<table width="1200" class="hmui-table2">
    <tr>
    <th width="15%"><font class="cred"></font>编号</th>
    <td width="35%"><span id="code"></span></td>
    <th width="15%"><font class="cred"></font>整改状态</th>
    <td width="35%"><span id="rectificationStateCode"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>颁布单位</th>
    <td><span id="monitorCenterId"></span></td>
    <th><font class="cred"></font>整改单位</th>
    <td><span id="depId"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>检查时间</th>
    <td><span id="checkTime"></span></td>
    <th><font class="cred"></font>整改期限</th>
    <td><span id="rectificationDeadline"></span></td>
  </tr>
    <tr>
    <th><font class="cred"></font>文件查看</th>
    <td ><span id=" ">点击查看详情</span></td>
    <th><font class="cred"></font>违规内容</th>
    <td ><span id="illegalContent"></span></td>
  </tr>
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>  
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var rectificationStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("rectificationStateCode")?>; 
 </script>         
<script type="text/javascript" src="js/rectificationnotice_detail.js"></script>