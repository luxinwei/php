package com.dzqc.enterprise.database.table;

import java.util.ArrayList;
import java.util.List;
import java.util.Map;

import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.database.AppDBHelper;
import com.dzqc.enterprise.model.WorkSchoolExists;
import com.tencent.bugly.a;

import android.content.ContentValues;
import android.content.Context;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.util.Log;

/**
 * 数据库表
 * 
 * @author hgs 2016.04.12
 */

public class SchoolDao {

	/*
	 * 数据库名
	 */
	public static final String DB_NAME = "schools";

	/*
	 * 数据库版本
	 */
	public static int version = 0;

	private static SchoolDao schoolDb;
	private SQLiteDatabase db;

	private SchoolDao(Context context) {
		version = getVersion();
		AppDBHelper dbhelp = new AppDBHelper(DzqcEnterprise.getInstance(),
				DB_NAME, null, version);
		db = dbhelp.getWritableDatabase();
	}

	// 获取VideoProgressDbHelp实例
	public synchronized static SchoolDao getInstance(Context context) {
		if (schoolDb == null) {
			schoolDb = new SchoolDao(context);
		}
		return schoolDb;
	}
	
	String sql1="insert  into schools('schoolcode','schoolname','address','city','citycode','url')values (110000,'北京市',0,'010',1,'市')";
	
	/**
	 * // 保存城市Id
	 * @param cityname
	 * @H2601953
	 */
	public void setSchoolInfo(Map<String, String> map) {
		try {
			ContentValues values=new ContentValues();
			values.put("schoolcode", map.get("schoolcode"));
			db.insert("checkSchoolTable", null, values);
		} catch (Exception e) {
			// TODO: handle exception
			Log.e("exception>>>>>>>>>>",  e.toString());
		}
		
		/*try {
			String sql="insert  into schools('schoolcode','schoolname','address','city','citycode','url')values"+
		"("+map.get("schoolcode")+","+map.get("schoolname")+","+map.get("address")+","+map.get("city")+","+map.get("citycode")+","+map.get("url")+");";
			db.execSQL(sql);
		} catch (Exception e) {
			// TODO: handle exception
			Log.e("exception>>>>>>>>>>",  e.toString());
		}*/
	}

	/**
	 * // 保存视频播放进度信息
	 * @param VideoName
	 * @H2601953
	 *//*		
	public void setVideoProgress(String VideoName,int VideoProgress) {
		if (!VideoName.equals("")) {
			ContentValues values=new ContentValues();
			values.put("VideoName", VideoName);
			values.put("VideoProgress", VideoProgress);
			db.insert("VideoProgress", null, values);
		}
	}*/
	
	/**
	 * // 从数据库读取城市列表信息
	 * @param parentno
	 * @Hgs
	 */		
	public String getSchoolIds() {
		String results="";
		try {
			Cursor schoolCursor=db.query("checkSchoolTable", null,null, null, null, null, "id Desc");	
			if (schoolCursor.moveToFirst()) {
				do {
					String schoolcode=String.valueOf(schoolCursor.getInt(schoolCursor.getColumnIndex("schoolcode")));
					results=schoolcode+","+results;
				} while (schoolCursor.moveToNext());
			}
		} catch (Exception e) {
			// TODO: handle exception
		}		
		return results;
	}
	
	/**
	 * 获取版本号
	 * 
	 * @return 当前应用的版本号
	 */
	public int getVersion() {
		try {
			PackageManager manager = DzqcEnterprise.getInstance()
					.getPackageManager();
			PackageInfo info = manager.getPackageInfo(DzqcEnterprise
					.getInstance().getPackageName(), 0);
			int version = info.versionCode;
			return version;
		} catch (Exception e) {
			e.printStackTrace();
			return 0;
		}
	}
}
