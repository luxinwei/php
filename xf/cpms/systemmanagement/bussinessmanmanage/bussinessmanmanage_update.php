<?php include '../../../authen/include/page/top.php';?>
<?php
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
$libsArray=array("1"=> "是","0"=> "否");
?>
 
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<table width="1200" class="hmui-form w" id="forms">
    <tr><input type="hidden" id="userId">
      <th width="15%"><font class="cred">*</font>人员名称</th>
      <td width="35%"><input class="hmui-input w" id="name"/></td>
      <th width="15%"><font class="cred">*</font>人员手机号</th>
      <td width="35%"><input class="hmui-input w" id="phone"/></td>
    </tr>
    <tr>
      <th><font class="cred">*</font>文化程度不</th>
      <td><input class="hmui-input w" id="educationDegree"/></td>
      <th><font class="cred">*</font>是否受过消防培训</th>
      <td>
	    <select class="hmui-select w "  id="trainingFlag">
	    <option value="">请选择</option>
  			 <?php echo CodeUtil::getInstance()->getLibsSelectOption("",$libsArray);?>
	    </select>
     </td>
    </tr>
    <tr>
      <th>参加消防培训时间</th>
      <td><input class="hmui-input w " id="trainingTime"/></td>
      <th>消防培训领证时间</th>
      <td><input class="hmui-input w" id="getTime"/></td>
    </tr>
      <tr>
      <th>培训证书长度</th>
      <td><input class="hmui-input w" id="certificateNum"/></td>
      <th><font class="cred">*</font>是否为消防引导员</th>
      <td>
	    <select class="hmui-select w"  id="evacuationGuide">
	    <option value="">请选择</option>
 		  <?php echo CodeUtil::getInstance()->getLibsSelectOption("",$libsArray);?>
	    </select>
     </td>
    </tr>
  </table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
  var id="<?php echo $id?>";  //将传递到js文件 :必须写的
  var yesornot_jsarry=[["1","是"],["0","否"]];
  
 </script>
<script type="text/javascript" src="js/bussinessmanmanage_update.js"></script>