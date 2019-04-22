package com.dzqc.student.model;

import java.util.List;

public class IndustryMode {

	private String status;
	private String info;
	private String token;
	private DataList list;
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}
	public String getInfo() {
		return info;
	}
	public void setInfo(String info) {
		this.info = info;
	}
	public String getToken() {
		return token;
	}
	public void setToken(String token) {
		this.token = token;
	}
	public DataList getList() {
		return list;
	}
	public void setList(DataList list) {
		this.list = list;
	}
	public static class DataList{
		public String total;
		public List<Rows> rows;
		public String getTotal() {
			return total;
		}
		public void setTotal(String total) {
			this.total = total;
		}
		public List<Rows> getRows() {
			return rows;
		}
		public void setRows(List<Rows> rows) {
			this.rows = rows;
		}
		public static class Rows{
			public String id;
			public String name;
			public String pid;
			public String getId() {
				return id;
			}
			public void setId(String id) {
				this.id = id;
			}
			public String getName() {
				return name;
			}
			public void setName(String name) {
				this.name = name;
			}
			public String getPid() {
				return pid;
			}
			public void setPid(String pid) {
				this.pid = pid;
			}
		}	
		}
}
