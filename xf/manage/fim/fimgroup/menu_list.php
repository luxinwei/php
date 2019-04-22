<?php include '../../../manage/include/page/top.php';?>
<?php include '../../../com/core/fim/FimMenuitem.class.php';?>
<?php
$rootPath = ParaUtil::getInstance()->getRoot();
$groupid=Fun::request("groupid");
$userSessionMenuList=$sessionManageUserArray["MENULIST"];
$userSessionLevel=Fun::getInt($sessionManageUserArray["LEVEL"], 0);
?>
 <script type="text/javascript">
	var groupid="<?php echo $groupid; ?>";
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="box_keep" style="background-color:#F0F4FB" >
<?php
$menuList="";
$group=FimGroup::getInstance()->getOne($groupid);
$menuList=FimGroup::getInstance()->getMenuListByGroup($groupid);
//--------------------------------------------------------------
$listAll=FimMenuitem::getInstance()->getAllList();
$listTree=FimMenuitem::getInstance()->listFimMenuTree();
$content ="";
foreach($listTree as $treeInfo){
	$menu= FimMenuitem::getInstance()->getOneByAll($treeInfo["code"], $listAll);
	if($menu["VALID"]==0)continue;
	if($userSessionLevel!=-1){
		if(substr_count($userSessionMenuList,$menu["ID"])==0)continue;
	}
	//级别
	$levelstr="";
	$level=strlen($treeInfo["position"])/3;
	for($i=2;$i<$level;$i++)$levelstr.="|____";
	$levelstr.="\n\t<font color='#999999'>".$levelstr."</font>";
	//复选框
	$checkbox_str="";
	$checkedStr1="";
	if(substr_count($menuList,$menu["ID"])>0)$checkedStr1="checked";
	
	$checkbox_str.="<input type=\"checkbox\" ".$checkedStr1." name=\"menuListInfo\" value=\"".$treeInfo["code"]."\"  parentValue=\"".$treeInfo["parentCode"]."\"   onclick=\"selectParentCheckBox(this);\" />" ;
	//权限复选框
	$qx_str="";
	$qxbz=trim($menu["QXBZ"]);
	if($qxbz!=""){
		$qxbz_flag=explode(",",$qxbz);
		$j=0;
		foreach($qxbz_flag as $flag){
			
			$flagArray=explode("|",$flag);
			
			if(count($flagArray)==2){
				if(substr_count($sessionMenuList,$menu["ID"]."|".$flagArray[0])==0&&$userSessionLevel!=-1)continue;
				$checkedStr2="";
				if(substr_count($menuList,$menu["ID"]."|".$flagArray[0])>0)$checkedStr2="checked";
				$qx_str.="\n\t<input type=\"checkbox\" ".$checkedStr2."  name=\"menuListInfo\"  value=\"".$menu["ID"]."|".$flagArray[0]."\" parentValue=\"".$menu["ID"]."\"  onclick=\"selectChildCheckBox(this);selectParentCheckBox(this);\"/>".$flagArray[1];
				$j++;
				if(($j%10)==0)$qx_str.="<br>";
			}
		}
	}
	$qx_str.="";
	$content.="<tr>";
	$content.="<td width=\"200\">".$levelstr.$checkbox_str.$treeInfo["title"]."</td>";
	$content.="<td>".$qx_str."</td>";
	$content.="</tr>";
}

?>
</table>
<form name="myform">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="box_keep">
<caption  class="alert_info"><B>角色：<?php echo $group["TITLE"]?></B></caption>
<?php echo $content ?>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="box_keep">
<tfoot>
<tr>
    <td>
    <input class="button_paleblue4" type="button" name="ok" value="确 定" onclick="checkform()" />
    <input class="button_paleblue4" type="reset" name="reset" value="重 置" />
    <input class="button_paleblue4" type="button" name="ok" value="返回" id="backhistory"/>
    </td>
    </tr>
</tfoot>
</table>
</form>
<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript" src="js/menu_list.js"></script>