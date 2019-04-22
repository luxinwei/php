package com.dzqc.enterprise.config;

/******
 *  当前登录者的配置信息
 *  sharePreference名字为当前登陆者Code
 ***********/

import android.content.Context;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.Build;

public class UserInfoKeeper {
	public static SharedPreferences appSharedPreferences = null;

	public static SharedPreferences initShaerPreferences() {
		if (appSharedPreferences == null)
			appSharedPreferences = DzqcEnterprise.getInstance().getSharedPreferences(String.valueOf(AppInfoKeeper.getLoginCode()), AppInfoKeeper.getMode());
		return appSharedPreferences;
	}

	public static int getMode() {
		if (Build.VERSION.SDK_INT > Build.VERSION_CODES.GINGERBREAD) {
			return Context.MODE_MULTI_PROCESS;
		}
		return 0;
	}

	// 当前登录者的token
	public static String getToken(Context context) {
		return initShaerPreferences().getString("token", "-1");
	}

	// 更新当前登陆者的token
	public static void keepToken(Context context, String token) {
		Editor editor = initShaerPreferences().edit();
		editor.putString("token", token);
		editor.commit();
	}
	public static void updToken(String currenttoken)
	{
		String previousToken=UserInfoKeeper.getToken(DzqcEnterprise.getInstance());
		//不存在token值或失效则更新
		if (previousToken==null||!previousToken.equals(currenttoken)) {
			UserInfoKeeper.keepToken(DzqcEnterprise.getInstance(), currenttoken);
		}
	}
}
