package com.dzqc.student.model;

import java.util.List;

public class WorkSchoolAddMode {

	public String status,info,token;
	public DataList list;
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
	public DataList getList() {
		return list;
	}
	public void setList(DataList list) {
		this.list = list;
	}
	public static class DataList{
		public String total;
		public List<RowList> rows;
		public String getTotal() {
			return total;
		}
		public void setTotal(String total) {
			this.total = total;
		}
		
		public List<RowList> getRows() {
			return rows;
		}
		public void setRows(List<RowList> rows) {
			this.rows = rows;
		}

		public static class RowList{
			public String id;
			public String name;
			public String logo;
			public String address;
			public String province;
			public String city;
			public String area;
			public String full_address;
			public String getId() {
				return id;
			}
			public void setId(String id) {
				this.id = id;
			}
			public String getName() {
				return name;
			}
			public void setName(String name) {
				this.name = name;
			}
			public String getLogo() {
				return logo;
			}
			public void setLogo(String logo) {
				this.logo = logo;
			}
			public String getAddress() {
				return address;
			}
			public void setAddress(String address) {
				this.address = address;
			}
			public String getProvince() {
				return province;
			}
			public void setProvince(String province) {
				this.province = province;
			}
			public String getCity() {
				return city;
			}
			public void setCity(String city) {
				this.city = city;
			}
			public String getArea() {
				return area;
			}
			public void setArea(String area) {
				this.area = area;
			}
			public String getFull_address() {
				return full_address;
			}
			public void setFull_address(String full_address) {
				this.full_address = full_address;
			}
			
		}
	}
}
