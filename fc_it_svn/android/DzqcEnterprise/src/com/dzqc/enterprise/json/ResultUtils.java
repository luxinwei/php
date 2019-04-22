package com.dzqc.enterprise.json;

import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;
import com.dzqc.enterprise.model.ResultMode;

public class ResultUtils {

	private static String previousToken="";
	
	public static boolean setToken(ResultMode mode)
	{
		//返回信息成功后判断token逻辑
		if (mode.getStatus().equals("1")) {
			previousToken=UserInfoKeeper.getToken(DzqcEnterprise.getInstance());
			//不存在token值
			if (previousToken==null||!previousToken.equals(mode.getToken())) {
				UserInfoKeeper.keepToken(DzqcEnterprise.getInstance(), mode.getToken());
			}
			return true;
		}else {
			return false;
		}
	}
}
