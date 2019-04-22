package com.dzqc.student.utils;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

import com.dzqc.student.R;

import android.annotation.SuppressLint;
import android.content.Context;

@SuppressLint("SimpleDateFormat")
public class AppTimeUtils {

	// string To date
	public static Date parseDate(String jsonTime) {
		try {
			SimpleDateFormat format = new SimpleDateFormat(
					"yyyy-MM-dd HH:mm:ss");
			return format.parse(jsonTime);
		} catch (ParseException e) {
			return new Date();
		}
	}

	/**针对PHP生成的10位时间戳
	 * 转换10位时间戳工具，返回String的“yyyy”年份
	 * @param datetime int型10位时间戳
	 */
	public static String formatDate(String datetime){
		SimpleDateFormat sdf = null;
		String dateTime = null;                 
		try {
			sdf = new SimpleDateFormat("yyyy");
			String strDatatime = datetime+"000";
		    Long lDatatime = Long.parseLong(strDatatime);
		    dateTime = sdf.format(lDatatime);
		} catch (Exception e) {
			//TODO 处理异常
			e.printStackTrace();
		}
		return dateTime;
	}

	/**针对PHP生成的10位时间戳
	 * 转换10位时间戳工具，返回String的“yyyy-MM-dd HH:mm:ss”时间
	 * @param datetime int型10位时间戳
	 */
	public static String millsToDate(String mills) {
		SimpleDateFormat sdf = null;
		String dateTime = null;                 
		try {
			sdf = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
			String strDatatime = mills+"000";
		    Long lDatatime = Long.parseLong(strDatatime);
		    dateTime = sdf.format(lDatatime);
		} catch (Exception e) {
			//TODO 处理异常
			e.printStackTrace();
		}
		return dateTime;
	}
	
	/**针对PHP生成的10位时间戳
	 * 转换10位时间戳工具，返回String的“yyyy-MM-dd”时间
	 * @param datetime int型10位时间戳
	 */
	public static String millsToDateFormat(String mills) {
		SimpleDateFormat sdf = null;
		String dateTime = null;                 
		try {
			sdf = new SimpleDateFormat("yyyy-MM-dd");
			String strDatatime = mills+"000";
		    Long lDatatime = Long.parseLong(strDatatime);
		    dateTime = sdf.format(lDatatime);
		} catch (Exception e) {
			//TODO 处理异常
			e.printStackTrace();
		}
		return dateTime;
	}
/*
	// date To string
	public static String formatDateleng(Date jsonDate) {
		return formatDate(jsonDate, "yyyy-MM-dd HH:mm");
	}
*/
	// date To string
	public static String formatDate(Date jsonDate) {
		return formatDate(jsonDate, "yyyy-MM-dd");
	}

	// 日期格式化
	public static String formatDate(Date jsonDate, String pattern) {
		SimpleDateFormat format = new SimpleDateFormat(pattern);
		return format.format(jsonDate);
	}

	/*******
	 * 设置日期想显示格式 说明：今天显示为“HH:mm”;昨天显示为“昨天 HH:mm”;2~4天显示为“星期几
	 * HH:mm”;5天以后显示为“yy/MM/dd HH:mm”
	 **********/
	@SuppressWarnings("deprecation")
	public static String getInitTimeString(Context context, String jsonTime) {
		String str = "";
		if (jsonTime != null) {
			Date nowDate = new Date();
			Date jsonDate = parseDate(jsonTime);
			int yearGap = nowDate.getYear() - jsonDate.getYear();
			int monthGap = nowDate.getMonth() - jsonDate.getMonth();
			int dateGap = nowDate.getDate() - jsonDate.getDate();
			if (yearGap == 0 && monthGap == 0 && dateGap == 0) {
				SimpleDateFormat format = new SimpleDateFormat(
						context.getString(R.string.talk_today_format));
				str = format.format(jsonDate);
			} else if (yearGap == 0 && monthGap == 0 && dateGap == 1) {
				SimpleDateFormat format = new SimpleDateFormat(
						context.getString(R.string.talk_yesterday_format));
				str = format.format(jsonDate);
			} else if (yearGap == 0 && monthGap == 0 && dateGap < 5) {
				Calendar cal = Calendar.getInstance();
				cal.setTime(jsonDate);
				SimpleDateFormat format = new SimpleDateFormat(
						context.getString(R.string.talk_today_format));
				str = getWeekText(context, cal.get(Calendar.DAY_OF_WEEK)) + " "
						+ format.format(jsonDate);
			} else {
				SimpleDateFormat format = new SimpleDateFormat(
						context.getString(R.string.talk_date_format));
				str = format.format(jsonDate);
			}
			return str;
		}
		return jsonTime;
	}

	public static String getWeekText(Context context, int day) {
		int resId;
		switch (day) {
		case 2:
			resId = R.string.monday;
			break;
		case 3:
			resId = R.string.tuesday;
			break;
		case 4:
			resId = R.string.wednesday;
			break;
		case 5:
			resId = R.string.thursday;
			break;
		case 6:
			resId = R.string.friday;
			break;
		case 7:
			resId = R.string.saturday;
			break;
		default:
			resId = R.string.sunday;
		}
		return context.getResources().getString(resId);
	}

}
