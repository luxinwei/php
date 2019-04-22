package com.dzqc.student.model;

public class My_join_data {
	private User_data user_data;

	private String state_text;
	private String id;
	private String taskid;
	private String addtime;
	private String uid;
	private String state;
	private String isdel;

	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
	public String getTaskid() {
		return taskid;
	}
	public void setTaskid(String taskid) {
		this.taskid = taskid;
	}
	public String getAddtime() {
		return addtime;
	}
	public void setAddtime(String addtime) {
		this.addtime = addtime;
	}
	public String getUid() {
		return uid;
	}
	public void setUid(String uid) {
		this.uid = uid;
	}
	public String getState() {
		return state;
	}
	public void setState(String state) {
		this.state = state;
	}
	public String getIsdel() {
		return isdel;
	}
	public void setIsdel(String isdel) {
		this.isdel = isdel;
	}
	public void setUser_data(User_data user_data){
	this.user_data = user_data;
	}
	public User_data getUser_data(){
	return this.user_data;
	}
	public void setState_text(String state_text){
	this.state_text = state_text;
	}
	public String getState_text(){
	return this.state_text;
	}

}
