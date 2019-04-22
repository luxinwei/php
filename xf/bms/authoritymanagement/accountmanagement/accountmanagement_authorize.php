 <?php include '../../../authen/include/page/top.php';?>
 <style>
 .hmui-form {border-collapse:separate;border-spacing:0 10px;margin-top: 60px}
.hmui-form caption{font-size:20px;font-weight:400;color:#626c81;margin-bottom:20px;border-left:4px solid #5a8cff;padding-left:10px}
.hmui-form td {min-height: 20px;line-height: 40px;font-size: 14px;color:#626c81;}
.hmui-form th {min-height: 20px;line-height: 40px;font-size: 14px;text-align:right;color:#626c81;font-weight:bold;text-align: center;}
.hmui-form tr {background-color: #fff;margin-bottom: 30px}
 </style>
 <div class="ct" style="width: 380px;height: 180px" >
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form ct mt50" width="100%">
	<tr>
		<th width="40%">角色场景</th>
		    <td ><input class="hmui-input w" id="btn_role" buildIdValue=""  readonly="readonly"/></td>
	</tr>
	<tr>
		<th>应用范围</th>
		<td ><input class="hmui-input w" id="btn_app" appId=""  readonly="readonly"/></td>	
	</tr>                                                            
</table>
</div> 

<script type="text/javascript">
function saveFn(){
 }
</script>      
    
<script type="text/javascript" src="js/accountmanagement_authorize.js"></script>