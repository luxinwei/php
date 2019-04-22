package com.dzqc.enterprise.json;

import org.json.JSONException;
import org.json.JSONObject;

import android.util.Log;

import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;

public class JsonToStrUtils {

	
	private String	json;
	private String previousToken="";
	public JsonToStrUtils(String json)
	{
		this.json=json;
	}
	
	public String getJsonContent() throws JSONException
	{
		JSONObject jsonObject=new JSONObject(json);
		String status=jsonObject.get("status").toString();
		String currentToken=jsonObject.getString("token");
		String content=jsonObject.getString("info");
		if (DzqcEnterprise.isDebug) {
			Log.i("json------->", status);
			
		}
		//返回信息成功后判断token逻辑
		if (status.equals("1")) {
			previousToken=UserInfoKeeper.getToken(DzqcEnterprise.getInstance());
			//不存在token值
			if (previousToken==null||!previousToken.equals(currentToken)) {
				UserInfoKeeper.keepToken(DzqcEnterprise.getInstance(), currentToken);
			}
		}
		return content;
	}
	public String getResultStatus() throws JSONException
	{
		JSONObject jsonObject=new JSONObject(json);
		String status=jsonObject.get("status").toString();
		return status;
	}
}
