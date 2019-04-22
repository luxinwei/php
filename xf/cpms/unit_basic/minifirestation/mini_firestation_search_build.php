<?php include '../../../authen/include/page/top.php';?>
<style>
.selectgrid{margin-top:20px;}
.selectgrid  td{padding:10px;}
</style>

<?php 
$id=Fun::request("id");   
echo $id;
?>
<blockquote class="hmui-nav hmui-shadow">
	选择人员
 
</blockquote>
<div align="center" style="background:#FFFFFF;padding:15px 15px 15px 15px;"  class=" mt10 hmui-shadow">

	 <table align="center" class="selectgrid">
		 <tr>
			 <td>
				  <select id="leftSelector" multiple="multiple" name="SmsListOnLeft" style="min-height:500px; width:200px">
				  </select>
			 </td>
			 <td>
				  <input class="hmui-btn w100" type="button" value="&lt;&lt;" id="btnLeft" />
				  <br/><input class="hmui-btn mt10 w100" type="button" value="&gt;&gt;" id="btnRight"  />
				  <br/><input class="hmui-btn mt10 w100" type="button" onclick="selectAll()" id="btnSelectAll" value="确定" />
			 </td>
			 <td>
				  <select id="rightSelector" multiple="multiple" name="SmsListOnRight" style="min-height:500px; width:200px;">
				  </select>
			 </td>
		 </tr>
		
	 </table>

</div>
<div id="rightSelector_body"></div>
<div id="leftSelector_body"   ></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var id="<?php echo $id?>";
 </script>        
<script type="text/javascript" src="js/mini_firestation_search_build.js"></script>