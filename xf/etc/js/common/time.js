
document.write ("<span id=\"ylylylylylylylylcurrtime\" ></span>");
window.setInterval ("showdate()",200);

function showdate()
{
 today=new Date();
 switch (today.getDay())
 {
 case 0:
	var week="星期天"
	break
 case 1:
	var week="星期一"
	break
 case 2:
	var week="星期二"
	break
 case 3:
	var week="星期三"
	break
 case 4:
	var week="星期四"
	break
 case 5:
	var week="星期五"
	break
 case 6:
	var week="星期六"	

 } 
var month=today.getMonth();
var day=today.getDate();
var Hours=today.getHours();
var Min=today.getMinutes();
var Sec=today.getSeconds();
month=month+1;
if (parseInt(month)<10)	month="0"+month;
if (parseInt(day)<10) day="0"+day;
if (parseInt(Hours)<10) Hours="0"+Hours;
if (parseInt(Min)<10) Min="0"+Min;
if (parseInt(Sec)<10) Sec="0"+Sec;

document.getElementById("ylylylylylylylylcurrtime").innerHTML =today.getFullYear()+"年"+month+"月"+day+"日  "+week+" "+Hours+":"+Min+":"+Sec;

}
