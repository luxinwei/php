<?php include '../../../authen/include/page/top.php';?>
<?php 
$file=Fun::request("file");
$filename=Fun::request("filename");
 
 echo $filename;
?>
<blockquote class="hmui-nav hmui-shadow">
	 
	<span  class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</span>
</blockquote>
 
 
<div>
 	
 	<input type="file" name="file" onchange="imgPreview(this)"  id="btn_update"/> <br>
    <input id="file_base64" type="hidden"/><br>
    <input id="file" type="hidden"/><br>
 
 
     <div>
    	<div><span>图片名称</span> <input id="fileName" type="text" value="<?php  echo $filename?>"/><br></div>
    	<div><img  src="<?php echo $file; ?>" id="file_base64img"/></div>
    </div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
 
<script type="text/javascript">

$("#btn_edit").bind("click",function(){
	var file_base64 = $("#file_base64").val();
	 var filename = $("#fileName").val();
	 var file = $("#file").val();

	if(filename==""){
		alert("图片名称不能为空");
		return;
	}

	if(file==""){
		alert("图片不能为空");
		return;
	}
	window.opener.document.getElementById("fileName").value=filename;
	window.opener.document.getElementById("file_base64").value= file_base64;
	window.opener.document.getElementById("file").value= file;
	 
	window.close();



});

</script>          
<script type="text/javascript" src="js/unit_update_pic.js"></script>



  

  
 

 
