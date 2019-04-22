<?php include '../../../authen/include/page/top.php';?>
<blockquote class="hmui-nav hmui-shadow">
	单位信息->重点部位管理
	<span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
</blockquote>
<div class="mt10 hmui-shadow p20" style="background:#FFFFFF;min-height:700px">
<table border="0" cellpadding="0" cellspacing="0" class="hmui-sheet" width="800">
<tr>
    <th width="140"></th>
    <th>姓名</th>
    <th>身份证号码</th>
    <th>电话</th>
  </tr>
  <tr>
    <th>负责人</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
<tr>
	<th width="150px;">类别</th>
	<td><input type="radio" class="hmui-radio"/>本单位使用</td>
	<td><input type="radio"  class="hmui-radio"/>本单位管理</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
  <tr>
    <th width="150px;"><font class="cred">*</font>重点部位名称</th>
    <td  ><input class="hmui-input w600"  /></td>
  </tr>
   <tr>
    <th width="150px;"><font class="cred">*</font>所属建筑</th>
    <td ><input class="hmui-input w600"  /></td>
  </tr>
<tr>
    <th width="150px;"><font class="cred">*</font>建筑名称</th>
    <td><input class="hmui-input w600"  /></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
<tr>
	<th width="150px;">耐火等级</th>
	<td><input type="radio" class="hmui-radio"/>一级</td>
	<td><input type="radio"  class="hmui-radio"/>二级</td>
	<td><input type="radio" class="hmui-radio"/>三级</td>
	<td><input type="radio"  class="hmui-radio"/>四级</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
  <tr>
    <th width="150px;"><font class="cred">*</font>所在位置</th>
    <td  ><input class="hmui-input w600" /></td>
  </tr>
   <tr>
    <th width="150px;"><font class="cred">*</font>所在层数</th>
    <td ><input class="hmui-input w600" /></td>
  </tr>
<tr>
    <th width="150px;"><font class="cred">*</font>使用性质</th>
    <td><select class="hmui-select w600"></select></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
<tr>
	<th width="150px;">确立消防安全重点部位原因</th>
	<td><input type="checkbox" class="hmui-checkbox"/>对消防安全有重大影响</td>
	<td><input type="checkbox"  class="hmui-checkbox"/>发生火灾后人员伤亡大</td>
	<td><input type="checkbox" class="hmui-checkbox"/>一旦发生火灾后损失大</td>
</tr>
<tr>
	<th width="150px;"></th>
	<td><input type="checkbox"  class="hmui-checkbox"/>已发生火灾</td>
	<td><input type="checkbox"  class="hmui-checkbox"/>其他</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
<tr>
	<th width="150px;">耐火等级</th>
	<td><input type="radio" class="hmui-radio"/>已设立</td>
	<td><input type="radio"  class="hmui-radio"/>未设立</td>
	<td><input type="radio" class="hmui-radio"/>明显</td>
	<td><input type="radio"  class="hmui-radio"/>不明显</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
<tr>
	<th width="150px;">危险源情况</th>
	<td><input type="checkbox" class="hmui-checkbox"/>易爆品</td>
	<td><input type="checkbox"  class="hmui-checkbox"/>腐蚀品</td>
	<td><input type="checkbox" class="hmui-checkbox"/>有毒品</td>
</tr>
<tr>
	<th width="150px;"></th>
	<td><input type="checkbox"  class="hmui-checkbox"/>易燃液体</td>
	<td><input type="checkbox"  class="hmui-checkbox"/>放射性物品</td>
	<td><input type="checkbox"  class="hmui-checkbox"/>压缩气体和液化气体</td>
</tr>
<tr>
	<th width="150px;"></th>
	<td><input type="checkbox"  class="hmui-checkbox"/>杂项危险物质和物品</td>
	<td><input type="checkbox"  class="hmui-checkbox"/>氧化剂和有机过氧化物</td>
	<td><input type="checkbox"  class="hmui-checkbox"/>易燃固体、自燃物品和遇湿易燃物品</td>
</tr>
<tr>
	<th width="150px;"></th>
	<td><input type="checkbox"  class="hmui-checkbox"/>其他</td>
</tr>

</table>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="800">
<tr>
	<td>消防设施情况</td>
	<td>
		<div class="fl ml10" style="background-color: #555;width: 25px;height: 15px;"></div>
		<div class="fl ml10" style="background-color: #555;width: 25px;height: 15px;"></div>
		<div class="fl ml10" style="background-color: #555;width: 25px;height: 15px;"></div>
		<div class="fl ml10" style="background-color: #555;width: 25px;height: 15px;"></div>
		<div class="fl ml10" style="background-color: #555;width: 25px;height: 15px;"></div>
		<div class="fl ml10" style="background-color: red;width: 25px;height: 15px;"></div>
	</td>
</tr>
<tr>
<td>消防安全管理措施</td>
 <td ><input class="hmui-input w600" placeholder="图标列表两个（人防）（技防）"/></td> 
</tr>
</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>           
<script type="text/javascript" src="js/key_partsdetail.js"></script>