package com.dzqc.enterprise.utils;

import java.io.File;
import android.content.Context;
import android.os.Environment;
import android.text.TextUtils;

public class CachePathUtil {

	private static String getRootCachePath(Context context, String rootName) {
		File rootCache = Environment.getExternalStorageDirectory();
		if (rootCache == null || !rootCache.exists()) {
			rootCache = context.getCacheDir();
		}
		return composePath(rootCache.getAbsolutePath(), rootName);
	}

	public static String getImgCachePath(Context context, String rootName) {
		String rootPath = getRootCachePath(context, rootName);
		return composePath(rootPath, "Cache", "Images");
	}

	private static String composePath(String rootPath, String... pattern) {
		for (int i = 0; i < pattern.length; i++) {
			rootPath = composePath(rootPath, pattern[i]);
		}
		return rootPath;
	}

	private static String composePath(String rootPath, String pattern) {
		String regularExpression = "/";
		if (TextUtils.isEmpty(rootPath)) {
			return pattern;
		}
		if (TextUtils.isEmpty(pattern)) {
			return rootPath;
		}
		if (rootPath.endsWith(regularExpression) && pattern.startsWith(regularExpression)) {
			pattern = pattern.substring(1);
			return rootPath + pattern;
		}
		if (!rootPath.endsWith(regularExpression) && !pattern.startsWith(regularExpression)) {
			return rootPath + regularExpression + pattern;
		}
		return rootPath + pattern;
	}

	private static String composeUrl(String rootUrl, String pattern) {
		return composePath(rootUrl, pattern);
	}
}