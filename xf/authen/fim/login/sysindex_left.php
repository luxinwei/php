<style>
.leftmenucon{}
.leftmenucon dl{}
.leftmenucon dl dt{line-height: 64px;color: #FFFFFF;font-size: 16px;cursor: pointer;padding-left:80px;}
.leftmenucon dl dd{text-align: center;font-size:14px;color:#FFFFFF;line-height:50px;height:50px}
.leftmenucon dl dd a{color:#FFFFFF;text-decoration:none;}
/*.leftmenucon dl dd:hover{background:#3d6bd8}*/
.leftmenucon dl dt.icon0{background:  url(img/icons1.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon1{background:  url(img/icons2.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon2{background:  url(img/icons3.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon3{background:  url(img/icons4.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon4{background:  url(img/icons5.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon5{background:  url(img/icons6.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon6{background:  url(img/icons7.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon7{background:  url(img/icons8.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon8{background:  url(img/icons9.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon9{background:  url(img/icons10.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon10{background: url(img/icons11.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon11{background: url(img/icons12.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon12{background: url(img/icons13.png) no-repeat center left 30px;}
.leftmenucon dl dt.icon13{background: url(img/icons14.png) no-repeat center left 30px;}
.leftmenucon dl div{display:none}
</style>
<?php 
//业主
// $rootmenuid="154";
// if($manageapptype=="ownerDepartment")$rootmenuid="155";
// if($manageapptype=="monitorCenter")$rootmenuid="154";
//监测


 $rootmenuid="";
if($manageapptype=="ownerDepartment")$rootmenuid="155";
if($manageapptype=="monitorCenter")$rootmenuid="154";
if($manageapptype=="baseManagement")$rootmenuid="236";


$sql_select="select * from fim_menuitem where PARENTID=".$rootmenuid." order by orderindex asc";
$list_menu=DB::getInstance()->execQuery($sql_select);
$content="";
for($i=0;$i<count($list_menu);$i++){
	$menu_firstobj=$list_menu[$i];
	$sql_select="select * from fim_menuitem where PARENTID=".$menu_firstobj["ID"]." order by orderindex asc";
	$list_seconds=DB::getInstance()->execQuery($sql_select);
	$content.="\n<dl>";
	$content.="\n<dt showstate=\"0\"  class=\"icon".$i."\">".$menu_firstobj["TITLE"]."</dt>";
	$content.="\n<div >";
	foreach ($list_seconds as $menu_secondobj){
		
		$menuid   = $menu_secondobj["ID"];
		$linkurl  = $menu_secondobj["LINKURL"];
		if(substr_count($linkurl,"http")==0){
			if(substr_count($linkurl,"?")>0){
				$linkurl.="&m=".Fun::encode($menuid);
			}else{
				$linkurl.="?m=".Fun::encode($menuid);
			}
		}
		
		$url=ParaUtil::getInstance()->getRoot()."/".$linkurl;
		
		//$content.="\n<dd title=\"".$menu_firstobj["TITLE"]."-&gt;".$menu_secondobj["TITLE"]."\" ><a href=\"".$url."\" target=\"contentFrame\">".$menu_secondobj["TITLE"]."</a></dd>";
		 $content.="\n<dd title=\"".$menu_firstobj["TITLE"]."-&gt;".$menu_secondobj["TITLE"]."\" ><a style=\"display:block;width:100%;line-height:50px;\" href=\"".$url."\" target=\"contentFrame\">".$menu_secondobj["TITLE"]."</a></dd>";
		
	}
	$content.="\n<div>";
	$content.="\n</dl>";
}

?>
<div class="leftmenucon">
<?php echo $content;?>
</div>
<script>
$(".leftmenucon div").css("display","none")
 
$(".leftmenucon").find("dt").unbind('click'); 
/*
$(".leftmenucon").find("dt").click(function(){
	 var ddobj = $(this).parent().find("div");
	 ddobj.css("background-color","#4878e7");
	 ddobj.slideToggle("slow")
	 $(this).css("background-color","#4878e7")
  });
  */
$(".leftmenucon").find("dt").click(function(){   //点击菜单的时候
	
	
	
	 var ddobj = $(this).parent().find("div");  //获取菜单元素
	 
	 var showstate=$(this).attr("showstate");   //获取菜单元素属性
	 
	 if(showstate=="0"){                         //判断菜单元素属性全等于0
		 $(".leftmenucon div").each(function(){        // 关闭所有的菜单
				$(this).slideUp();
		 }); 
		 $(".leftmenucon").find("dt").each(function() {  
		 		$(this).attr("showstate","0").css("background-color","#5a8cff");      //循环设置关闭菜单的样式和属性值
		  });
		 ddobj.slideDown().css("background-color","#4878e7");;  //菜单滑下展开改变颜色
		// ddobj.css("display","");
		 $(this).attr("showstate","1").css("background-color","#4878e7");  
	 }else{
		
		 ddobj.slideUp();
		// ddobj.css("display","none");
		 $(this).attr("showstate","0").css("background-color","#5a8cff");
	 }	
});
  $(".leftmenucon").find("dd").click(function(){   //点击菜单的时候
	  navfn($(this).attr("title"));
	  $(".leftmenucon dd").css("background","#4878e7");


	  $(this).css("background","#3d6bd8");
  });

 
 

</script>