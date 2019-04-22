 
<?php include '../../../authen/include/page/top.php';?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-form">
 <tr>
    <th width="15%"><font class="cred">*</font>建筑名称</th>
    <td width="35%"><input class="hmui-input w hand" id="buildingId" buildIdValue="" readonly="readonly"/></td>
    <th  width="15%"><font class="cred">*</font>隧道位置</td>
    <td width="35%"><input  class="hmui-input w " id="position"/></td>     
  </tr>
 
<tr>
  	<th  ><font class="cred">*</font>隧道高度</td>
    <td><input  class="hmui-input w"  id="height" placeholder="（m，精确至小数点后两位）"/></td>
    <th  ><font class="cred">*</font>隧道长度</td>
    <td><input  class="hmui-input w"  id="length" placeholder="（m，精确至小数点后两位）"/></td>
  </tr>
</table>
</div>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/tunnel_build.js"></script>