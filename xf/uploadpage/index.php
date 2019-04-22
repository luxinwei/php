<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<title>-----</title>
<script type="text/javascript" src="swfupload/js/jquery.js"></script>
<style type="text/css">
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldser,input,textarea,p,blockquote{margin:0; padding:0;}
ol,ul,li{list-style:none;}
.supplysltImg{cursor:pointer;border: 2px solid #d7d7d7;width:73px;height:73px;}
.supplysltImg:hover{cursor:pointer;border: 2px solid #E9AAA5;}
/*上传ul*/
.upload{}
.upload li{float:left;line-height:35px;}
</style>
</head>
<body>
<?php 
include ('../com/base/util/Fun.class.php');
include ('../com/base/util/ParaUtil.class.php');
$uploadparam=Fun::encode("CSM_NEWS_1");
?>
<table>

<tr>
	<td>
	<input name="pic" type="text" id="pic" style="width:500px;" value="upload/CSM_NEWS/1/2015/11/22/20151122141555_22175.jpg"/>
	    <ul class="upload">
	    <li> <span id="pic_view"></span><img  id="pic_img" src="swfupload/images/noimg.png" class="supplysltImg"/></li>
	    <li>
 <iframe id="uploadpiciframe" src="swfupload/big_upload.php?uploadparam=<?php echo $uploadparam;?>&containerId=pic"  width="400" height="35" frameborder="no" scrolling="no" border="0" marginwidth="0" marginheight="0"></iframe>
	 <br/><span id="pic1_msg">&nbsp;图片内容必须清晰可见。</span>    
	   </li>
	    </ul>
	
	</td>
</tr>
</table>
</body>
</html>
<script>
var fileServerUrl="<?php echo ParaUtil::getInstance()->getFileServerUrl() ?>";
initPic("pic");

$("#pic").bind('input propertychange', function() {initPic("pic")})

function initPic(activeXId){
 var virvalue=$("#"+activeXId).val();
 var imgurl=fileServerUrl+"/"+virvalue;
 imgurl=imgurl.replace(/\ufeff/g,'');
 if(virvalue!=""){
 $("#"+activeXId+"_img").attr({ src:imgurl }); 
 //$("#"+activeXId+"_img").attr({ src:  $("#"+activeXId+"_img").attr("src").replace(/\ufeff/g,'')}); 
 } 

}


function initPicx(activeXId){
var virvalue=$("#"+activeXId).val();
//var imgurl=fileServerUrl;
var imgurl=fileServerUrl+"/"+virvalue;
 if(virvalue!=""){
 	$("#"+activeXId+"_img").attr({ src: imgurl}); 
 	$("#"+activeXId+"_view").empty().append("<a target='_blank' href='"+imgurl+"'>[查看]</a>");
 } 
}
$("body").bind("mousemove", function () { initPic("pic");});
</script>