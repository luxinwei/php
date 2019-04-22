package com.dzqc.student.model;

public class UserCertificationMode {

	private String mobile;
	
	private String loginstate;
	private String userNo;
	private String realName;
	private String id_card;
	private String stuPhoto;
	private String audit,school,major,date;
	private String schoolyears;
	
	public String getSchoolyears() {
		return schoolyears;
	}
	public void setSchoolyears(String schoolyears) {
		this.schoolyears = schoolyears;
	}
	public String getSchool() {
		return school;
	}
	public void setSchool(String school) {
		this.school = school;
	}
	public String getMajor() {
		return major;
	}
	public void setMajor(String major) {
		this.major = major;
	}
	public String getDate() {
		return date;
	}
	public void setDate(String date) {
		this.date = date;
	}
	
	public String getMobile() {
		return mobile;
	}
	public void setMobile(String mobile) {
		this.mobile = mobile;
	}
	public String getLoginstate() {
		return loginstate;
	}
	public void setLoginstate(String loginstate) {
		this.loginstate = loginstate;
	}
	public String getUserNo() {
		return userNo;
	}
	public void setUserNo(String userNo) {
		this.userNo = userNo;
	}
	public String getRealName() {
		return realName;
	}
	public void setRealName(String realName) {
		this.realName = realName;
	}
	public String getId_card() {
		return id_card;
	}
	public void setId_card(String id_card) {
		this.id_card = id_card;
	}
	public String getStuPhoto() {
		return stuPhoto;
	}
	public void setStuPhoto(String stuPhoto) {
		this.stuPhoto = stuPhoto;
	}
	public String getAudit() {
		return audit;
	}
	public void setAudit(String audit) {
		this.audit = audit;
	}
	
}
