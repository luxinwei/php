<?php include '../../../authen/include/page/top.php';?>
<?php 
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>
 
<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
 <tr>
    <th  width="15%" ><font class="cred"></font>编号</th>
    <td width="35%"> <input class="hmui-input w" id="code" /></td>
    <th  width="15%" ><font class="cred"></font>整改状态</th>
    <td width="35%">
	    <select class="hmui-select w"  id="rectificationStateCode">
	    <option value="">请选择整改状态</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("rectificationStateCode", "")?>
	    </select>  
    </td>
  </tr>
  <tr>
    <th><font class="cred"></font>颁布单位</th>
    <td><input class="hmui-input w" id="monitorCenterId"  monitorCenterIdvalue=""/></td>
    <th><font class="cred"></font>整改单位</th>
    <td><input class="hmui-input w" id="depId" /></td>
  </tr>
  <tr>
    <th><font class="cred"></font>检查时间</th>
    <td><input class="hmui-input w" id="checkTime"   checktime=""/></td>
    <th><font class="cred"></font>整改期限</th>
    <td><input class="hmui-input w" id="rectificationDeadline"  checktime=""/></td>
  </tr>
    <tr>
    <th><font class="cred"></font>文件查看</th>
     <td ><span id=" ">点击查看详情</span></td>

    <th><font class="cred"></font>违规内容</th>
    <td><input class="hmui-input w" id="illegalContent" /></td>
  </tr>
</table> 
</div>
 
</div>
<?php include '../../../authen/include/page/bottom.php';?>  
<script type="text/javascript">
var id="<?php echo $id?>";  //将传递到js文件 :必须写的
var rectificationStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("rectificationStateCode")?>; 
</script>         
<script type="text/javascript" src="js/rectificationnotice_update.js"></script>