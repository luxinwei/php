<?php include '../../../authen/include/page/top.php';?>
<?php 
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>
<blockquote class="hmui-nav hmui-shadow">
审核
</blockquote>



<div align="center" style="background-color: #FFFFFF;min-height:700px" class="mt10 p20 hmui-shadow">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="800">
  <tr>
    <th width="160px;">法规名称</th>
    <td><span id="statutename"></span></td>
    <th  width="150px;">法规类别</th>
    <td><span id="fireLawCode"></span></td>
  </tr>
  <tr>
    <th>颁布机关</th>
    <td><span id="promulgateOffice"></span></td>
    <th>批准机关</th>
    <td><span id="approveOffice"></span></td>
  </tr>
  <tr>
    <th>颁布文号</th>
    <td><span id="promulgateNo"></span></td>
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
  <tr>
    <th></th>
    <td colspan="3"><textarea rows="4" cols="92" class="hmui-textarea" id="content"></textarea></td>
  </tr>
</table>
	<input type="button" value="不通过" id="btn_go" class="hmui-btn"/>
	<input type="button" value="通过" id="btn_back" class="hmui-btn"/>
</div>
<?php include '../../../authen/include/page/bottom.php';?>     
<script>
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var fireLawCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("fireLawCode")?>;
</script>         
<script type="text/javascript" src="js/checkonfireregulations_pic.js"></script>