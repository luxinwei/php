/**
 * 注册验证码刷新
 */

function changeImg() {
	document.getElementById("Image1").src = "{:U('Company/reg')}?"
			+ Math.random();
}
