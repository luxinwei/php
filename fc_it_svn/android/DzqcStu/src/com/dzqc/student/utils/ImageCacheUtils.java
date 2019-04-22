package com.dzqc.student.utils;

import android.view.View;

import com.nostra13.universalimageloader.core.ImageLoader;

public class ImageCacheUtils {

	private ImageLoader imageLoader;
	public void onClearMemoryClick(View view) {
		if (imageLoader==null) {
			imageLoader=ImageLoader.getInstance();
		}
		imageLoader.clearMemoryCache(); // 清除内存缓存
	}

	public void onClearDiskClick(View view) {
		if (imageLoader==null) {
			imageLoader=ImageLoader.getInstance();
		}
		imageLoader.clearDiskCache(); // 清除本地缓存
	}
}
