package com.dzqc.student.database;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.dzqc.student.config.DzqcStu;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.util.Log;

public class LocalShoolDbHelp {

	/*
	 * 数据库名
	 */
	public static final String DB_NAME = "dzqcStu";

	/*
	 * 数据库版本
	 */
	public static int db_version = 1;

	private static LocalShoolDbHelp schoolDb;
	private SQLiteDatabase db;

	private LocalShoolDbHelp(Context context) {
		LocalDb dbhelp = new LocalDb(context, DB_NAME, null, db_version);
		db = dbhelp.getWritableDatabase();
	}

	// 获取LocalShoolDbHelp实例
	public synchronized static LocalShoolDbHelp getInstance(Context context) {
		if (schoolDb == null) {
			schoolDb = new LocalShoolDbHelp(context);
		}
		return schoolDb;
	}

	/**
	 * // 保存学校信息
	 * 
	 * @param
	 * @H2601953
	 */
	public int setSchoolInfo(String schoolId, String schoolName) {
		int flag=0;
		if (!schoolId.equals("")) {
			ContentValues values = new ContentValues();
			values.put("schoolId", schoolId);
			values.put("schoolName", schoolName);
			flag=(int) db.insert("LocalSchool", null, values);
		}
		return flag;
	}

	/**
	 * //根据Id读取学校信息
	 * 
	 * @param
	 * @H2601953
	 */
	public boolean getSchoolById(String id) {
		boolean flag=false;
		try {
			Cursor schoolCursor=db.query("LocalSchool", null, "schoolId=?", new String[]{id}, null, null, "id Desc");	
			while (schoolCursor.moveToNext()) {
				flag=true;
			}
		} catch (Exception e) {
			// TODO: handle exception
		}
		return flag;
	}
	
	/**
	 * // 从数据库读取学校信息
	 * 
	 * @param
	 * @H2601953
	 */
	public List<Map<String, String>> getSchoolInfo() {
		List<Map<String, String>> list =new ArrayList<Map<String,String>>();
		try {
			Cursor schoolCursor = db.query("LocalSchool", null, null, null,
					null, null, "id Desc");
			while (schoolCursor.moveToNext()) {
				String schoolid = schoolCursor.getString(schoolCursor
						.getColumnIndex("schoolId"));
				String schoolName = schoolCursor.getString(schoolCursor
						.getColumnIndex("schoolName"));
				if (DzqcStu.isDebug) {
					Log.i("遍历游标结果",schoolid+"--"+schoolName);
				}
				Map<String, String> map=new HashMap<String, String>();
				map.put("schoolId", schoolid);
				map.put("schoolName", schoolName);
				list.add(map);
			}
		} catch (Exception e) {
			// TODO: handle exception
			if (DzqcStu.isDebug) {
				Log.i("查询本地数据库异常：：：：",e.toString());
			}
		}
		return list;
	}

	/**
	 * 
	 * @param
	 * @H2601953
	 */
	public int deleteSchoolInfo(String schoolId) {
		int m = db.delete("LocalSchool", "schoolId=?",
				new String[] { schoolId });
		return m;
	}
	

	/**
	 * // 保存专业信息
	 * 
	 * @param
	 * @H2601953
	 */
	public void setMajorInfo(String majorId, String majorName) {
		if (!majorId.equals("")) {
			ContentValues values = new ContentValues();
			values.put("majorId", majorId);
			values.put("majorName", majorName);
			db.insert("LocalMajor", null, values);
		}
	}

	/**
	 * // 从数据库读取专业信息
	 * 
	 * @param
	 * @H2601953
	 */
	public Map<String, String> getMajorInfo() {
		Map<String, String> maps = new HashMap<String, String>();
		try {
			Cursor schoolCursor = db.query("LocalMajor", null, null, null,
					null, null, "id Desc");
			do {
				String schoolid = schoolCursor.getString(schoolCursor
						.getColumnIndex("majorId"));
				String schoolName = schoolCursor.getString(schoolCursor
						.getColumnIndex("majorName"));
				maps.put("majorId", schoolid);
				maps.put("majorName", schoolName);
			} while (schoolCursor.moveToNext());
		} catch (Exception e) {
			// TODO: handle exception
		}
		return maps;
	}

	/**
	 * 
	 * @param
	 * @H2601953
	 */
	protected void deleteMajorInfo(String majorId) {
		int m = db.delete("LocalMajor", "majorId=?",
				new String[] { majorId });
	}
}
