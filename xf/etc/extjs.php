var rootPath="<?php echo str_ireplace("/etc/extjs.php","",$_SERVER ['PHP_SELF']);?>";
importJC(rootPath+"/etc/js/extjs/ext-all.js", "js");
importJC(rootPath+"/etc/js/extjs/ext-locale-zh_CN.js", "js");
importJC(rootPath+"/etc/js/extjs/packages/ext-theme-classic/build/resources/ext-theme-classic-all.css", "css");
importJC(rootPath+"/etc/js/extjs/default.css", "css");
function importJC(pathx, type){
  if (type == "css") {
      str="<link href=\"" + pathx + "\" rel=\"stylesheet\" type=\"text/css\"></link>";
  }else{ 
      str="<script src=\"" + pathx + "\"></script>";
  }
  document.write(str); 
}
