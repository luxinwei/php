package com.dzqc.student.config;

import com.dzqc.student.R;

import android.os.Environment;

public class Constants {

	public static String secret="dzqc2016yui";
	
	//崩溃日志appid
	public static String BUGLY_APPID="900029557";
	
	public static String SIGN_METHOD_MD5="MD5";
	public static String SIGN_METHOD_HMAC="HMAC";
	public static String CHARSET_UTF8="UTF-8";
	
	
	public static String root=DzqcStu.getInstance().getResources().getString(R.string.app_name);
	
	public final static int PageSize=20;
	
	public final static String filePath=Environment.getExternalStorageDirectory()+"/"+root+"/taskfile";
	public final static String userIcon=Environment.getExternalStorageDirectory()+"/"+root+"/userpic/";
	
	public final static String apkPath = Environment.getExternalStorageDirectory()+ "/"+root+"/apk"; // app下载路径
	public final static String downPicPath = Environment.getExternalStorageDirectory() + "/"+root+"/Picture"; // 图片下载路径
}
