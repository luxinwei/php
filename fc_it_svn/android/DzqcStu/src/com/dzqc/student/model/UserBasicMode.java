package com.dzqc.student.model;

public class UserBasicMode {

	public int status;

	public String info;

	public String token;

	public User user;

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

	public void setUser(User user) {
		this.user = user;
	}

	public User getUser() {
		return this.user;
	}

	public static class User {
		public String audit;

		public String id;

		public String username;

		public String mobile;
		public String realname;
		public String sex;
		public String id_card;
		public String avatar;
		
		public String getRealname() {
			return realname;
		}

		public void setRealname(String realname) {
			this.realname = realname;
		}

		public String getSex() {
			return sex;
		}

		public void setSex(String sex) {
			this.sex = sex;
		}

		public String getId_card() {
			return id_card;
		}

		public void setId_card(String id_card) {
			this.id_card = id_card;
		}

		public String getAvatar() {
			return avatar;
		}

		public void setAvatar(String avatar) {
			this.avatar = avatar;
		}

		public void setAudit(String audit) {
			this.audit = audit;
		}

		public String getAudit() {
			return this.audit;
		}

		public void setId(String id) {
			this.id = id;
		}

		public String getId() {
			return this.id;
		}

		public void setUsername(String username) {
			this.username = username;
		}

		public String getUsername() {
			return this.username;
		}

		public void setMobile(String mobile) {
			this.mobile = mobile;
		}

		public String getMobile() {
			return this.mobile;
		}

	}
}
