
<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
$partId=Fun::request("partId");  
 
?>
<body style="background:#FFFFFF;">
<div align="center" style="background:#FFFFFF;min-height:650px;"  class="p20 ">
<div style="background: url(img/chose.png) no-repeat center;height: 500px;">

</div>
 </div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var state_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingFireDangerCode")?>;
var id="<?php echo $id?>";
var partId="<?php echo $partId?>";
var state_jsarry=[['0','未处理'],['1','已处理']];
</script>           
<script type="text/javascript" src="js/electricfiremonitor_detail9.js"></script>
</body>