 <?php include '../../../authen/include/page/top.php';?>
<?php 
$partId = Fun::request("partId");
 
?>
 <body style="background:#FFFFFF;">
 <table border="0" cellpadding="0" cellspacing="0" class="hmui-sheet mb30" width="100%">
   <tr>
     <th>时间</th>
     <th>类型</th>
     <th>报警内容</th>
     <th>当前状态</th>
     <th class="tc" width="100">操作</th>
   </tr>
<tbody id="tbody_content">
</tbody>
</table>
<div id="tishi" style="background: url(img/null.png) no-repeat center;height: 500px;display: none"">
 	<div id="pageNav" class="mt20"></div>
	<div class="h50"></div>
</body>
 <?php include '../../../authen/include/page/bottom.php';?>      
 <script type="text/javascript">
 var  partId = "<?php  echo $partId?>";
 var result_jsarray=[['0','未处理'],['1','已处理']];
</script>   
<script type="text/javascript" src="js/electricfiremonitor_list9.js"></script>
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>
    