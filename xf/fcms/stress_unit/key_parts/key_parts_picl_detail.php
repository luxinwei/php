<?php include '../../../authen/include/page/top.php';?>
<?php 
$excludeList=array("1"=> "本单位使用","0"=> "本单位管理");
echo CodeUtil::getInstance()->getCodeRadioBox($excludeList,"");
?>
<blockquote class="hmui-nav hmui-shadow">
	单位信息->重点部位管理
	<span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
</blockquote>
	<div align="center" class="mt10 p10 hmui-shadow" style="background:#FFFFFF">
	<table border="0" cellpadding="0" cellspacing="0" class="hmui-sheet" width="800px">
		<tbody id="detail"></tbody>
		</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var buildingUseKindCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingUseKindCode")?>;

var state_jsarray=[['1','本单位使用'],['0','本单位管理']];
</script>           
<script type="text/javascript" src="js/key_parts_picl_detail.js"></script>