//$("#btn_history").bind("click", function(){window.location.href="unit_update.php?m="+m;});window.close();
$("#btn_close").bind("click", function(){window.close();});
singlePicUpload();
function imgPreview(fileDom){
    //判断是否支持FileReader
    if (window.FileReader) {
        var reader = new FileReader();
    } else {
        alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
    }

    //获取文件
    var file = fileDom.files[0];
    var imageType = /^image\//;

    //是否是图片
    if (!imageType.test(file.type)) {
        alert("请选择图片！");
        return;
    }
    //读取完成
    reader.onload = function(e) {
        //获取图片dom
        var img1 = document.getElementById("file_base64img");
        var filename=$("#fileName").val();
        var p=filename.indexOf("."); 
        var b = filename.substring(p+1);
        //图片路径设置为读取的图片
        img1.src = e.target.result;
        
        var str=img1.src;
        var index =str.indexOf(";base64,")+8;
        var simg = str.slice(index)
  
       // var t="/data:image\/"+b+";base64,"
      //  simg=str.replace(t, "");
       
     
        $("#file_base64").val(simg);
        $("#file_img").val(str);
       // draw(img1);
      
    };
   
    reader.readAsDataURL(file);
}
