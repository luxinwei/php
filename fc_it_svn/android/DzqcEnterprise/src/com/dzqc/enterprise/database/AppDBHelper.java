package com.dzqc.enterprise.database;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteDatabase.CursorFactory;
import android.database.sqlite.SQLiteOpenHelper;

public class AppDBHelper extends SQLiteOpenHelper {

	public AppDBHelper(Context context, String name, CursorFactory factory,
			int version) {
		super(context, name, factory, version);
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 创建表语句
	 */
	private static final String create_schools= "create table schools ("
			+ "id integer primary key autoincrement," + "schoolcode text,"+"schoolname text,"
			+ "address text,"+ "city text,"+ "citycode text,"+"url text)";
	/**
	 * 创建表语句
	 */
	private static final String create_selectSchool= "create table checkSchoolTable ("
			+ "id integer primary key autoincrement," + "schoolcode text)";

	@Override
	public void onCreate(SQLiteDatabase db) {
		// TODO Auto-generated method stub
		//db.execSQL(create_schools);
		db.execSQL(create_selectSchool);
	}

	@Override
	public void onUpgrade(SQLiteDatabase db, int arg1, int arg2) {
		// TODO Auto-generated method stub
		db.execSQL("drop table  if exists checkSchoolTable");
		onCreate(db);
	}

}
