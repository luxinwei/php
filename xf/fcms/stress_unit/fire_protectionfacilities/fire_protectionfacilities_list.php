<?php include '../../../authen/include/page/top.php';?>
<div class="mt10"></div>
<div class="hmui-shadow" style="background:#FFFFFF">
<form  id="myform" class="alert_info">
	<input name="name" id="name" placeholder="请输入设施名称" class="hmui-input3 w300"/>

	<span>设施系统</span>
	<select class="hmui-input3 w200"  id="systemForm" name="systemForm">
	    <option value="">请选择设施系统</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("systemForm", "")?>
    </select>
    <span>设施类型</span>
    <select class="hmui-input3 w200"  id="deviceType" name="deviceType">
	    <option value="">请选择设施系统</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("deviceType", "")?>
    </select>
	<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
 </form>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-grid " width="100%">
	<tr>
		<th>设施名称</th>
		<th>类别</th>
 		<th>设施系统形式 </th>
		<th>楼层号</th>
		<th>设施服务状态</th>
		<th>生产单位名称</th>
		<th>所属单位</th>
		<th class="tc" width="100">操作</th>
	</tr>
<tbody id="tbody_content"></tbody>                                                                        
</table>
	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
	</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var runStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("runStateCode")?>;  //列表select monitorCenterRankCode：查询到的字段名称
var deviceTypeCode_jsarray=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("deviceType")?>;
var systemForm_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("systemForm")?>;
var serviceStateCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("serviceStateCode")?>;</script>           
<script type="text/javascript" src="js/fire_protectionfacilities_list.js"></script>