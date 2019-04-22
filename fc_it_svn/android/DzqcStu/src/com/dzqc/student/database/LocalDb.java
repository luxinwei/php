package com.dzqc.student.database;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteDatabase.CursorFactory;
import android.database.sqlite.SQLiteOpenHelper;

public class LocalDb extends SQLiteOpenHelper {

private Context mContext;
	/*
	 * LocalSchool 建表语句
	 */
	public static final String create_LocalSchool = "create table LocalSchool ("
			+ "id integer primary key autoincrement," + "schoolId text,"
			+ "schoolName text)";
	/*
	 * LocalMajor 建表语句
	 */
	public static final String create_LocalMajor = "create table LocalMajor ("
			+ "id integer primary key autoincrement," + "majorId text,"
			+ "majorName text)";
	
	public LocalDb(Context context, String name, CursorFactory factory,
			int version) {
		super(context, name, factory, version);
		// TODO Auto-generated constructor stub
		this.mContext=context;
	}

	@Override
	public void onCreate(SQLiteDatabase db) {
		// TODO Auto-generated method stub
		db.execSQL(create_LocalSchool);
		db.execSQL(create_LocalMajor);
	}

	@Override
	public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
		// TODO Auto-generated method stub
		db.execSQL("drop table  if  exists  LocalSchool");
		db.execSQL("drop table  if  exists  LocalMajor");
		onCreate(db);
	}

}
