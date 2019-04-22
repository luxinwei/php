<?php include '../../../manage/include/page/top_ext.php';?>
<?php include '../../../com/core/fim/FimOrg.class.php';?>
<?php FimOrg::getInstance()->createRoot();?>
<?php FimOrg::getInstance()->updateMemberNum();?>

<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript" >
var type_array=<?php echo(CodeUtil::getInstance()->getCodeJsArray("FIM_ORGTYPE"));?>;
var org_kind_array=<?php echo(CodeUtil::getInstance()->getCodeJsArray("FIM_ORGKIND"));?>;
var orgGroupsArray=<?php echo(orgGroupsArray());?>;
</script>

<script type="text/javascript" src="js/fimorg_list.js"></script>

<?php 
function orgGroupsArray(){
	$groups=DB::getInstance()->execQuery("select * from fim_group");
	$orgids=DB::getInstance()->execQuery("select ORGID from fim_group group by ORGID");
	$jsArray_mid="";
	foreach ($orgids as $orgidObj){
		$orgid=$orgidObj["ORGID"];
		$grouptitles="";
		foreach ($groups as $groupObj){
			if($groupObj["ORGID"]==$orgid){
				if($grouptitles!="")$grouptitles.=",";
				$grouptitles.="[".$groupObj["TITLE"]."]";
			}
		}
	    if(strcmp($jsArray_mid,"")!=0)$jsArray_mid.=",";
		$jsArray_mid.="['".$orgid."','".$grouptitles."']";
	}
	$jsArray="[".$jsArray_mid."]";
	return $jsArray;
}

?>