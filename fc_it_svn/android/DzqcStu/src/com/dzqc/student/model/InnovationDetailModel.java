package com.dzqc.student.model;

public class InnovationDetailModel {

	public int status;

	public String info;

	public String token;

	public DataInfo data;

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

	public DataInfo getData() {
		return data;
	}

	public void setData(DataInfo data) {
		this.data = data;
	}

	public static class DataInfo {
		public String id;

		public String title;

		public String desc;

		public String uid;

		public String agree;

		public String agree_uid;

		public String addtime;

		public UserInfo user;

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

	
		public UserInfo getUser() {
			return user;
		}

		public void setUser(UserInfo user) {
			this.user = user;
		}


		public class UserInfo {
			public String id;

			public String realname;

			public void setId(String id) {
				this.id = id;
			}

			public String getId() {
				return this.id;
			}

			public void setRealname(String realname) {
				this.realname = realname;
			}

			public String getRealname() {
				return this.realname;
			}

		}
	}
}
