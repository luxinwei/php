package com.dzqc.student.model;

import java.util.List;

public class InnovationListMode {

	public int status;

	public String info;

	public String token;

	public DataList list;

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

	public DataList getList() {
		return list;
	}

	public void setList(DataList list) {
		this.list = list;
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
			public ListRows list;

			public UserData user;


			public ListRows getList() {
				return list;
			}

			public void setList(ListRows list) {
				this.list = list;
			}

			public UserData getUser() {
				return user;
			}

			public void setUser(UserData user) {
				this.user = user;
			}

			public static class ListRows {
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

			public static class UserData {
				public String id;

				public String username;

				public String mobile;

				public String regtime;

				public String regchannel;

				public String lastlogintime;

				public String score;

				public String lastloginchannel;

				public String tuijianren;

				public String state;

				public String loginstate;

				public String caneditusername;

				public String qq_sign;

				public String weibo_sign;

				public String weixin_sign;

				public String other_reg_type;

				public String realname;

				public String user_no;

				public String id_card;

				public String sex;

				public String birthday;

				public String university;

				public String major;

				public String grade;

				public String student_and_photo;

				public String audit;

				public String test;

				public String school_years;

				public String avatar;

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

				public void setRegtime(String regtime) {
					this.regtime = regtime;
				}

				public String getRegtime() {
					return this.regtime;
				}

				public void setRegchannel(String regchannel) {
					this.regchannel = regchannel;
				}

				public String getRegchannel() {
					return this.regchannel;
				}

				public void setLastlogintime(String lastlogintime) {
					this.lastlogintime = lastlogintime;
				}

				public String getLastlogintime() {
					return this.lastlogintime;
				}

				public void setScore(String score) {
					this.score = score;
				}

				public String getScore() {
					return this.score;
				}

				public void setLastloginchannel(String lastloginchannel) {
					this.lastloginchannel = lastloginchannel;
				}

				public String getLastloginchannel() {
					return this.lastloginchannel;
				}

				public void setTuijianren(String tuijianren) {
					this.tuijianren = tuijianren;
				}

				public String getTuijianren() {
					return this.tuijianren;
				}

				public void setState(String state) {
					this.state = state;
				}

				public String getState() {
					return this.state;
				}

				public void setLoginstate(String loginstate) {
					this.loginstate = loginstate;
				}

				public String getLoginstate() {
					return this.loginstate;
				}

				public void setCaneditusername(String caneditusername) {
					this.caneditusername = caneditusername;
				}

				public String getCaneditusername() {
					return this.caneditusername;
				}

				public void setQq_sign(String qq_sign) {
					this.qq_sign = qq_sign;
				}

				public String getQq_sign() {
					return this.qq_sign;
				}

				public void setWeibo_sign(String weibo_sign) {
					this.weibo_sign = weibo_sign;
				}

				public String getWeibo_sign() {
					return this.weibo_sign;
				}

				public void setWeixin_sign(String weixin_sign) {
					this.weixin_sign = weixin_sign;
				}

				public String getWeixin_sign() {
					return this.weixin_sign;
				}

				public void setOther_reg_type(String other_reg_type) {
					this.other_reg_type = other_reg_type;
				}

				public String getOther_reg_type() {
					return this.other_reg_type;
				}

				public void setRealname(String realname) {
					this.realname = realname;
				}

				public String getRealname() {
					return this.realname;
				}

				public void setUser_no(String user_no) {
					this.user_no = user_no;
				}

				public String getUser_no() {
					return this.user_no;
				}

				public void setId_card(String id_card) {
					this.id_card = id_card;
				}

				public String getId_card() {
					return this.id_card;
				}

				public void setSex(String sex) {
					this.sex = sex;
				}

				public String getSex() {
					return this.sex;
				}

				public void setBirthday(String birthday) {
					this.birthday = birthday;
				}

				public String getBirthday() {
					return this.birthday;
				}

				public void setUniversity(String university) {
					this.university = university;
				}

				public String getUniversity() {
					return this.university;
				}

				public void setMajor(String major) {
					this.major = major;
				}

				public String getMajor() {
					return this.major;
				}

				public void setGrade(String grade) {
					this.grade = grade;
				}

				public String getGrade() {
					return this.grade;
				}

				public void setStudent_and_photo(String student_and_photo) {
					this.student_and_photo = student_and_photo;
				}

				public String getStudent_and_photo() {
					return this.student_and_photo;
				}

				public void setAudit(String audit) {
					this.audit = audit;
				}

				public String getAudit() {
					return this.audit;
				}

				public void setTest(String test) {
					this.test = test;
				}

				public String getTest() {
					return this.test;
				}

				public void setSchool_years(String school_years) {
					this.school_years = school_years;
				}

				public String getSchool_years() {
					return this.school_years;
				}

				public void setAvatar(String avatar) {
					this.avatar = avatar;
				}

				public String getAvatar() {
					return this.avatar;
				}

			}

		}

	}
}
