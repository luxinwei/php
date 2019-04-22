<?php include '../../../manage/include/page/top.php';?>
<?php include '../../../com/core/ims/ImsNewsitems.class.php';?>
<?php
$groupid=Fun::request("groupid");
$fimGroup= new FimGroup();
$group=$fimGroup->getOne($groupid);
$valueList=$group["NEWITEMSLIST"];
?>
<script  type="text/javascript" src="../../../etc/js/ztree/jquery.ztree.all.min.js"></script>
<link   rel="stylesheet" type="text/css" href="../../../etc/js/ztree/zTreeStyle.css" />
<form name="myform">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="box_keep">
<caption><B>角色：<?php echo $group["TITLE"]?></B></caption>
<tr>
<td>
<ul id="treeDemo" class="ztree"></ul>
<script type="text/javascript" >
var zNodes=<?php echo(ImsNewsitems::getInstance()->getZtreeCheckJson($valueList));?>
</script>
</td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="box_keep">
<tfoot>
<tr>
    <td>
    <input class="button_paleblue4" type="button" name="ok" value="确 定" onclick="checkform()" />
    <input class="button_paleblue4" type="button" name="ok" value="返回" id="backhistory"/>
    </td>
    </tr>
</tfoot>
</table>
</form>
 <script type="text/javascript">
	var groupid="<?php echo $groupid; ?>";
</script>

<?php include '../../../manage/include/page/bottom.php';?>
<script type="text/javascript" src="js/newsitems_list.js"></script>