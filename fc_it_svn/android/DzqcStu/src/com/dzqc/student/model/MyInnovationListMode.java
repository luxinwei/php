package com.dzqc.student.model;

import java.util.List;

public class MyInnovationListMode {

	public int status;

	public String info;

	public String token;

	public DataList list;

	public DataList getList() {
		return list;
	}

	public void setList(DataList list) {
		this.list = list;
	}

	public void setStatus(int status) {
		this.status = status;
	}

	public int getStatus() {
		return this.status;
	}

	public void setInfo(String info) {
		this.info = info;
	}

	public String getInfo() {
		return this.info;
	}

	public void setToken(String token) {
		this.token = token;
	}

	public String getToken() {
		return this.token;
	}

	public static class DataList {
		public String total;

		public List<Rows> rows;

		public void setTotal(String total) {
			this.total = total;
		}

		public String getTotal() {
			return this.total;
		}

		public void setRows(List<Rows> rows) {
			this.rows = rows;
		}

		public List<Rows> getRows() {
			return this.rows;
		}

		public static class Rows {
			public String id;

			public String title;

			public String desc;

			public String uid;

			public String agree;

			public String agree_uid;

			public String addtime;

			public void setId(String id) {
				this.id = id;
			}

			public String getId() {
				return this.id;
			}

			public void setTitle(String title) {
				this.title = title;
			}

			public String getTitle() {
				return this.title;
			}

			public void setDesc(String desc) {
				this.desc = desc;
			}

			public String getDesc() {
				return this.desc;
			}

			public void setUid(String uid) {
				this.uid = uid;
			}

			public String getUid() {
				return this.uid;
			}

			public void setAgree(String agree) {
				this.agree = agree;
			}

			public String getAgree() {
				return this.agree;
			}

			public void setAgree_uid(String agree_uid) {
				this.agree_uid = agree_uid;
			}

			public String getAgree_uid() {
				return this.agree_uid;
			}

			public void setAddtime(String addtime) {
				this.addtime = addtime;
			}

			public String getAddtime() {
				return this.addtime;
			}

		}
	}

}
