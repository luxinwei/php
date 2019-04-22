package com.dzqc.enterprise.model;

import java.util.List;

public class ApplyMode {

	private String status;
	private String info;
	private String token;
	private ListInfo list;
	
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


	public ListInfo getList() {
		return list;
	}

	public void setList(ListInfo list) {
		this.list = list;
	}


	public static class ListInfo
	{
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

		public static class Rows
		{
			public String id;
			public String taskid;
			public String addtime;
			public String uid;
			public String state;
			public String isdel;
			public UserData user_data;
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
			public String getUid() {
				return uid;
			}
			public void setUid(String uid) {
				this.uid = uid;
			}
			public String getState() {
				return state;
			}
			public void setState(String state) {
				this.state = state;
			}
			public String getIsdel() {
				return isdel;
			}
			public void setIsdel(String isdel) {
				this.isdel = isdel;
			}
			public static class UserData
			{
				public String username;
				public String id;
				public String student_and_photo;
				public String sex;
				public String realname;
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
