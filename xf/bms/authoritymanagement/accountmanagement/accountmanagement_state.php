<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<?php include '../../../authen/include/page/top.php';?>
<?php
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
$state=Fun::request("state");//获取id 根据此id进行修改:必须要有的
?>
 
 <div style="background-color: #fff">
		  <div class="tc mt50">
		  	<span style="font-size: 20px" id="state"></span>
		  </div>
</div>
 <script type="text/javascript">
 var id="<?php echo $id?>"
var  state="<?php echo $state?>"
		if(state=="0"){
			$("#state").html("解冻");
			state
		}
		if(state=="1"){
			$("#state").html("冻结");
		}
		if(state=="0"){
			state="1";
		}else{
			state="0";
		}
function saveFn(){
 	search();
	function search(){              //查询
		var params={uri:"users/"+id+"/"+state};
 		var url=rootPath+"/com/base/InterfacePatchAction.php";
	 	$.post(url,params,function(responseText){	
  		     var resultobj=eval("("+responseText+")");
		     var success=resultobj.success; 
		     var code=resultobj.code; 
		     var content="";   
		     if(success){
				alert("成功");
		     }else{
				alert("失败");
		     }
		                
	 }) 
	}
 	 
}

	 
	 
</script>           
<script type="text/javascript" src=" "></script>