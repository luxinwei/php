package com.dzqc.enterprise.model;

import java.util.List;

public class WorkSchoolListMode {

	public String status,info,token;
	public DataList list;
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
		public List<RowList> rows;
		public String getTotal() {
			return total;
		}
		public void setTotal(String total) {
			this.total = total;
		}
		
		public List<RowList> getRows() {
			return rows;
		}
		public void setRows(List<RowList> rows) {
			this.rows = rows;
		}

		public static class RowList{
			public String id;
			public String pid;
			public String map;
			public String title;
			public String depth;
			public String varname;
			public String sort;
			public String getId() {
				return id;
			}
			public void setId(String id) {
				this.id = id;
			}
			public String getPid() {
				return pid;
			}
			public void setPid(String pid) {
				this.pid = pid;
			}
			public String getMap() {
				return map;
			}
			public void setMap(String map) {
				this.map = map;
			}
			public String getTitle() {
				return title;
			}
			public void setTitle(String title) {
				this.title = title;
			}
			public String getDepth() {
				return depth;
			}
			public void setDepth(String depth) {
				this.depth = depth;
			}
			public String getVarname() {
				return varname;
			}
			public void setVarname(String varname) {
				this.varname = varname;
			}
			public String getSort() {
				return sort;
			}
			public void setSort(String sort) {
				this.sort = sort;
			}
		}
	}
}
