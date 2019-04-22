/**
 * 
 */
$(function() {
	/**第一步**/
	$('.upload1').each(function() {
		var tag = this;
		new QC.upload(this, function(ret) {
			if (ret.status == 1) {
				$.each(ret.path, function(k, path) {
					$("#img_" + 0).html( ret.name[k]);
					$("#file_key_" + 0).val( ret.path[k]);
					$("#file_name_" + 0).val( ret.name[k]);
					$("#img_" + 0).parent().attr('href',ret.url[k]);
					$("#zp").click(function(){
						$("#img_" + 0).attr('src',ret.url[k]);
					});
					$("#img_" + 0).click(function(){
						$("#img_" + 0).attr('src', null);
					});
				});
			}
		},'','','','',false);
	});	
	
	/**第二部**/
	$('.upload2').each(function() {
		var tag = this;
		new QC.upload(this, function(ret) {
			if (ret.status == 1) {
				$.each(ret.path, function(k, path) {
					$("#img_" + 1).html( ret.name[k]);
					$("#file_key_" + 1).val( ret.path[k]);
					$("#file_name_" + 1).val( ret.name[k]);
					$("#img_" + 1).parent().attr('href',ret.url[k]);
					$("#zp1").click(function(){
						$("#img_" + 1).attr('src',ret.url[k]);
					});
					$("#img_" + 1).click(function(){
						$("#img_" + 1).attr('src', null);
					});
				});
			}
		},'','','','',false);
	});	
	
	
	/**第三步上传**/
	$('.upload3').each(function() {
		var tag = this;
		new QC.upload(this, function(ret) {
			if (ret.status == 1) {
				$.each(ret.path, function(k, path) {
					$("#img_" + 2).html( ret.name[k]);
					$("#file_key_" + 2).val( ret.path[k]);
					$("#file_name_" + 2).val( ret.name[k]);
					$("#img_" + 2).parent().attr('href',ret.url[k]);
					$("#zp2").click(function(){
						$("#img_" + 2).attr('src',ret.url[k]);
					});
					$("#img_" + 2).click(function(){
						$("#img_" + 2).attr('src', null);
					});
				});
			}
		},'','','','',false);
	});	
});