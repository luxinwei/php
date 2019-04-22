package com.dzqc.student.config;

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
			appSharedPreferences = DzqcStu.getInstance().getSharedPreferences(
					String.valueOf(AppInfoKeeper.getLoginCode()),
					AppInfoKeeper.getMode());
		return appSharedPreferences;
	}

	public static int getMode() {
		if (Build.VERSION.SDK_INT > Build.VERSION_CODES.GINGERBREAD) {
			return Context.MODE_MULTI_PROCESS;
		}
		return 0;
	}

	// 获取登陆者认证信息
	public static String getAuditCode() {
		return initShaerPreferences().getString("userAudit", "0");// 默认为0 未提交
	}

	// 设置登陆者认证信息
	public static void setAuditCode(String userAudit) {
		Editor editor = initShaerPreferences().edit();
		editor.putString("userAudit", userAudit);
		editor.commit();
	}

	// 当前登录者的token
	public static String getToken(Context context) {
		return initShaerPreferences().getString("token", "-1");// 默认不能用null,否则获取不到token值
	}

	// 更新当前登陆者的token
	public static void keepToken(Context context, String token) {
		Editor editor = initShaerPreferences().edit();
		editor.putString("token", token);	
		editor.commit();
	}

	public static void updToken(String currenttoken) {
		String previousToken = UserInfoKeeper.getToken(DzqcStu.getInstance());
		// 不存在token值或失效则更新
		if (previousToken == null || !previousToken.equals(currenttoken)) {
			UserInfoKeeper.keepToken(DzqcStu.getInstance(), currenttoken);
		}
	}

	// 获取该设备当前登录者状态
	public static int getLoginState() {
		return initShaerPreferences().getInt("loginState", 0);
	}

	// 更新该设备当前登录者状态
	public static void setLoginState(int loginCode) {
		Editor editor = initShaerPreferences().edit();
		editor.putInt("loginState", loginCode);
		editor.commit();
	}
}
