package com.dzqc.student.http;

public class Urls {

	// URL地址信息
	//public final static String ROOTURL = "http://192.168.1.189";
	public final static String ROOTURL = "http://123.57.53.43";

	public final static String Channel="Android";
	
	//共用同一短信接口，以类型区分；1-注册，2-手机无密码登录，3-找回密码
	public final static String type_register="1";
	public final static String type_login_noPwd="2";
	public final static String type_find_pwd="3";
	
	// 接口方法类型
	public final static class MethodType {
		public final static int GET = 0;
		public final static int POST = 1;
	}

	// 接口方法列表
	public final static class Method {
		//public final static String Block="/dzqc_xiaoqi_svn";
		public final static String Block="/dzqc_xiaoqi";
		
		public final static String getToken=Block+"/Qiniu/getToken";
		
		public final static String UserLogin=Block+"/User/login";
		public final static String UserReg=Block+"/User/reg";
		public final static String CheckSmsCode=Block+"/SMSCode/chkSmsCode";
		public final static String SendSmsCode=Block+"/SMSCode/sendSmsCode";
		public final static String ResetPwd=Block+"/User/forgetPwd";
		
		public final static String realNameAuthentication=Block+"/Audit/realNameAudit";
		public final static String getRealNameAuthenticationInfo=Block+"/Audit/getRealNameAuditInfo";
		
		public final static String StuAllList=Block+"/StudentTask/allList";//企业所有任务列表
		public final static String myList=Block+"/StudentTask/myList";//获取相关任务列表
		
		public final static String StuTaskDetail=Block+"/Task/detail";//企业任务详情
		public final static String applayExitJoin=Block+"/TaskJoin/applayExitJoin";//申请退出
		public final static String applayJoin=Block+"/TaskJoin/applayJoin";//申请任务
		public final static String waitStartTask=Block+"/TaskJoin/waitStartTask";//申请开始任务 准备
		public final static String packTaskJoin=Block+"/TaskJoin/packTaskJoin";//归档任务
		public final static String CompanyInfo=Block+"/Company/detail";//公司信息
		public final static String getListByTask=Block+"/TaskComment/getListByTask";//评论信息
		public final static String addComment=Block+"/TaskComment/addComment";//评论任务
		public final static String getPublishListByCompany=Block+"/Task/getPublishListByCompany";//历史项目列表

		public final static String henanCity=Block+"/DicArea/henanCity";//河南城市列表
		public final static String getListByCity=Block+"/DicSchool/getListByCity";//学校列表
		public final static String getListByIDS=Block+"/DicSchool/getListByIDS";//河南城市列表
		public final static String getListBySchool=Block+"/DicMajor/getListBySchool";//根据大学获取专业列表
		
		public final static String getIdeasList=Block+"/Ideas/getIdeasList";//双创列表
		public final static String myPublishIdeasList=Block+"/Ideas/myPublishIdeasList";//我的双创列表
		public final static String ideasDetail=Block+"/Ideas/ideasDetail";//双创详情
		public final static String publishIdea=Block+"/Ideas/publishIdea";//发布双创
		public final static String agreeIdeas=Block+"/Ideas/agreeIdeas";//点赞
		
		public final static String viewPersonalResume=Block+"/Recruit/viewPersonalResume";//查看简历
		public final static String submitResume=Block+"/Recruit/submitResume";//修改简历
		
		public final static String deliveryResume=Block+"/Recruit/deliveryResume";//投递简历
		
		
		public final static String positionList=Block+"/Recruit/positionList";//职位列表
		public final static String getListByIndustry=Block+"/DicIndustry/getListByIndustry";//行业列表
	
		public final static String myBaseData=Block+"/User/myBaseData";//用户基本信息
		public final static String positionDetails=Block+"/Recruit/positionDetails";//双创详情
		public final static String findDelivery=Block+"/Recruit/findDelivery";//自己投递过的简历
		
		public final static String saveStudentAvatar=Block+"/Audit/saveStudentAvatar";//上传用户头像

		public final static String modifyPwd=Block+"/User/modifyPwd";//修改密码
	}

	//方法名称列表，生成secrit使用
	public final static class function{
		public final static String getToken="getToken";
		
		public final static String login="login";
		public final static String reg="reg";
		public final static String chkSmsCode="chkSmsCode";
		public final static String sendSmsCode="sendSmsCode";
		public final static String sendPwdSmsCode="sendPwdSmsCode";
		public final static String chkPwdSmsCode="chkPwdSmsCode";
		public final static String resetPwd="forgetPwd";
		public final static String realNameAuthentication="realNameAudit";
		public final static String getRealNameAuthenticationInfo="getRealNameAuditInfo";
		public final static String allList="allList";
		public final static String myList="myList";
		public final static String detail="detail";
		public final static String applayExitJoin="applayExitJoin";
		public final static String applayJoin="applayJoin";
		public final static String waitStartTask="waitStartTask";
		public final static String packTaskJoin="packTaskJoin";
		public final static String comdetail="detail";
		public final static String getListByTask="getListByTask";
		public final static String addComment="addComment";
		public final static String getPublishListByCompany="getPublishListByCompany";
		
		public final static String henanCity="henanCity";
		public final static String getListByCity="getListByCity";
		public final static String getListByIDS="getListByIDS";
		public final static String publishIdea="publishIdea";
		
		public final static String getIdeasList="getIdeasList";
		public final static String ideasDetail="ideasDetail";
		public final static String viewPersonalResume="viewPersonalResume";
		public final static String submitResume="submitResume";
		public final static String positionList="positionList";
		public final static String getListBySchool="getListBySchool";
		public final static String getListByIndustry="getListByIndustry";
		public final static String myBaseData="myBaseData";
		public final static String agreeIdeas="agreeIdeas";
		public final static String positionDetails="positionDetails";
		public final static String findDelivery="findDelivery";
		public final static String deliveryResume="deliveryResume";
		public final static String myPublishIdeasList="myPublishIdeasList";
		
		public final static String saveStudentAvatar="saveStudentAvatar";
		public final static String modifyPwd="modifyPwd";
	}
	
}
