<?php include '../../../authen/include/page/top.php';?>
<?php 
$file=Fun::request("file");
$filename=Fun::request("filename");
 
?>
<blockquote class="hmui-nav hmui-shadow">
	演练资料
 
</blockquote>
 
<div class="tc mt50">
<img src="<?php echo $file?>" >
</div>
 
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var file=""+<?php echo $file?>+"";
var filename=""+<?php echo $filename?>+"";
</script>           
<script type="text/javascript" src="js/unit_pic.js"></script>