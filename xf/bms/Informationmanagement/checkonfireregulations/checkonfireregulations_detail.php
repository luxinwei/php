<?php include '../../../authen/include/page/top.php';?>
<?php 
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>




<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
  <span  class="fr">
		<input type="button" value="编辑" id="btn_update" class="hmui-btn"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
  <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
  <tr>
    <th width="15%;">法规名称</th>
    <td width="35%;"><span id="statutename"></span></td>
    <th width="15%;">法规类别</th>
    <td width="35%;"><span id="fireLawCode"></span></td>
  </tr>
  <tr>
    <th>颁布机关</th>
    <td><span id="promulgateOffice"></span></td>
    <th>批准机关</th>
    <td><span id="approveOffice"></span></td>
  </tr>
  <tr>
    <th>法规内容</th>
    <td><span id="promulgateNo"></span></td>
        <th>颁布文号</th>
    <td><span id="content"></span></td>
  </tr>
  <tr>
    <th>颁布日期</th>
    <td><span id="promulgateDate"  ></span></td>
    <th>实施日期</th>
    <td><span id="implementDate"></span></td>
  </tr>
  <tr>
    <th>输入人姓名</th>
    <td><span id="createUser"></span></td>
  </tr>
 
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>   
<script>
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var fireLawCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("fireLawCode")?>;
</script>      
<script type="text/javascript" src="js/checkonfireregulations_detail.js"></script>