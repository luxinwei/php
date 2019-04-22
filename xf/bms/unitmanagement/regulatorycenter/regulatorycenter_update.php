<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");
$commitData="{\"id\":\"8\",\"name\":\"F监控中心\",\"area_id\":\"1\",\"position\":\"113.574443,34.813479\",\"telephone\":\"15987485840\",\"charge_person\":\"user1\",\"charge_phone\":\"15987485840\",\"monitor_center_rank_code\":\"2\",\"address\":\"郑州\"}";

?>
<blockquote class="hmui-nav hmui-shadow">
	指挥中心->中心详情

</blockquote>



<div align="center" style="background-color: #FFFFFF;min-height:750px" class="hmui-shadow p20">
  <span  class="fr">
		<font>联网状态：联网</font>
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="1200" id="detail">
  <tr>
    <th  width="150px"><font class="cred">*</font>中心名称</th>
    <td><input class="hmui-input w" id="centername"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>所属区域</th>
    <td><input class="hmui-input w" id="address"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>中心详地址</th>
    <td><input class="hmui-input w300 " id="position"/>
    <input class="hmui-btn" type="button"  value="打开地图" id="btn_map"/>
    
    
    </td>
  </tr>
    <tr>
    <th><font class="cred">*</font>联系电话</th>
    <td><input class="hmui-input w" id="telephone"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>中心负责人姓名</th>
    <td><input class="hmui-input w" id="chargePerson"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>中心负责人联系方式</th>
    <td><input class="hmui-input w" id="chargePhone"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>中心级别</th>
    <td><input class="hmui-input w" id="monitorCenterRankCode"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>上级中心名称</th>
    <td><input class="hmui-input w" /></td>
  </tr>
 
    <tr>
    <th><font class="cred">*</font>areaId</th>
    <td><input class="hmui-input w" id="areaId"/></td>
  </tr>
    <tr>
    <th><font class="cred">*</font>冗余备份中心名称</th>
    <td><input class="hmui-input"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>状态</th>
    <td><select class="hmui-select w200"></select></td>
  </tr>
    <tr>
    <td></td>
    <td></td>
  </tr>
   
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
</script>            
<script type="text/javascript" src="js/regulatorycenter_update.js"></script>