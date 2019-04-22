package com.gdlion.dpi.domain.vo;

public class MeasurePointRec {
	private Long id;//测点ID
	private String sid;//测点SID
	private String name;//测点名称
	private String value;//测点值
	private String time;//时间
	private Long timeLong;
	private String data_unit;//数据单位
	private String data_type;//数据类型

	private String position;//位置信息

	public MeasurePointRec() {
	}

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public String getSid() {
		return sid;
	}

	public void setSid(String sid) {
		this.sid = sid;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getValue() {
		return value;
	}

	public void setValue(String value) {
		this.value = value;
	}

	public String getTime() {
		return time;
	}

	public void setTime(String time) {
		this.time = time;
	}

	public Long getTimeLong() {
		return timeLong;
	}

	public void setTimeLong(Long timeLong) {
		this.timeLong = timeLong;
	}

	public String getData_unit() {
		return data_unit;
	}

	public void setData_unit(String data_unit) {
		this.data_unit = data_unit;
	}

	public String getData_type() {
		return data_type;
	}

	public void setData_type(String data_type) {
		this.data_type = data_type;
	}

	public String getPosition() {
		return position;
	}

	public void setPosition(String position) {
		this.position = position;
	}
}
