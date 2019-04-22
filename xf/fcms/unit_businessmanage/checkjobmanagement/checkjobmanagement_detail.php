<?php include '../../../authen/include/page/top.php';?>




<div align="center" class="hmui-shadow p20 mt10" style="background:#FFFFFF;min-height:750px">
    <span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
    <div class="cb"></div>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form mt5" width="1200">
 <tr>
    <td colspan="3">
     <div style="width:100%;height:400px;border:1px solid #E5E5E5" class="vid-wrapper">
    
    <video id="myPlayer" poster="" controls playsInline webkit-playsinline autoplay></video>

    </div>
    </td>
  </tr>
  <tr>
    <th><font class="cred"></font>演练内容</th>
    <td><input class="hmui-btn w200" value="脱岗" type="button" id="stop"></td>
     <td><input class="hmui-btn w200" value="在岗" type="button" id="start"></td>
  </tr>

</table>
</div>
<?php include '../../../authen/include/page/bottom.php';?>     
<script type="text/javascript" src="js/ezuikit.js"></script>     
<script type="text/javascript" src="js/checkjobmanagement_detail.js"></script>

    <style>
        body{margin:0;}
        #url{width: 100%;}
        #myPlayer{width: 600px;height: 400px;}
   .vid-wrapper{
	    width:100%;
	    position:relative;
	    padding-bottom:56.25%;    
	    height: 0;
	}
	.vid-wrapper video{
	    position: absolute;
	    top:0;
	    left: 0;
	    width: 100%;
	    height: 100%
	}
    </style>
    <script>
 

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
<script>
/* 
    var video = document.getElementById('myPlayer');
    startEvent();
    function startEvent(){
      
        video.src = "http://hls.open.ys7.com/openlive/f01018a141094b7fa138b9d0b856507b.hd.m3u8";
        var player = new EZUIPlayer('myPlayer');
        // 日志
        player.on('log', log);

        function log(str){
            var div = document.createElement('DIV');
            div.innerHTML = (new Date()).Format('yyyy-MM-dd hh:mm:ss.S') + JSON.stringify(str);
            document.body.appendChild(div);
        }


    }
 */


</script>