/**
 * 跳转
 */
$(function() {
	$('#auth3').click(function(){
		location.href = "http://127.0.0.1/dzqc_www/index.php/Comauth/auth21";
	});
	$('#next').click(function() {
		location.href = "http://127.0.0.1/dzqc_www/index.php/Comauth/auth2";
	});
	 
	$("#sub").bind("click", function(event) {
		var companyname = $("#companyname").val();
		var reg_number = $("#reg_number").val();
		var capital = $("#capital").val();
		var lega_lperson = $("#lega_lperson").val();
		var companyimage = $("#companyimage").val();
		var seal_picture = $("#seal_picture").val();
		var seat_of = $("#seat_of").val();
		var companyimage = $("#companyimage").val();
		var card_image = $("#card_image").val();
		var card_name = $("#card_name").val();
		var operators_phone = $("#operators_phone").val();
		var id_card_number = $("#id_card_number").val();
		if (companyname == "") { // 判断值是否为空
			$("#companyname").focus();
			 $("#companyname").css('border-color', 'red');
			return false;
		}
		if (reg_number == "") { // 判断值是否为空
			$("#reg_number").focus();
			$("#reg_number").css('border-color', 'red');
			return false;
		}
		if (capital == "") { // 判断值是否为空
			$("#capital").focus();
			$("#capital").css('border-color', 'red');
			return false;
		}
		if (lega_lperson == "") { // 判断值是否为空
			$("#lega_lperson").focus();
			$("#lega_lperson").css("border-color","red");
			return false;
		}
		if (seat_of == "详细街道信息") { // 判断值是否为空
			$("#seat_of").focus();
			$("#seat_of").css("border-color","red");
			return false;
		}
		if (card_name == "") { // 判断值是否为空
			$("#card_name").focus();
			$("#card_name").css("border-color","red");
			return false;
		}
		if (id_card_number == "") { // 判断值是否为空
			$("#id_card_number").focus();
			$("#id_card_number").css("border-color","red");
			return false;
		}
		if (operators_phone == "") { // 判断值是否为空
			$("#operators_phone").focus();
			$("#operators_phone").css("border-color","red");
			return false;
		}
		if (card_image == "") { // 判断值是否为空
			$("#card_image").focus();
			$("#card_image").css("background","pink");
			return false;
		}
		if (companyimage == "") { // 判断值是否为空
			$("#companyimage").focus();
			$("#companyimage").css("background","pink");
			return false;
		}
	
		if (seal_picture == "") { // 判断值是否为空
			$("#seal_picture").focus();
			$("#seal_picture").css("background","pink");
			return false;
		}		
	});
	

	
	
	

});
