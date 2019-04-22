package com.dzqc.student.model;

import java.util.List;

public class MyPositionListMode {

	public int status;

	public String info;

	public String token;

	public PositionList list;

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

	public PositionList getList() {
		return list;
	}

	public void setList(PositionList list) {
		this.list = list;
	}

	public static class PositionList {
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

			public String rid;

			public String uid;

			public String state;

			public String time;

			public String username;

			public String position;

			public String ruid;

			public String rstate;

			public String rtime;

			public String download_url;

			public String rusername;

			public String responsibility;
			
			public String getResponsibility() {
				return responsibility;
			}

			public void setResponsibility(String responsibility) {
				this.responsibility = responsibility;
			}

			public void setId(String id) {
				this.id = id;
			}

			public String getId() {
				return this.id;
			}

			public void setRid(String rid) {
				this.rid = rid;
			}

			public String getRid() {
				return this.rid;
			}

			public void setUid(String uid) {
				this.uid = uid;
			}

			public String getUid() {
				return this.uid;
			}

			public void setState(String state) {
				this.state = state;
			}

			public String getState() {
				return this.state;
			}

			public void setTime(String time) {
				this.time = time;
			}

			public String getTime() {
				return this.time;
			}

			public void setUsername(String username) {
				this.username = username;
			}

			public String getUsername() {
				return this.username;
			}

			public void setPosition(String position) {
				this.position = position;
			}

			public String getPosition() {
				return this.position;
			}

			public void setRuid(String ruid) {
				this.ruid = ruid;
			}

			public String getRuid() {
				return this.ruid;
			}

			public void setRstate(String rstate) {
				this.rstate = rstate;
			}

			public String getRstate() {
				return this.rstate;
			}

			public void setRtime(String rtime) {
				this.rtime = rtime;
			}

			public String getRtime() {
				return this.rtime;
			}

			public void setDownload_url(String download_url) {
				this.download_url = download_url;
			}

			public String getDownload_url() {
				return this.download_url;
			}

			public void setRusername(String rusername) {
				this.rusername = rusername;
			}

			public String getRusername() {
				return this.rusername;
			}

		}
	}
}
