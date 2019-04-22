package com.dzqc.enterprise.model;

import java.util.List;

public class FileList {
	private String total;

	private List<WorkDetailRowMode> rows ;

	public void setTotal(String total){
	this.total = total;
	}
	public String getTotal(){
	return this.total;
	}
	public void setRows(List<WorkDetailRowMode> rows){
	this.rows = rows;
	}
	public List<WorkDetailRowMode> getRows(){
	return this.rows;
	}

}
