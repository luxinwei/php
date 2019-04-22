
<?php include '../../../authen/include/page/top.php';?>
<?php 
$libsArray=array("1"=> "本单位管理","2"=> "本单位使用");
?>
  <style>
ul li{float: left; margin-left: 15px;}
</style>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
	<div class="fr">
		<input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
		<input type="button" value="重置" id="btn_reset" class="hmui-btn ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-form mb10" >
<caption>负责人信息</caption>  
<tr>
    <th width="14%"></th>
    <th>姓名</th>
    <th>身份证号码</th>
    <th>电话</th>
  </tr>
  <tr>
    <th width="15%">负责人</th>
    <td><input class="hmui-input w"  id="chargePersonName"  min ="1" max ="50"/></td>
    <td><input class="hmui-input w"  id="chargePersonId" min ="18" max ="18"/></td>
    <td><input class="hmui-input w"  id="chargePersonTel" min ="3" max ="15"/></td>
  </tr>
 </table>
<table width="1200" class="hmui-form" >
<caption>重点部位信息</caption>
		<tr>
		<input type="hidden" id="depId"/>
		<th width="14%">建筑面积</th>
		<td width="36%"><input class="hmui-input w" id="overallFloorage" placeholder="（㎡）" /> </td>
		 <th width="15%"><font class="cred">*</font>重点部位名称</th>
    	<td width="35%" ><input class="hmui-input w" id="name" min ="1" max ="100"/></td>
	</tr>
   <tr>
    <th><font class="cred">*</font>所属建筑</th>
    <td><input class="hmui-input w hand" id="buildingId" buildIdValue=""  readonly="readonly"/></td>
     <th><font class="cred">*</font>使用性质</th>
    <td>
    <select class="hmui-input w"  id=buildingUseKindCode>
    <option value="">请选择使用性质</option>
    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("buildingUseKindCode", "")?>
    </select>   
    </td>
  </tr>
 
  <tr>
    <th ><font class="cred">*</font>所在位置</th>
    <td  ><input class="hmui-input w" id="position" min ="1" max ="200"/></td>
    <th  ><font class="cred">*</font>所在层数</th>
    <td ><input class="hmui-input w" id="floor" placeholder="（层）"/> </td>
  </tr>
   <tr>

  </tr>
<tr>
	<th width="15%"><font class="cred">*</font>类别</th>
	<td width="35%"> 
		<?php echo CodeUtil::getInstance()->getLibsRadioBox("dutyCode","",$libsArray);?>
	</td >
    <th><font class="cred">*</font>防火标志设立情况</th>
	<td>
		 <?php echo DicationaryUtil::getInstance()->getCodeRadioBox("fireproofSignCode", "fireproofSignCode","","")?>
	</td>
 </tr>
 <tr>
	 <th >耐火等级</th>
	 <td>
		 <?php echo DicationaryUtil::getInstance()->getCodeRadioBox("buildingResistFireCode", "buildingResistFireCode","","")?>
	 </td>
 </tr>
<tr>
		<th><font class="cred">*</font>确立消防安全重点部位原因</th>
		<td>
			 <?php echo DicationaryUtil::getInstance()->getCodeCheckBox("establishReasonCode", "establishReasonCode","","")?>
		</td>
		<th><font class="cred">*</font>危险源情况</th>
		<td>
			<?php echo DicationaryUtil::getInstance()->getCodeCheckBox("dangerSourceCode", "dangerSourceCode","","")?>
		</td>
</tr>

 
 
<tr>
	<th>消防设施情况</th>
 <td >
 	<ul>
 		 <li class="hand"><img alt="图片不存在" title="消防电话" src="img/icon_0000.png"></li>
 		<li class="hand"><img alt="图片不存在" title="电梯管理" src="img/icon_0001.png"></li>
 		<li class="hand"><img alt="图片不存在" title="配电系统" src="img/icon_0002.png"></li>
 		<li class="hand"><img alt="图片不存在" title="应急照明" src="img/icon_0003.png"></li>
 		<li class="hand"><img alt="图片不存在" title="防火门帘" src="img/icon_0004.png"></li>
 		<li class="hand"><img alt="图片不存在" title="防烟排烟" src="img/icon_0005.png"></li>
 		<li class="hand"><img alt="图片不存在" title="消防栓灭火" src="img/icon_0006.png"></li>
 		<li class="hand"><img alt="图片不存在" title="消防给水系统" src="img/icon_0007.png"></li>
 		<li class="hand"><img alt="图片不存在" title="火灾自动报警" src="img/icon_0008.png"></li>
 		<li class="hand"><img alt="图片不存在" title="自动喷水" src="img/icon_0009.png"></li>
 		<li class="hand"><img alt="图片不存在" title="广播" src="img/icon_0010.png"></li>
 		<li class="hand"><img alt="图片不存在" title="用电监测" src="img/icon_0011.png"></li>
 		<li class="hand"><img alt="图片不存在" title="灭火器" src="img/icon_0012.png"></li>
 		
  	</ul> 
 </td> 
<th>消防安全管理措施</th>
 <td>
 	<ul>
 		<li class="hand"> <img alt="图片不存在" title="机防" src="img/240509723272531665.png" id="img_jf"></li>
 		<li class="hand"> <img alt="图片不存在" title="人防" src="img/478658509669161723.png" id="img_rf"></li>
   	</ul>
 </td> 
</tr>
</table>
</div>

 
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">


</script>           
<script type="text/javascript" src="js/key_parts_build.js"></script>