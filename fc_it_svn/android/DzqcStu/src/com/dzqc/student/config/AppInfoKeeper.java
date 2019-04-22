package com.dzqc.student.config;

/******
 * 整个app的配置信息
 * sharePreference名字为app名字
 ***********/

import android.content.Context;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.Build;

public class AppInfoKeeper {

	public static SharedPreferences appSharedPreferences = null;

	public static SharedPreferences initShaerPreferences() {
		if (appSharedPreferences == null)
			appSharedPreferences = DzqcStu.getInstance().getSharedPreferences(
					AppInfoKeeper.class.getName(), AppInfoKeeper.getMode());
		return appSharedPreferences;
	}

	public static int getMode() {
		if (Build.VERSION.SDK_INT > Build.VERSION_CODES.GINGERBREAD) {
			return Context.MODE_MULTI_PROCESS;
		}
		return 0;
	}

	// 获取该设备当前登录者
	public static int getLoginCode() {
		return initShaerPreferences().getInt("loginCode", 0);
	}

	// 更新该设备当前登录者
	public static void setLoginCode(int loginCode) {
		Editor editor = initShaerPreferences().edit();
		editor.putInt("loginCode", loginCode);
		editor.commit();
	}

	// 检测是否今日已经做过版本更新检测
	public static String getVersionCheck() {
		return initShaerPreferences().getString("versionCheck", "000000");
	}

	// 更新版本检测日期
	public static void setVersionCheck(String dateString) {
		Editor editor = initShaerPreferences().edit();
		editor.putString("versionCheck", dateString);
		editor.commit();
	}
}
