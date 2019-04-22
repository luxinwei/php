function agreeJoin(id){
	
	 if(confirm("确认此操作吗？")){
		 window.location=_APP_+"CompanyTask/agreeJoin?id="+id;
		 
	 }
}

function refuseJoin(id){
	
	 if(confirm("确认此操作吗？")){
		 
		 window.location=_APP_+"CompanyTask/refuseJoin?id="+id;
		 
	 }
}

function withdrawal(id){
	
	 if(confirm("确认此操作吗？")){
		 
		 window.location=_APP_+"CompanyTask/withdrawal?id="+id;
		 
	 }
}