<?php include_once dirname(__FILE__). '/config_inc.php';?>
<?php include_once dirname(__FILE__). '/session_member_info.php';?>

<style>


</style>
<?php if($sessionMemberUserArray=="" || !isset($sessionMemberUserArray)){?>
  <li>用户名:<input type="text" placeholder="手机号/身份证号"  class="account" id="useraccount" name="useraccount" maxlength=18/></li>
  <li>密码:<input type="password"   class="pwd" id="userpwd" name="userpwd"/></li>
  <li>验证码:<input class="maskcode"   name="maskcode" id="maskcode" maxlength="4" placeholder="请输入验证码"  onFocus="javascript:refreshmask();"  /></li>
  <li><img name="maskimg" id="maskimg"  src="" width="80" height="25" style="cursor:pointer;border:1px solid #cccccc;" /></li>
  <li><input type="button" value="登录"  class="login_btn" id="login_btn"></li>
  <!-- 
        <li class="jzmm">
          <input name="" type="checkbox" value=""  class="jizhu"/>
          记住密码</li>
           -->
 <?php }else{?>
  <li><?php echo $membernickname; ?>您好，欢迎您登录正阳县党建网络平台</li>
   <li><a href="<?php echo ParaUtil::getInstance()->getRoot();?>/vip"><img src="<?php echo ParaUtil::getInstance()->getRoot()?>/web/etc/img/btn_mypage.jpg" /></a></li>
    <li class="hand" onclick="exitfn();"><img src="<?php echo ParaUtil::getInstance()->getRoot()?>/web/etc/img/btn_exit.jpg" /></li>

   <?php }?>

<script>

function exitfn(){
	var url=rootPath+"/vip/login/loginAction.php?action=exit";
	$.post(url, function(responseText){
		var data=eval("("+responseText+")");                 
		var success=data.success;                               
 		if(success==1){ 
 			alert("退出成功!");  
 			window.location.reload();                                                         
  		}else{                                     
  			alert("退出失败!");                       
  		}   
	});
}
refreshmask();
$("#maskimg").bind("click", function(){refreshmask()});
function refreshmask(){
	$("#maskimg").attr("src",rootPath+"/com/base/common/ValidationCode.class.php?id="+Math.random());
}
inputInt("useraccount");
inputInt("maskcode");
$("#login_btn").bind("click", function(){
	var useraccount  = $("#useraccount").val();
	var password     = $("#userpwd").val();
	var maskcode     = $("#maskcode").val();
	if(!Mibile_Validation.notEmpty(useraccount,"登录账号不能为空"))return; 
	///if(!Mibile_Validation.checkMobile(useraccount,0,"登录账号只能是手机号"))return;
	if(!Mibile_Validation.notEmpty(password,"请输入密码"))return; 
	if(!Mibile_Validation.notEmpty(maskcode,"请输入验证码"))return; 
	
	  var url=rootPath+"/vip/login/loginAction.php?action=login";

		var params={useraccount:encode64(useraccount)
	            ,password:encode64(password)
	            ,maskcode:maskcode
	            ,logintype:getLogintype(useraccount)
	}
		
		$.post(url,params,function(responseText){
		        var data=eval("("+responseText+")");  
				var success=data.success;                                
			 	if(success==0){
			 	  refreshmask();  
			 	  alert(data.msg);
	          	}else if(success==1){
	          		window.location.href=rootPath+"/vip/index.php";                            
	          	}else if(success==2){
		          	layer.alert("验证码不正确!", {time: 3000,shadeClose: true,title: "系统提示",
				         end:function(){
				        		refreshmask();
				         }
				    });
		      	}else{
			      	layer.alert("系统忙，登录失败!", {time: 3000,shadeClose: true,title: "系统提示",
				         end:function(){
				        		refreshmask();
				         }
				    });
			      	
		      	};          
		});                  
	
	
});


function getLogintype(useraccount){
	var logintype="useraccount";
	if(isMobile(useraccount)){
		logintype="mobile";
	}
	if(isEmail(useraccount)){
		logintype="mail";
	}
	if(useraccount.length==18){
		logintype="cardid";
	}
	return logintype;
}


function isMobile(mobile){
     var partten = /^1[3-9]\d{9}$/;
     if(partten.test(mobile)){
          return true;
     }else{
          return false;
     }
}
function isEmail(email){
    var partten = /^(?:[a-z0-9]+[_\-+.]?)*[a-z0-9]+@(?:([a-z0-9]+-?)*[a-z0-9]+\.)+([a-z]{2,})+$/i;
    if(partten.test(email)){
         return true;
    }else{
         return false;
    }
}


</script>