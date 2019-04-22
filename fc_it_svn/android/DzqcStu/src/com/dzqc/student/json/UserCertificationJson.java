package com.dzqc.student.json;

import org.json.JSONException;
import org.json.JSONObject;

import com.dzqc.student.model.UserCertificationMode;

public class UserCertificationJson {

	private String json;
	public UserCertificationJson(String json)
	{
		this.json=json;
	}
	
	public UserCertificationMode getJsonData()
	{
		UserCertificationMode mode=new UserCertificationMode();
		try {
			JSONObject jsonObject=new JSONObject(json);
			String status=jsonObject.get("status").toString();
			if (!status.equals("0")) {
				String content=jsonObject.getString("info");
				JSONObject objectInfo=new JSONObject(content);
				mode.setRealName(objectInfo.getString("realname").toString());
				mode.setUserNo(objectInfo.getString("user_no").toString());
				mode.setLoginstate(objectInfo.getString("state").toString());
				mode.setId_card(objectInfo.getString("id_card").toString());
				mode.setDate(objectInfo.getString("regtime").toString());
				mode.setSchool(objectInfo.getString("university").toString());
				mode.setMajor(objectInfo.getString("major").toString());
				mode.setStuPhoto(objectInfo.getString("student_and_photo").toString());
				mode.setAudit(objectInfo.getString("audit"));
				mode.setSchoolyears(objectInfo.getString("school_years").toString());
			}
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return mode;
	}
	public UserCertificationMode getCertificationToken()
	{
		UserCertificationMode mode=new UserCertificationMode();
		try {
			JSONObject jsonObject=new JSONObject(json);
			String status=jsonObject.get("status").toString();
			String content=jsonObject.getString("token");
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return mode;
	}
}
