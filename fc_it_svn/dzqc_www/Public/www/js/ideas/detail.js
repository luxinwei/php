function agree(id){
	
	qajax(_APP_ + "Ideas/agree", {
		id : id
	}, function(ret) {
		if (ret.status == 1) {
			QC.msg_s(ret.info);
			window.location.reload();
		} else {

			QC.msg_e(ret.info);

		}
	});
	
}