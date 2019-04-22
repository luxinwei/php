package com.dzqc.student.json;

import org.json.JSONException;
import org.json.JSONObject;

import android.util.Log;

import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;

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
		if (DzqcStu.isDebug) {
			Log.i("json------->", status);
			
		}
		//返回信息成功后判断token逻辑
		if (status.equals("1")) {
			previousToken=UserInfoKeeper.getToken(DzqcStu.getInstance());
			//不存在token值
			if (previousToken==null||!previousToken.equals(currentToken)) {
				UserInfoKeeper.keepToken(DzqcStu.getInstance(), currentToken);
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
	
	//用户认证辨识
	public String getLoginAudit() throws JSONException
	{
		JSONObject jsonObject=new JSONObject(json);
		String audit=jsonObject.get("audit").toString();
		return audit;
	}
	
	
	//使用七牛云存储时，从业务服务器先获取token值
	public String getQiNiuToken() throws JSONException
	{
		JSONObject jsonObject=new JSONObject(json);
		String token=jsonObject.get("qiniu_token").toString();
		return token;
	}
	
}
