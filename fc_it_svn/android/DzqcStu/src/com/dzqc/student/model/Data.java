package com.dzqc.student.model;

public class Data {

	private String id;

	private String uid;

	private String type;

	private String title;

	private String content;

	private String work_days;

	private String pay_money;

	private String pay_type;

	private String addtime;

	private String first_pay_money;

	private String end_pay_money;

	private String endtime;

	private String state;

	private String join_number;

	private boolean is_my_publish;

	private String state_text;

	private PublisherData publisherData;

	private FileList fileList;

	private int surplus_days;

	private My_join_data my_join_data;

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
	public void setType(String type){
	this.type = type;
	}
	public String getType(){
	return this.type;
	}
	public void setTitle(String title){
	this.title = title;
	}
	public String getTitle(){
	return this.title;
	}
	public void setContent(String content){
	this.content = content;
	}
	public String getContent(){
	return this.content;
	}
	public void setWork_days(String work_days){
	this.work_days = work_days;
	}
	public String getWork_days(){
	return this.work_days;
	}
	public void setPay_money(String pay_money){
	this.pay_money = pay_money;
	}
	public String getPay_money(){
	return this.pay_money;
	}
	public void setPay_type(String pay_type){
	this.pay_type = pay_type;
	}
	public String getPay_type(){
	return this.pay_type;
	}
	public void setAddtime(String addtime){
	this.addtime = addtime;
	}
	public String getAddtime(){
	return this.addtime;
	}
	public void setFirst_pay_money(String first_pay_money){
	this.first_pay_money = first_pay_money;
	}
	public String getFirst_pay_money(){
	return this.first_pay_money;
	}
	public void setEnd_pay_money(String end_pay_money){
	this.end_pay_money = end_pay_money;
	}
	public String getEnd_pay_money(){
	return this.end_pay_money;
	}
	public void setEndtime(String endtime){
	this.endtime = endtime;
	}
	public String getEndtime(){
	return this.endtime;
	}
	public void setState(String state){
	this.state = state;
	}
	public String getState(){
	return this.state;
	}
	public void setJoin_number(String join_number){
	this.join_number = join_number;
	}
	public String getJoin_number(){
	return this.join_number;
	}
	public void setIs_my_publish(boolean is_my_publish){
	this.is_my_publish = is_my_publish;
	}
	public boolean getIs_my_publish(){
	return this.is_my_publish;
	}
	public void setState_text(String state_text){
	this.state_text = state_text;
	}
	public String getState_text(){
	return this.state_text;
	}
	public void setPublisherData(PublisherData publisherData){
	this.publisherData = publisherData;
	}
	public PublisherData getPublisherData(){
	return this.publisherData;
	}
	public void setFileList(FileList fileList){
	this.fileList = fileList;
	}
	public FileList getFileList(){
	return this.fileList;
	}
	public void setSurplus_days(int surplus_days){
	this.surplus_days = surplus_days;
	}
	public int getSurplus_days(){
	return this.surplus_days;
	}
	public void setMy_join_data(My_join_data my_join_data){
	this.my_join_data = my_join_data;
	}
	public My_join_data getMy_join_data(){
	return this.my_join_data;
	}
}
