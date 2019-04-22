package com.dzqc.student.model;

public class IndexDetailModel {

	public int status;

	public String info;

	public String token;

	public DataInfo data;

	public void setStatus(int status){
	this.status = status;
	}
	public int getStatus(){
	return this.status;
	}
	public void setInfo(String info){
	this.info = info;
	}
	public String getInfo(){
	return this.info;
	}
	public void setToken(String token){
	this.token = token;
	}
	public String getToken(){
	return this.token;
	}
	
	public DataInfo getData() {
		return data;
	}
	public void setData(DataInfo data) {
		this.data = data;
	}

	public class DataInfo {
		public String id;

		public String uid;

		public String position;

		public String number;

		public String phone_number;

		public String responsibility;

		public String education;

		public String working_cycle;

		public String remuneration;

		public String push_school;

		public String push_professional;

		public String push_level;

		public String state;

		public String time;

		public String bak_jpush_state;
		public String task_attachment;
		public String rusername;
		public String regtime;
		public String download_url;

		public String getBak_jpush_state() {
			return bak_jpush_state;
		}
		public void setBak_jpush_state(String bak_jpush_state) {
			this.bak_jpush_state = bak_jpush_state;
		}
		public String getTask_attachment() {
			return task_attachment;
		}
		public void setTask_attachment(String task_attachment) {
			this.task_attachment = task_attachment;
		}
		public String getRusername() {
			return rusername;
		}
		public void setRusername(String rusername) {
			this.rusername = rusername;
		}
		public String getDownload_url() {
			return download_url;
		}
		public void setDownload_url(String download_url) {
			this.download_url = download_url;
		}
		public void setId(String id){
		this.id = id;
		}
		public String getId(){
		return this.id;
		}
		public void setUid(String uid){
		this.uid = uid;
		}
		public String getUid(){
		return this.uid;
		}
		public void setPosition(String position){
		this.position = position;
		}
		public String getPosition(){
		return this.position;
		}
		public void setNumber(String number){
		this.number = number;
		}
		public String getNumber(){
		return this.number;
		}
		public void setPhone_number(String phone_number){
		this.phone_number = phone_number;
		}
		public String getPhone_number(){
		return this.phone_number;
		}
		public void setResponsibility(String responsibility){
		this.responsibility = responsibility;
		}
		public String getResponsibility(){
		return this.responsibility;
		}
		public void setEducation(String education){
		this.education = education;
		}
		public String getEducation(){
		return this.education;
		}
		public void setWorking_cycle(String working_cycle){
		this.working_cycle = working_cycle;
		}
		public String getWorking_cycle(){
		return this.working_cycle;
		}
		public void setRemuneration(String remuneration){
		this.remuneration = remuneration;
		}
		public String getRemuneration(){
		return this.remuneration;
		}
		public void setPush_school(String push_school){
		this.push_school = push_school;
		}
		public String getPush_school(){
		return this.push_school;
		}
		public void setPush_professional(String push_professional){
		this.push_professional = push_professional;
		}
		public String getPush_professional(){
		return this.push_professional;
		}
		public void setPush_level(String push_level){
		this.push_level = push_level;
		}
		public String getPush_level(){
		return this.push_level;
		}
		public void setState(String state){
		this.state = state;
		}
		public String getState(){
		return this.state;
		}
		public void setTime(String time){
		this.time = time;
		}
		public String getTime(){
		return this.time;
		}
		
		public void setRegtime(String regtime){
		this.regtime = regtime;
		}
		public String getRegtime(){
		return this.regtime;
		}

		}
	
}
