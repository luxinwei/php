package com.dzqc.enterprise.utils;

import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;

public class EncodeUtf8 {

	
	public static String toUtf8Format(String str)
	{
		if (str==null) {
			return "";
		}
		try {
			return URLEncoder.encode(str, "UTF-8");
		} catch (UnsupportedEncodingException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
			return "";
		}
	}
}
