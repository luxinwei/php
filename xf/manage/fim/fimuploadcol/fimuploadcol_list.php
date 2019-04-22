<?php include '../../../manage/include/page/top.php';?>
<form name="myform" id="myform" method="post" style="margin:10px">     
<fieldset class="layui-elem-field layui-field-title site-title">
      <legend><a name="default">上传文件格式设置</a></legend>
</fieldset>
	<table class="layui-table"  lay-skin="line">
		<colgroup>
		    <col width="50">
		    <col width="100">
		    <col width="100">
		    <col width="120">
		    <col>
	   </colgroup>
		<thead>
			<tr>                                                                                            
				<th>序号</th>                                                                   
				<th>主键</th>                                                                          
				<th>上传表</th>                                                                          
				<th>上传表字段</th>                                                                          
				<th>允许文件类型</th>                                                                          
				<th>虚拟路径</th>                                                                          
				<th>说明</th>  
			</tr>
		</thead>                                                                                                                                               
		<tbody id="tbody_content"></tbody>                                                                
	</table>                              
</form>  
<script type="text/javascript" src="js/fimuploadcol_list.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>