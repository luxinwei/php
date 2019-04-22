package com.dzqc.enterprise.http;

import android.os.Environment;

public class Urls {

	// URL地址信息
	public final static String ROOTURL = "http://192.168.1.189";

	public final static String Channel="1";//1：安卓，2：ios，3：web
	
	public final static String typeEmail="1";//1：找回密码
	
	//共用同一短信接口，以类型区分；1-注册，2-手机无密码登录，3-找回密码,4-企业认证
	public final static String type_register="1";
	public final static String type_login_noPwd="2";
	public final static String type_find_pwd="3";
	public final static String type_certification="4";
	
	// 接口方法类型
	public final static class MethodType {
		public final static int GET = 0;
		public final static int POST = 1;
	}

	// 接口方法列表
	public final static class Method {
		public final static String Block="/dzqc_xiaoqi_svn";
		
		public final static String getToken=Block+"/Qiniu/getToken";
		
		public final static String UserLogin=Block+"/Company/login";
		public final static String UserReg=Block+"/Company/reg";
		public final static String SendEmail=Block+"/EmailCode/send";
		
		public final static String forgetPwd=Block+"/Company/forgetPwd";//找回密码
		public final static String chkEmailCode=Block+"/EmailCode/chkEmailCode";
		public final static String SendSmsCode=Block+"/SMSCode/sendSmsCode";
		public final static String CheckSmsCode=Block+"/SMSCode/chkSmsCode";
		
		public final static String realNameAuth=Block+"/Comauth/realNameAuth";
		public final static String realNameAuthstatus=Block+"/Comauth/realNameAuthstatus";
		
		//任务模块方法
		public final static String publishTask=Block+"/CompanyTask/publishTask";//发布任务
		public final static String myPublishList=Block+"/CompanyTask/myPublishList";//任务列表
		public final static String TaskDetail=Block+"/Task/detail";//企业任务详情
		public final static String listJoinStudents=Block+"/CompanyTask/listJoinStudents";//任务参与的学生列表信息
		public final static String withdrawal=Block+"/CompanyTask/withdrawal";//同意申请退出
		public final static String agreeJoin=Block+"/CompanyTask/agreeJoin";//同意学生申请
		public final static String refuseJoin=Block+"/CompanyTask/refuseJoin";//拒绝学生申请
		public final static String startTask=Block+"/CompanyTask/startTask";//准备开始任务
		public final static String endTask=Block+"/CompanyTask/endTask";//结束任务
		
		public final static String henanCity=Block+"/DicArea/henanCity";//河南城市列表
		public final static String getListByCity=Block+"/DicSchool/getListByCity";//学校列表
		public final static String getListByIDS=Block+"/DicSchool/getListByIDS";//河南城市列表
	}

	//方法名称列表，生成secrit使用
	public final static class function{
		
		public final static String getToken="getToken";
		
		public final static String login="login";
		public final static String reg="reg";
		public final static String send="send";
		
		public final static String chkEmailCode="chkEmailCode";
		public final static String forgetPwd="forgetPwd";
		public final static String sendSmsCode="sendSmsCode";
		public final static String chkSmsCode="chkSmsCode";
		public final static String realNameAuth="realNameAuth";
		public final static String realNameAuthstatus="realNameAuthstatus";
		
		public final static String publishTask="publishTask";
		public final static String myPublishList="myPublishList";
		public final static String detail="detail";
		public final static String listJoinStudents="listJoinStudents";
		public final static String withdrawal="withdrawal";
		public final static String agreeJoin="agreeJoin";
		public final static String refuseJoin="refuseJoin";
		public final static String startTask="startTask";
		public final static String endTask="endTask";
		public final static String henanCity="henanCity";
		public final static String getListByCity="getListByCity";
		public final static String getListByIDS="getListByIDS";
	}
	
	public final static class Path{
		public final static String filePath=Environment.getExternalStorageDirectory()+"/filePic/";
	}
}
