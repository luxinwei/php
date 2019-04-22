package com.dzqc.student.model;

import java.util.List;

public class NormalResultModel {

	public String status;
	public String info;
	public String token;

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

	public static class workList{
		public String total;
		public List<rowInfo> rows;
		
		public String getTotal() {
			return total;
		}

		public List<rowInfo> getRows() {
			return rows;
		}

		public void setRows(List<rowInfo> rows) {
			this.rows = rows;
		}

		public void setTotal(String total) {
			this.total = total;
		}

		public static class rowInfo{
			public String id;//任务ID
			public String uid;//任务发布者ID
			public String type;
			public String title;//任务标题
			public String content;//任务内容
			public String work_days;
			public String pay_money;
			public String pay_type;
			public String addtime;//任务发布时间
			public String first_pay_money;
			public String end_pay_money;
			public String endtime;
			public String state;
			public String join_number;
			public publishInfo publisherData;//任务发布者信息
			
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
			public String getType() {
				return type;
			}
			public void setType(String type) {
				this.type = type;
			}
			public String getTitle() {
				return title;
			}
			public void setTitle(String title) {
				this.title = title;
			}
			public String getContent() {
				return content;
			}
			public void setContent(String content) {
				this.content = content;
			}
			public String getWork_days() {
				return work_days;
			}
			public void setWork_days(String work_days) {
				this.work_days = work_days;
			}
			public String getPay_money() {
				return pay_money;
			}
			public void setPay_money(String pay_money) {
				this.pay_money = pay_money;
			}
			public String getPay_type() {
				return pay_type;
			}
			public void setPay_type(String pay_type) {
				this.pay_type = pay_type;
			}
			public String getAddtime() {
				return addtime;
			}
			public void setAddtime(String addtime) {
				this.addtime = addtime;
			}
			public String getFirst_pay_money() {
				return first_pay_money;
			}
			public void setFirst_pay_money(String first_pay_money) {
				this.first_pay_money = first_pay_money;
			}
			public String getEnd_pay_money() {
				return end_pay_money;
			}
			public void setEnd_pay_money(String end_pay_money) {
				this.end_pay_money = end_pay_money;
			}
			public String getEndtime() {
				return endtime;
			}
			public void setEndtime(String endtime) {
				this.endtime = endtime;
			}
			public String getState() {
				return state;
			}
			public void setState(String state) {
				this.state = state;
			}
			public String getJoin_number() {
				return join_number;
			}
			public void setJoin_number(String join_number) {
				this.join_number = join_number;
			}
			
			public publishInfo getPublisherData() {
				return publisherData;
			}
			public void setPublisherData(publishInfo publisherData) {
				this.publisherData = publisherData;
			}
			public String getState_text() {
				return state_text;
			}
			public void setState_text(String state_text) {
				this.state_text = state_text;
			}
			public static class publishInfo{
				public String id;
				public String username;
				public String password;
				public String regtime;
				public String regchannel;
				public String lastlogintime;
				public String score;
				public String lastloginchannel;
				public String tuijianren;
				public String state;
				public String loginstate;
				public String companyname;//任务发布者名称
				public String lega_lperson;
				public String companyimage;
				public String audit;
				public String reg_number;
				public String capital;
				public String seat_of;
				public String card_name;
				public String id_card_number;
				public String operators_phone;
				public String card_image;
				public String seal_picture;
				public String industry;
				public String getId() {
					return id;
				}
				public void setId(String id) {
					this.id = id;
				}
				public String getUsername() {
					return username;
				}
				public void setUsername(String username) {
					this.username = username;
				}
				public String getPassword() {
					return password;
				}
				public void setPassword(String password) {
					this.password = password;
				}
				public String getRegtime() {
					return regtime;
				}
				public void setRegtime(String regtime) {
					this.regtime = regtime;
				}
				public String getRegchannel() {
					return regchannel;
				}
				public void setRegchannel(String regchannel) {
					this.regchannel = regchannel;
				}
				public String getLastlogintime() {
					return lastlogintime;
				}
				public void setLastlogintime(String lastlogintime) {
					this.lastlogintime = lastlogintime;
				}
				public String getScore() {
					return score;
				}
				public void setScore(String score) {
					this.score = score;
				}
				public String getLastloginchannel() {
					return lastloginchannel;
				}
				public void setLastloginchannel(String lastloginchannel) {
					this.lastloginchannel = lastloginchannel;
				}
				public String getTuijianren() {
					return tuijianren;
				}
				public void setTuijianren(String tuijianren) {
					this.tuijianren = tuijianren;
				}
				public String getState() {
					return state;
				}
				public void setState(String state) {
					this.state = state;
				}
				public String getLoginstate() {
					return loginstate;
				}
				public void setLoginstate(String loginstate) {
					this.loginstate = loginstate;
				}
				public String getCompanyname() {
					return companyname;
				}
				public void setCompanyname(String companyname) {
					this.companyname = companyname;
				}
				public String getLega_lperson() {
					return lega_lperson;
				}
				public void setLega_lperson(String lega_lperson) {
					this.lega_lperson = lega_lperson;
				}
				public String getCompanyimage() {
					return companyimage;
				}
				public void setCompanyimage(String companyimage) {
					this.companyimage = companyimage;
				}
				public String getAudit() {
					return audit;
				}
				public void setAudit(String audit) {
					this.audit = audit;
				}
				public String getReg_number() {
					return reg_number;
				}
				public void setReg_number(String reg_number) {
					this.reg_number = reg_number;
				}
				public String getCapital() {
					return capital;
				}
				public void setCapital(String capital) {
					this.capital = capital;
				}
				public String getSeat_of() {
					return seat_of;
				}
				public void setSeat_of(String seat_of) {
					this.seat_of = seat_of;
				}
				public String getCard_name() {
					return card_name;
				}
				public void setCard_name(String card_name) {
					this.card_name = card_name;
				}
				public String getId_card_number() {
					return id_card_number;
				}
				public void setId_card_number(String id_card_number) {
					this.id_card_number = id_card_number;
				}
				public String getOperators_phone() {
					return operators_phone;
				}
				public void setOperators_phone(String operators_phone) {
					this.operators_phone = operators_phone;
				}
				public String getCard_image() {
					return card_image;
				}
				public void setCard_image(String card_image) {
					this.card_image = card_image;
				}
				public String getSeal_picture() {
					return seal_picture;
				}
				public void setSeal_picture(String seal_picture) {
					this.seal_picture = seal_picture;
				}
				public String getIndustry() {
					return industry;
				}
				public void setIndustry(String industry) {
					this.industry = industry;
				}
				
			}
			public String state_text;//任务当前状态
		}
	}
}
