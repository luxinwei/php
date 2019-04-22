package com.dzqc.student.utils;

import java.io.IOException;
import java.security.GeneralSecurityException;
import java.util.Arrays;
import java.util.Map;

import javax.crypto.Mac;
import javax.crypto.SecretKey;
import javax.crypto.spec.SecretKeySpec;

import android.annotation.SuppressLint;
import android.util.Log;

import com.dzqc.student.config.Constants;
import com.dzqc.student.config.DzqcStu;

public class SignUtils {

	public static String signTopRequest(Map<String, String> params, String secret, String signMethod,String jiafunction) throws IOException {
	
		// 第一步：检查参数是否已经排序
	    String[] keys = params.keySet().toArray(new String[0]);
	    Arrays.sort(keys);
	 
	    // 第二步：把所有参数名串在一起
	    StringBuilder query = new StringBuilder();
	   
	    for (String key : keys) {
	        String value = params.get(key);
	        if (!key.isEmpty()&&!value.isEmpty()) {
	            query.append(key);
	        }
	    }
	    if (com.dzqc.student.config.Constants.SIGN_METHOD_MD5.equals(signMethod)) {
	        query.append(secret);
	    }
	    query.append(jiafunction);
	    if (DzqcStu.isDebug) {
			Log.i("==》参数加密后字符串", query.toString());
	    }
	    // 第三步：使用MD5/HMAC加密
	    byte[] bytes;
	    if (com.dzqc.student.config.Constants.SIGN_METHOD_HMAC.equals(signMethod)) {
	        bytes = encryptHMAC(query.toString(), secret);
	    } else {
	        bytes = encryptMD5(query.toString());
	    }
	
	    // 第四步：把二进制转化为十六进制
	    return byte2hex(bytes);
	}
	
	public static byte[] encryptHMAC(String data, String secret) throws IOException {
	    byte[] bytes = null;
	    try {
	        SecretKey secretKey = new SecretKeySpec(secret.getBytes(Constants.CHARSET_UTF8), "HmacMD5");
	        Mac mac = Mac.getInstance(secretKey.getAlgorithm());
	        mac.init(secretKey);
	        bytes = mac.doFinal(data.getBytes(Constants.CHARSET_UTF8));
	    } catch (GeneralSecurityException gse) {
	        throw new IOException(gse.toString());
	    }
	    return bytes;
	}
	
	public static byte[] encryptMD5(String data) throws IOException {
		return MD5Utils.encryptMD5(data.getBytes(Constants.CHARSET_UTF8));
		}
	
	@SuppressLint("DefaultLocale") public static String byte2hex(byte[] bytes) {
	    StringBuilder sign = new StringBuilder();
	    for (int i = 0; i < bytes.length; i++) {
	        String hex = Integer.toHexString(bytes[i] & 0xFF);
	        if (hex.length() == 1) {
	            sign.append("0");
	        }
	        sign.append(hex);
	    }
	    
	    if (DzqcStu.isDebug) {
			Log.i("--->动态编码", sign.toString());
		}
	    return sign.toString();
	}
}
