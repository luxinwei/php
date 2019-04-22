<?php include '../../../authen/include/page/top.php';?>
<?php 
$file=Fun::request("file");
$filename=Fun::request("filename");
 
?>
<blockquote class="hmui-nav hmui-shadow">
	 
	<span  class="fr">
		<input type="button" value="返回" id="btn_close" class="hmui-btn"/>
	</span>
</blockquote>
 
 
<div>
<table class="tc">
	<tr>
		<td><span><?php echo $filename;?></span></td>
	</tr>
	<tr>
		<td><img  src="<?php echo $file; ?>"/></td>
	</tr>
</table>
 	
  
</div>
<?php include '../../../authen/include/page/bottom.php';?>
 
<script type="text/javascript">
 
</script>          
<script type="text/javascript" src="jscommandcentre_pic.js"></script>



  
 

 
