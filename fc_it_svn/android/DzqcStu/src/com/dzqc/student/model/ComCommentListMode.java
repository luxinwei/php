package com.dzqc.student.model;

public class ComCommentListMode {

	private String status;
	private String info;
	private String token;
	private ListData list;
	public ListData getList() {
		return list;
	}

	public void setList(ListData list) {
		this.list = list;
	}

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

	public static class ListData{
		private String total;
		private java.util.List<Rows> rows;
		
		public String getTotal() {
			return total;
		}

		public void setTotal(String total) {
			this.total = total;
		}

		public java.util.List<Rows> getRows() {
			return rows;
		}

		public void setRows(java.util.List<Rows> rows) {
			this.rows = rows;
		}

		public static class Rows{
			private String id;
			private String taskid;
			private String addtime;
			private String content;
			private String star;
			private String uid;
			private User_Date user_data;
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
			public String getContent() {
				return content;
			}
			public void setContent(String content) {
				this.content = content;
			}
			public String getStar() {
				return star;
			}
			public void setStar(String star) {
				this.star = star;
			}
			public String getUid() {
				return uid;
			}
			public void setUid(String uid) {
				this.uid = uid;
			}
			public User_Date getUser_data() {
				return user_data;
			}
			public void setUser_data(User_Date user_data) {
				this.user_data = user_data;
			}
			public static class User_Date{
				private String username;
				private String id;
				private String student_and_photo;
				private String sex;
				private String realname;
				public String getUsername() {
					return username;
				}
				public void setUsername(String username) {
					this.username = username;
				}
				public String getId() {
					return id;
				}
				public void setId(String id) {
					this.id = id;
				}
				public String getStudent_and_photo() {
					return student_and_photo;
				}
				public void setStudent_and_photo(String student_and_photo) {
					this.student_and_photo = student_and_photo;
				}
				public String getSex() {
					return sex;
				}
				public void setSex(String sex) {
					this.sex = sex;
				}
				public String getRealname() {
					return realname;
				}
				public void setRealname(String realname) {
					this.realname = realname;
				}
			}
		}
	}
}
