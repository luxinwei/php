<?php include '../../../authen/include/page/top.php';?>
<?php 
$partId=Fun::request("partId");

?>

<style>
	body{background:transparent}
</style>
<div style="color:#626c81;font-size:14px;line-height:24px ">当前状态:<input type="button" class="hmui-input2 fr" value="刷新"><span class="fr mr20">刷新时间:</span> </div>

<div id="pageNav"></div>
<!--<div style="color:#626c81;font-size:14px" >传感器类型<span class="fr mr100">时间</span></div>-->
<table border="0" cellpadding="0" cellspacing="0" class="hmui-sheet mb30" width="100%">
<tbody id="tbody_content"></tbody>
</table>
<div id="pageNav" class="mt20"></div>
 
<div class="fr" style="position:relative;top:40px;z-index:99;margin-top: -40px;">
	<form  id="chosetime" class="alert_info">
	<input name="endTime" id="endTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" class="hmui-input"/><span>&nbsp;至&nbsp;</span>
	<input name="beginTime" id="beginTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" class="hmui-input"/>
	<input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
	</form>
</div>

<div id="someline" style="min-width:1300px; height: 300px;margin-top: -30px" ></div>
 <tbody id="tbody_content2"></tbody>
<div id="pageNav2" class="mt100"></div>
<tbody id="tbody_content1"></tbody>
<div id="pageNav1" class="mt20"></div>
<?php include '../../../authen/include/page/bottom.php';?>     
 <script type="text/javascript">
 var  partId = "<?php  echo $partId?>";
 </script>    
<script type="text/javascript" src="js/electricfiremonitor_detail4.js"></script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>

  