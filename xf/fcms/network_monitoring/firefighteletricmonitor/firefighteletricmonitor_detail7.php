<?php include '../../../authen/include/page/top.php';?>
<?php 
$partId=Fun::request("partId");

?>
<style>
  body{background:transparent}
</style>
<div class="mt50">
<span class="fr">
从：<input class="hmui-input Wdate " onclick="WdatePicker({dateFmt:'YYYY-MM-dd'});"/>
到：<input class="hmui-input Wdate " onclick="WdatePicker({dateFmt:'YYYY-MM-dd'});"/>
<input type="button" value="确定" id="btn_history" class="hmui-btn"/>
</span>


</div> 
<table border="0" cellpadding="0" cellspacing="0" class="hmui-sheet" width="100%">

  <tr>
    <td width="">遥信项</td>
    <td>状态</td>
    <td>变化时间</td>
  </tr>
 <tbody id="tbody_content"></tbody>
</table>
 <div id="pageNav1" class="mt20"></div>
<div id="pageNav" class="mt20"></div>
<?php include '../../../authen/include/page/bottom.php';?>     
 <script type="text/javascript">
 var  partId = "<?php  echo $partId?>";
 </script>        
<script type="text/javascript" src="js/firefighteletricmonitor_detail7.js"></script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>

  