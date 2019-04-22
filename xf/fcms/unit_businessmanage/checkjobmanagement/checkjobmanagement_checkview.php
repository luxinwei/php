  
 <?php include '../../../authen/include/page/top.php';?>
 <?php 
 $build=$_GET["build"];
 $url=base64_decode(Fun::request("url"));
 $partname=$_GET["partname"];
 $code=$_GET["code"];
 
 $sessionManageUserArray=$_SESSION["XF_SESSION_MANAGE_USER"];     
 $manageuseraccount=trim($sessionManageUserArray["USERACCOUNT"]);
 
  ?>
<style>
   body{margin:0;}
   #url{width: 100%;}
    /*   //  #myPlayer{width: 600px;height: 400px;} */
   .vid-wrapper{
	    width:100%;
	    position:relative;
	    padding-bottom:50.25%;    
	    height: 100%;
	}
	.vid-wrapper video{
	    position: absolute;
	    top:0;
	    left: 0;
	    width: 100%;
	    height: 100%
	}
</style>

<script src="js/ezuikit.js"></script>

<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
	<div class="fr">
 		<input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
	</div>
	<div class="cb"></div>
<div id="tbody_content"></div>

<table width="1200" class="hmui-form">
<tr>
	<td>
		<span>所属建筑：</span><span><?php echo $build;?></span>&nbsp;
		<span>监测点名称：</span><span><?php echo $partname?></span>
	</td>
</tr>
<tr>
	<td width="80%">
		<div  class="vid-wrapper" >
			<video id="myPlayer"    poster="" controls playsInline webkit-playsinline autoplay  ></video>
		</div>
	</td>
</tr>
<tr>
	<td valign="bottom">
		<div class="tc">
			<input type="button" value="脱岗" class="hmui-btn ml10" id="btn_le" revalue="0"/>
			<input type="button" value="在岗" class="hmui-btn ml10" id="btn_in" revalue="1"/>
		</div>	 
	</td>	
</tr>
</table>
<input type="hidden" id="checkedDepId"> 
</div>
<script>
var code="<?php echo $code?>"
var myDate = new Date();
	var y= myDate.getFullYear();
	var m=myDate.getMonth()+1;
	if(myDate.getMonth()+1<10){
	 m= myDate.getMonth()+1;
	 m="0"+m;
	}
	var d=myDate.getDate();
	 
	 if(myDate.getDate()<10){
		d="0"+myDate.getDate();
	 }
	var h= myDate.getHours();
	 if(myDate.getHours()<10){
		h="0"+myDate.getHours()
	 }
	var mm= myDate.getMinutes();
	 if(myDate.getMinutes()<10){
		 mm="0"+myDate.getMinutes()
		 } 
	var s= myDate.getSeconds(); 
	 if(myDate.getSeconds()<10){
		 s="0"+myDate.getSeconds()
		 } 
	var startTime =y+"-"+m+"-"+d+" "+h+":"+mm+":"+s 
 
    var start = document.getElementById('start');
    var urlInput ="http://hls.open.ys7.com/openlive/f01018a141094b7fa138b9d0b856507b.hd.m3u8";
    var video = document.getElementById('myPlayer');
    startEvent();
    function startEvent(){
        var url = urlInput;
        video.src = url;
        var player = new EZUIPlayer('myPlayer');
        // 日志
       // player.on('log', log);

  /*     function log(str){
            var div = document.createElement('DIV');
            div.innerHTML = (new Date()).Format('yyyy-MM-dd hh:mm:ss.S') + JSON.stringify(str);
            document.body.appendChild(div);
        } */


    }
    //start.addEventListener('click', startEvent, false);
 
 
 
</script>
 <script src="js/checkjobmanagement_checkview.js"></script>
 
<?php include '../../../authen/include/page/bottom.php';?>
