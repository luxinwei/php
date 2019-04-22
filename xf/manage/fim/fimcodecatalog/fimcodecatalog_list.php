<?php include '../../../manage/include/page/top.php';?>    
<?php include '../../../com/core/fim/FimCodelibrary.class.php';?>
<?php include '../../../com/core/fim/FimCodecatalog.class.php';?>
<?php
	$codeno=Fun::request("codeno");
	$codename=FimCodecatalog::getInstance()->getCatalogTitle($codeno);
	$list_catalog=FimCodecatalog::getInstance()->getAllList();
	$url="";
	$content_catalog="";
	for($i=0;$i<count($list_catalog);$i++){
		$catalog=$list_catalog[$i];
		$tourl="fimcodelibrary_list.php?codeno=".$catalog["CODENO"]."&m=".Fun::request("m");
		if($i==0)$url=$tourl;
		$content_catalog.="<li>";
		
		$content_catalog.="<div class=\"hd\">";
		$content_catalog.="<span onclick=\"showEdit('".$catalog["CODENO"]."')\">[编辑]</span>";
		$content_catalog.="<a target=\"libraryFrame\" href=\"".$tourl."\">";
		$content_catalog.="<font class=\"cred\">".($i+1)."</font>";
		$content_catalog.=".".$catalog["CODENO"];
		$content_catalog.="</a>";
		$content_catalog.="</div>";
		$content_catalog.="<a target=\"libraryFrame\" href=\"".$tourl."\">";
		$content_catalog.="<div class=\"bd\">";
		$content_catalog.=$catalog["CODENAME"];
		$content_catalog.="</div>";
		$content_catalog.="</a>";
		
		$content_catalog.="</li>";
	}
	
?> 
<style>
.code{border: 1px solid #d2d2d2;}
.code ul{}
.code ul li{float:left;margin:3px;border: 1px solid #797d7e;width:160px;border-radius: 5px;position:relative;}
.code ul li .hd{padding:3px;height:20px;line-height:20px;background: #ccc;font-size:12px;overflow: hidden;}
.code ul li .bd{padding:3px;}
.code ul li span{float:right;color:#666666;cursor:pointer;display:none;font-size:12px;position:absolute;right:0px;}
.code ul li:hover{border: 1px solid #f00;}
.code ul li:hover span{display:block;color:#f00;}
.code ul li a{color:#000;font-size:12px;}
.code ul li a:hover{color:#f00;}
.code ul .add{height:50px;text-align:center;line-height:50px;cursor:pointer;}
.code ul .add font{color:#666666;font-size:12px;}
/*.code .cur{color:#f00;font-weight: bold;background-color: #fffcef;border: 1px solid #f00;}*/
</style>


<div  class="code">
<ul>
<?php echo $content_catalog;?>
<li class="add" onclick="showAdd();"><font>[增加]</font></li>
</ul>
<div class="cb"></div>
</div>                
  <iframe src="<?php echo $url;?>" id="libraryFrame" name="libraryFrame"  frameborder="0" width="100%" height="1500"></iframe>
 
	                                                                                            
	       
<script type="text/javascript" src="js/fimcodecatalog_list.js"></script>
<?php include '../../../manage/include/page/bottom.php';?>