<?php include '../../../authen/include/page/top.php';?>
<?php 
$partId=Fun::request("partId");
?>
<link rel="stylesheet" href="../../../etc/js/layui/css/layui.css"  media="all">
<script type="text/javascript" src="../../../etc/js/jquery.js"></script>
<script src="../../../etc/js/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="../../../etc/js/echarts/echarts-all.js"></script>

 
            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
              <ul class="layui-tab-title" id="li_content">

                <li class="layui-this">报警 </li>
              </ul>
            <div class="layui-tab-content " style="width:100%;background:#FFFFFF;" id="c_content">
           
                 <div class="layui-tab-item layui-show " ><iframe id="li" frameborder=0  class="iframe_content" style="width:100%;min-height:500px;" src="electricmonitor_list9.php?partId=<?php echo $partId?>"></iframe></div>
              </div>
            </div>

<div id="tbody_content"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">

var partId="<?php echo $partId?>";
 initDetail(partId)
function initDetail(id){
	var params={uri:"pointType/pointTypes/"+id};
	var url=rootPath+"/com/base/InterfaceGetAction.php";
	$.post(url,params,function(responseText){	
		  //////$("#tbody_content").parent().after(responseText);
		 
		 var resultobj=eval("("+responseText+")");
		 // $("#tbody_content").parent().after(resultobj.data);
	     var success=resultobj.success; 
	     var code=resultobj.code; 
	     var data=resultobj.data; 
	     var li_content="";   
	     var c_content="";   
	     var s="";
	     if(success){
	    
			 
			 for(i=0;i<data.length;i++){

				if(data[i]=="fh"){
					s+="fh";
					li_content+=" <li>负荷</li>";   
					c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail1.php?partId="+partId+"\"></iframe></div>"
 
				}
			}
			
			for(i=0;i<data.length;i++){
				if(data[i]=="dl"){
					s+="dl";
					li_content+=" <li>电流</li>";   
					c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail2.php?partId="+partId+"\"></iframe></div>"
 
				}
			}
			
			for(i=0;i<data.length;i++){
				if(data[i]=="dy"){
					s+="dy";
					li_content+=" <li>电压</li>";   
					c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail3.php?partId="+partId+"\"></iframe></div>"
 
				}
			}
			
			for(i=0;i<data.length;i++){
				if(data[i]=="gl"){
					s+="gl";
					li_content+=" <li>温度</li>";   
					c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail4.php?partId="+partId+"\"></iframe></div>"
 
				}
			}
			
			for(i=0;i<data.length;i++){
				if(data[i]=="wd"){
					s+="wd";
					li_content+="<li>漏电</li>";   
					c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail5.php?partId="+partId+"\"></iframe></div>"
 
				}
			}
			
			for(i=0;i<data.length;i++){
				if(data[i]=="ld"){
					s+="ld";
					li_content+="<li>功率</li>";   
					c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail6.php?partId="+partId+"\"></iframe></div>"
 
				}
			}
			
			for(i=0;i<data.length;i++){
				if(data[i]=="zt"){
					s+="zt";
					li_content+="<li>状态</li>";   
					c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail7.php?partId="+partId+"\"></iframe></div>"

				}
			 
			} 
	   
/* 
				
						s+="fh";
						li_content+=" <li>负荷</li>";   
						c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail1.php?partId="+partId+"\"></iframe></div>"
	 
		
						s+="dl";
						li_content+=" <li>电流</li>";   
						c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail2.php?partId="+partId+"\"></iframe></div>"
	 
						s+="dy";
						li_content+=" <li>电压</li>";   
						c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail3.php?partId="+partId+"\"></iframe></div>"
	 
			
			
						s+="gl";
						li_content+=" <li>温度</li>";   
						c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail4.php?partId="+partId+"\"></iframe></div>"
	 
			
		
						s+="wd";
						li_content+="<li>漏电</li>";   
						c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail5.php?partId="+partId+"\"></iframe></div>"
	 
		
			
						s+="ld";
						li_content+="<li>功率</li>";   
						c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail6.php?partId="+partId+"\"></iframe></div>"
	 
			
			
						s+="zt";
						li_content+="<li>状态</li>";   
						c_content+="<div class=\"layui-tab-item\" ><iframe frameborder=0  class=\"iframe_content\" style=\"width:100%;min-height:500px;\" src=\"electricmonitor_detail7.php?partId="+partId+"\"></iframe></div>"

					 
				  */
			 $("#li_content").prepend(li_content);     
			 $("#c_content").prepend(c_content);
	 
			 var bodyheight=$(document).height();
			 $(".iframe_content").height(bodyheight);
		 
	    	 
 	    }else{
	    	var message=resultobj.message; 
	    	alert("错误码："+code+message);
	    }   
	              
   })
}
 
 
</script>           
