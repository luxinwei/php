package com.dzqc.student.utils;

import java.util.ArrayList;

import com.dzqc.student.config.DzqcStu;

import android.database.Cursor;
import android.provider.MediaStore;
import android.provider.MediaStore.MediaColumns;
import android.text.TextUtils;

public class FileSearchUtil {
	// 获取所有的.apk文件
	public static ArrayList<String> apkSearch() {
		ArrayList<String> arrayList = new ArrayList<String>();
		String selection = "(" + MediaColumns.DATA + " like '%.apk')";
		Cursor mCursor = DzqcStu.getInstance().getContentResolver().query(MediaStore.Files.getContentUri("external"), null, selection, null, null);
		while (mCursor.moveToNext()) {
			String fileName = mCursor.getString(mCursor.getColumnIndex(MediaColumns.DATA));
			if (TextUtils.isEmpty(fileName))
				arrayList.add(fileName);
		}
		return arrayList;
	}
}
