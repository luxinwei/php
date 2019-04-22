<?php include '../../../authen/include/page/top.php';?>
<?php 
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>



<div align="center" style="background:#FFFFFF;min-height:750px;"  class="p20 mt10 hmui-shadow">
    <div class="fr">
         <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-table2">
   <tr>
       <th width="18%">首次报警时间</th>
    <td width="32%"><span id="firstAlarmTime"></span></td>
    <th width="18%">受理时间</th>
    <td width="32%"><span id="acceptTime"></span></td>
  </tr>
 <tr>
    <th>受理结束时间</th>
    <td><span id="acceptEndTime"></span></td>
    <th>信息类型</th>
    <td><span id="acceptedTypeCode"></span></td>
  </tr>
  <tr>
      <th>信息描述</th>
    <td><span id="description"></span></td>
    <th>处理结果</th>
    <td><span id="handleResult"></span></td>
  </tr>
  <tr>
     <th>受理员姓名</th>
    <td><span id="acceptUser"></span></td>
    <th>消息确认</th>
    <td><span id="acceptedConfirmCode"></span></td>
  </tr>
  <tr>    
  <th>向消防通信指挥中心报告时间</th>
    <td><span id="reportTime"></span></td>

    <th>消防通信指挥中心反馈确认时间</th>
    <td><span id="reportFeebackTime"></span></td>
  </tr>
  <tr>
    <th>消防通信指挥中心受理员姓名</th>
    <td><span id="monitorUserName"></span></td>

    <th>消防通信指挥中心接管处理情况</th>
    <td><span id="monitorHandleInfo"></span></td>
  </tr>
</table> 
</div>

</div>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var acceptedTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedTypeCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var acceptedConfirmCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("acceptedConfirmCode")?>;
</script>     
<script type="text/javascript" src="js/falsepositiveslist_detail.js"></script>