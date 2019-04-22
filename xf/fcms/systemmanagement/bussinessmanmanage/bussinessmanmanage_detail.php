<?php include '../../../authen/include/page/top.php';?>
<?php
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
$libsArray=array("1"=> "是","0"=> "否");
?>
 
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<table width="1200" class="hmui-table2">
        <tr>
            <th width="15%">人员姓名</th>
            <td width="35%"><span id="buildname"></span></td>
            <th width="15%">联系电话</th>
            <td width="35%"><span id="phone"></span></td>
        </tr>
        <tr>
            <th>文化程度</th>
            <td><span id="educationDegree" ></span></td>
            <th>是否受过消防培训</th>
            <td ><span id="trainingFlag"></span></td>
         </tr>
        <tr>
            <th>是否为疏散引导员</th>
            <td><span id="evacuationGuide"></span></td>
            <th>参加培训时间</th>
            <td><span id="trainingTime"></span></td>
        </tr>
        <tr>
            <th>培训证书编号</th>
            <td><span id="certificateNum"></span></td>
            <th>领证时间</th>
            <td><span id="getTime"></span></td>
        </tr>
  </table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
  var id="<?php echo $id?>";  //将传递到js文件 :必须写的
  var yesornot_jsarry=[["1","是"],["0","否"]];
</script>
<script type="text/javascript" src="js/bussinessmanmanage_detail.js"></script>