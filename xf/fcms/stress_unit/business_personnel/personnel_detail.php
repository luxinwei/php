<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");    //获取id 根据此id进行修改:必须要有的
?>
<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
 		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
		
	</span>
	    <div class="cb"></div><div id="tbody_content" class="w800"></div>
 <table border="0" cellpadding="0" cellspacing="0" class="hmui-table2" width="1200">
        <tr>
            <th width="15%">人员姓名</th>
            <td width="35%"><span id="buildname"></span></td>
            <th width="15%">联系电话</th>
            <td width="35%"><span id="phone"></span></td>
        </tr>
        <tr>
            <th>文化程度</th>
            <td><span id="educationDegree" ></span></td>

            <th>是否受过消防培训</th>
            <td ><span id="trainingFlag"></span></td>
         </tr>
        <tr>
            <th>是否为疏散引导员</th>
            <td><span id="evacuationGuide"></span></td>
            <th>参加培训时间</th>
            <td><span id="trainingTime"></span></td>
        </tr>
        <tr>
            <th>培训证书编号</th>
            <td><span id="certificateNum"></span></td>
            <th>领证时间</th>
            <td><span id="getTime"></span></td>
        </tr>
 
</table> 
</div>
 
 
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var yesornot_jsarry=[["1","是"],["0","否"]];
 
var id="<?php echo $id?>";  
 
 
</script>           
<script type="text/javascript" src="js/personnel_detail.js"></script>