package com.dzqc.enterprise.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

public class WifiUtils {

	public static boolean isWifiConnected(Context context) {
		ConnectivityManager connectivityManager = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
		NetworkInfo wifiNetworkInfo = connectivityManager.getNetworkInfo(ConnectivityManager.TYPE_WIFI);
		return wifiNetworkInfo.isConnected();
	}

	public static boolean isMobeilConnected(Context context) {
		ConnectivityManager connectivityManager = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
		NetworkInfo internet = connectivityManager.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);
		return internet.isConnected();
	}
}
