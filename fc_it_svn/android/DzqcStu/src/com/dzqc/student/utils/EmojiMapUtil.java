package com.dzqc.student.utils;

import java.util.LinkedHashMap;
import android.text.TextUtils;

public final class EmojiMapUtil {

	public static LinkedHashMap<String, String> map = new LinkedHashMap<String, String>();

	public static String replaceEmoji(String message) {
		if (TextUtils.isEmpty(message))
			return "";
		StringBuilder sb = new StringBuilder();
		String[] strs = message.split("【");
		sb.append(strs[0]);
		int len = strs.length;
		for (int i = 1; i < len; i++) {
			int L = strs[i].length();
			if (L >= 5)
				sb.append(stringToEmoji("【" + strs[i].substring(0, 5)) + strs[i].substring(5, L));
			else
				sb.append("【" + strs[i]);
		}
		return sb.toString();
	}

	private static String stringToEmoji(String s) {
		if (TextUtils.isEmpty(s))
			return "";
		else if (map.containsKey(s))
			return map.get(s);
		return s;
	}

	static {
		map.put("【F001】", new String(Character.toChars(0x1F620)));
		map.put("【F002】", new String(Character.toChars(0x1F629)));
		map.put("【F003】", new String(Character.toChars(0x1F632)));
		map.put("【F004】", new String(Character.toChars(0x1F61E)));
		map.put("【F005】", new String(Character.toChars(0x1F635)));
		map.put("【F006】", new String(Character.toChars(0x1F630)));
		map.put("【F007】", new String(Character.toChars(0x1F612)));
		map.put("【F008】", new String(Character.toChars(0x1F60D)));
		map.put("【F009】", new String(Character.toChars(0x1F624)));
		map.put("【F010】", new String(Character.toChars(0x1F61C)));
		map.put("【F011】", new String(Character.toChars(0x1F61D)));
		map.put("【F012】", new String(Character.toChars(0x1F60B)));
		map.put("【F013】", new String(Character.toChars(0x1F618)));
		map.put("【F014】", new String(Character.toChars(0x1F61A)));
		map.put("【F015】", new String(Character.toChars(0x1F637)));
		map.put("【F016】", new String(Character.toChars(0x1F633)));
		map.put("【F017】", new String(Character.toChars(0x1F603)));
		map.put("【F018】", new String(Character.toChars(0x1F605)));
		map.put("【F019】", new String(Character.toChars(0x1F606)));
		map.put("【F020】", new String(Character.toChars(0x1F601)));
		map.put("【F021】", new String(Character.toChars(0x1F602)));
		map.put("【F022】", new String(Character.toChars(0x1F60A)));
		map.put("【F023】", new String(Character.toChars(0x263A)));
		map.put("【F024】", new String(Character.toChars(0x1F604)));
		map.put("【F025】", new String(Character.toChars(0x1F622)));
		map.put("【F026】", new String(Character.toChars(0x1F62D)));
		map.put("【F027】", new String(Character.toChars(0x1F628)));
		map.put("【F028】", new String(Character.toChars(0x1F623)));
		map.put("【F029】", new String(Character.toChars(0x1F621)));
		map.put("【F030】", new String(Character.toChars(0x1F60C)));
		map.put("【F031】", new String(Character.toChars(0x1F616)));
		map.put("【F032】", new String(Character.toChars(0x1F614)));
		map.put("【F033】", new String(Character.toChars(0x1F631)));
		map.put("【F034】", new String(Character.toChars(0x1F62A)));
		map.put("【F035】", new String(Character.toChars(0x1F60F)));
		map.put("【F036】", new String(Character.toChars(0x1F613)));
		map.put("【F037】", new String(Character.toChars(0x1F625)));
		map.put("【F038】", new String(Character.toChars(0x1F62B)));
		map.put("【F039】", new String(Character.toChars(0x1F609)));
		map.put("【F040】", new String(Character.toChars(0x1F63A)));
		map.put("【F041】", new String(Character.toChars(0x1F638)));
		map.put("【F042】", new String(Character.toChars(0x1F639)));
		map.put("【F043】", new String(Character.toChars(0x1F63D)));
		map.put("【F044】", new String(Character.toChars(0x1F63B)));
		map.put("【F045】", new String(Character.toChars(0x1F63F)));
		map.put("【F046】", new String(Character.toChars(0x1F63E)));
		map.put("【F047】", new String(Character.toChars(0x1F63C)));
		map.put("【F048】", new String(Character.toChars(0x1F640)));
		map.put("【F049】", new String(Character.toChars(0x1F645)));
		map.put("【F050】", new String(Character.toChars(0x1F646)));
		map.put("【F051】", new String(Character.toChars(0x1F647)));
		map.put("【F052】", new String(Character.toChars(0x1F648)));
		map.put("【F053】", new String(Character.toChars(0x1F64A)));
		map.put("【F054】", new String(Character.toChars(0x1F649)));
		map.put("【F055】", new String(Character.toChars(0x1F64B)));
		map.put("【F056】", new String(Character.toChars(0x1F64C)));
		map.put("【F057】", new String(Character.toChars(0x1F64D)));
		map.put("【F058】", new String(Character.toChars(0x1F64E)));
		map.put("【F059】", new String(Character.toChars(0x1F64F)));
		map.put("【F060】", new String(Character.toChars(0x1F493)));
		map.put("【F061】", new String(Character.toChars(0x1F494)));
		map.put("【F062】", new String(Character.toChars(0x1F495)));
		map.put("【F063】", new String(Character.toChars(0x1F496)));
		map.put("【F064】", new String(Character.toChars(0x1F497)));
		map.put("【F065】", new String(Character.toChars(0x1F498)));
		map.put("【F066】", new String(Character.toChars(0x1F499)));
		map.put("【F067】", new String(Character.toChars(0x1F49A)));
		map.put("【F068】", new String(Character.toChars(0x1F49B)));
		map.put("【F069】", new String(Character.toChars(0x1F49C)));
		map.put("【F070】", new String(Character.toChars(0x1F49D)));
		map.put("【F071】", new String(Character.toChars(0x1F49E)));
		map.put("【F072】", new String(Character.toChars(0x1F49F)));
		map.put("【F073】", new String(Character.toChars(0x270A)));
		map.put("【F074】", new String(Character.toChars(0x270B)));
		map.put("【F075】", new String(Character.toChars(0x270C)));
		map.put("【F076】", new String(Character.toChars(0x1F44A)));
		map.put("【F077】", new String(Character.toChars(0x1F44D)));
		map.put("【F078】", new String(Character.toChars(0x261D)));
		map.put("【F079】", new String(Character.toChars(0x1F446)));
		map.put("【F080】", new String(Character.toChars(0x1F447)));
		map.put("【F081】", new String(Character.toChars(0x1F448)));
		map.put("【F082】", new String(Character.toChars(0x1F449)));
		map.put("【F083】", new String(Character.toChars(0x1F44B)));
		map.put("【F084】", new String(Character.toChars(0x1F44F)));
		map.put("【F085】", new String(Character.toChars(0x1F44C)));
		map.put("【F086】", new String(Character.toChars(0x1F44E)));
		map.put("【F087】", new String(Character.toChars(0x1F450)));
		map.put("【F088】", new String(Character.toChars(0x2600)));
		map.put("【F089】", new String(Character.toChars(0x2601)));
		map.put("【F090】", new String(Character.toChars(0x2614)));
		map.put("【F091】", new String(Character.toChars(0x26C4)));
		map.put("【F092】", new String(Character.toChars(0x26A1)));
		map.put("【F093】", new String(Character.toChars(0x1F300)));
		map.put("【F094】", new String(Character.toChars(0x1F301)));
		map.put("【F095】", new String(Character.toChars(0x1F302)));
		map.put("【F096】", new String(Character.toChars(0x1F340)));
		map.put("【F097】", new String(Character.toChars(0x1F337)));
		map.put("【F098】", new String(Character.toChars(0x1F331)));
		map.put("【F099】", new String(Character.toChars(0x1F341)));
		map.put("【F100】", new String(Character.toChars(0x1F338)));
		map.put("【F101】", new String(Character.toChars(0x1F339)));
		map.put("【F102】", new String(Character.toChars(0x1F342)));
		map.put("【F103】", new String(Character.toChars(0x1F343)));
		map.put("【F104】", new String(Character.toChars(0x1F33A)));
		map.put("【F105】", new String(Character.toChars(0x1F33B)));
		map.put("【F106】", new String(Character.toChars(0x1F334)));
		map.put("【F107】", new String(Character.toChars(0x1F335)));
		map.put("【F108】", new String(Character.toChars(0x1F33E)));
		map.put("【F109】", new String(Character.toChars(0x1F33D)));
		map.put("【F110】", new String(Character.toChars(0x1F344)));
		map.put("【F111】", new String(Character.toChars(0x1F330)));
		map.put("【F112】", new String(Character.toChars(0x1F33F)));

	}
}
