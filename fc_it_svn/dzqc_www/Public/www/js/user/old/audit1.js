$(function(){
	$("#agreement").click(function(){
		
		$("#agreement").toggle(function(){
			if($("input[type='checkbox']").is(':checked')){
				$("#next").css("background-color","green");
			}
		});
	});
	$("#next").click(function(){
		if($("input[type='checkbox']").is(':checked')){
			$("#form").submit();
			return true;
		}else{
			return false;
		}
	});
})