<?php include '../../../authen/include/page/top.php';?>
<?php 
$file=Fun::request("file");
$filename=Fun::request("filename");
 echo  "222".$filename,$file;
 ?>
<blockquote class="hmui-nav hmui-shadow">
	单位总平面图
	<span  class="fr">
		<input type="button" value="返回" id="btn_close" class="hmui-btn hmui-btn-primary ml10"/>
	</span>
</blockquote>
 
<div class="tc mt50">
<table>
 
<tr>
	 <td><span>sss<?php echo $filename?></span></td>
</tr>
<tr>
	 <td><img src="<?php echo $file?>" ></td>
</tr>

</table>
<img src="<?php echo $file?>" >
</div>
 
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
 
</script>           
<script type="text/javascript" src="js/cameramonitor_pic.js"></script>