package com.dzqc.student.model;

public class WorkDetailModel {

	private int status;

	private String info;

	private String token;

	private Data data;

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
	public void setData(Data data){
	this.data = data;
	}
	public Data getData(){
	return this.data;
	}

}
