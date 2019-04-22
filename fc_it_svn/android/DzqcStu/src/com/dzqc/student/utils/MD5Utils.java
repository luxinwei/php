package com.dzqc.student.utils;

import java.io.UnsupportedEncodingException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class MD5Utils {

	//将字符串进行MD5加密，返回加密后的字符串
	public static byte[] encryptMD5(byte[] bt) throws UnsupportedEncodingException {
	    byte[] hash;
	    try {
	        hash = MessageDigest.getInstance("MD5").digest(bt);
	    } catch (NoSuchAlgorithmException e) {
	        throw new RuntimeException("Huh, MD5 should be supported?", e);
	    }

	    return hash;
	  /*  StringBuilder hex = new StringBuilder(hash.length * 2);
	    for (byte b : hash) {
	        if ((b & 0xFF) < 0x10) hex.append("0");
	        hex.append(Integer.toHexString(b & 0xFF));
	    }
	    return (hex.toString()).getBytes(Constants.CHARSET_UTF8);*/
	}
}
