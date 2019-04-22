package com.dzqc.student.model;

import java.util.List;

public class IndexListMode {

	public int status;

	public String info;

	public String token;

	public DataList list;

	public int getStatus() {
		return status;
	}

	public void setStatus(int status) {
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

	public static class DataList {
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

		public static class Rows {
			public String id;

			public String uid;

			public String position;

			public String number;

			public String phone_number;

			public String responsibility;

			public String education;

			public String working_cycle;

			public String remuneration;

			public String push_school;

			public String push_professional;

			public String push_level;

			public String state;

			public String time;

			public Download_url download_url;

			public String getId() {
				return id;
			}

			public void setId(String id) {
				this.id = id;
			}

			public String getUid() {
				return uid;
			}

			public void setUid(String uid) {
				this.uid = uid;
			}

			public String getPosition() {
				return position;
			}

			public void setPosition(String position) {
				this.position = position;
			}

			public String getNumber() {
				return number;
			}

			public void setNumber(String number) {
				this.number = number;
			}

			public String getPhone_number() {
				return phone_number;
			}

			public void setPhone_number(String phone_number) {
				this.phone_number = phone_number;
			}

			public String getResponsibility() {
				return responsibility;
			}

			public void setResponsibility(String responsibility) {
				this.responsibility = responsibility;
			}

			public String getEducation() {
				return education;
			}

			public void setEducation(String education) {
				this.education = education;
			}

			public String getWorking_cycle() {
				return working_cycle;
			}

			public void setWorking_cycle(String working_cycle) {
				this.working_cycle = working_cycle;
			}

			public String getRemuneration() {
				return remuneration;
			}

			public void setRemuneration(String remuneration) {
				this.remuneration = remuneration;
			}

			public String getPush_school() {
				return push_school;
			}

			public void setPush_school(String push_school) {
				this.push_school = push_school;
			}

			public String getPush_professional() {
				return push_professional;
			}

			public void setPush_professional(String push_professional) {
				this.push_professional = push_professional;
			}

			public String getPush_level() {
				return push_level;
			}

			public void setPush_level(String push_level) {
				this.push_level = push_level;
			}

			public String getState() {
				return state;
			}

			public void setState(String state) {
				this.state = state;
			}

			public String getTime() {
				return time;
			}

			public void setTime(String time) {
				this.time = time;
			}

			public Download_url getDownload_url() {
				return download_url;
			}

			public void setDownload_url(Download_url download_url) {
				this.download_url = download_url;
			}

			public static class Download_url {
				public String fkey;

				public String business_head;

				public void setFkey(String fkey){
				this.fkey = fkey;
				}
				public String getFkey(){
				return this.fkey;
				}
				public void setBusiness_head(String business_head){
				this.business_head = business_head;
				}
				public String getBusiness_head(){
				return this.business_head;
				}

				}

		}
	}
}
