$("#backhistory").bind("click", function(){window.location.href="fimcodelibrary_list.php?codeno="+codeno+"&m="+m;});
/**
	* 验证表单测试方法
	*
	*/
	function checkform() {
	var idArray="";
	var orderArray="";
	var obj=document.getElementById('left');
	　for(var i=0; i < obj.length; i++){
		var selText = obj.options[i].text;
		var selValue = obj.options[i].value;
		if(idArray!="")idArray+=",";
		if(orderArray!="")orderArray+=",";	
	      idArray+=selValue;
	      orderArray+=i;
		}
		var params={keylist:idArray}
		var url="fimCodelibraryAction.php?action=order&m="+m;
    jQuery.ajax({url:url,
			type:'post',
			async: false,      //ajax同步
			dataType:"html",
			data:params,//URL参数
			success:function(responseText){
			   var data=eval("("+responseText+")");//转化为json串
			   var success=data.success;
				   if(success==0){
				    alert("操作失败!");
				   }else if(success==1){  
				    alert("操作成功!");
				    window.location.reload();
				   }else if(success==2){
				   }else if(success==3){
				   };
			   },
			   error:function(){
		         alert("错误");
	             }
			
			});
 
	}
	
//---------------------------------------------------------
//上移
　	function moveUp(obj){　
　　　　　　for(var i=1; i < obj.length; i++){//最上面的一个不需要移动，所以直接从i=1开始
　　　　　　　　if(obj.options[i].selected){
　　　　　　　　　　if(!obj.options.item(i-1).selected){
　　　　　　　　　　　　var selText = obj.options[i].text;
　　　　　　　　　　　　var selValue = obj.options[i].value;
						obj.options[i].text = obj.options[i-1].text;
						obj.options[i].value = obj.options[i-1].value;
						obj.options[i].selected = false;
						obj.options[i-1].text = selText;
						obj.options[i-1].value = selValue;
						obj.options[i-1].selected=true;
　　　　　　　　　　}
　　　　　　　　}
　　　　　　}
　　　　}
		//下移
		function moveDown(obj){
　　　　　　for(var i = obj.length -2 ; i >= 0; i--){//向下移动，最后一个不需要处理，所以直接从倒数第二个开始
　　　　　　　　if(obj.options[i].selected){
　　　　　　　　　　if(!obj.options[i+1].selected){
　　　　　　　　　　　　var selText = obj.options[i].text;
　　　　　　　　　　　　var selValue = obj.options[i].value;
		    		obj.options[i].text = obj.options[i+1].text;
		    		obj.options[i].value = obj.options[i+1].value;
		   			obj.options[i].selected = false;
		 			obj.options[i+1].text = selText;
		  			obj.options[i+1].value = selValue;
		 			obj.options[i+1].selected=true;
　　　　　　　　　　}
　　　　　　　　}
　　　　　　}
　　　　}
		//置顶
	  function  moveTop(obj) 
	  { 
			var  opts = []; 
			for(var i =obj.options.length -1 ; i >= 0; i--){
				if(obj.options[i].selected){
					opts.push(obj.options[i]);
					obj.remove(i);
				}
			}
			var index = 0 ;
			for(var t = opts.length-1 ; t>=0 ; t--){
				var opt = new Option(opts[t].text,opts[t].value);
				opt.selected = true;
				obj.options.add(opt, index++);
			}
		} 
	  //置底
	  function  moveBottom(obj) 
	  { 
			var  opts = []; 
			for(var i =obj.options.length -1 ; i >= 0; i--){
				if(obj.options[i].selected){
					opts.push(obj.options[i]);
					obj.remove(i);
				}
			}
			 for(var t = opts.length-1 ; t>=0 ; t--){
				var opt = new Option(opts[t].text,opts[t].value);
				opt.selected = true;
				obj.options.add(opt);
			}
		} 