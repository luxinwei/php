package com.dzqc.student.utils;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;

import com.dzqc.student.config.Constants;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.PorterDuffXfermode;
import android.graphics.Rect;
import android.graphics.RectF;
import android.graphics.Bitmap.CompressFormat;
import android.graphics.Bitmap.Config;
import android.graphics.PorterDuff.Mode;
import android.os.Environment;
import android.util.Base64;
import android.util.Log;

public class FilesUtils {

	public static void downloadBitmap(Bitmap bm, String picName) {
		// Log.e("", "保存图片");
		try {
			File dir = new File(Constants.filePath);
			if (!dir.exists()) {
				dir.mkdirs();
			}
			File f = new File(Constants.filePath, picName + ".JPEG");
			if (f.exists()) {
				f.delete();
			}
			FileOutputStream out = new FileOutputStream(f);
			bm.compress(Bitmap.CompressFormat.JPEG, 90, out);
			out.flush();
			out.close();
			Log.e("", "已经保存");
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (NullPointerException e) {
			// TODO: handle exception
			e.printStackTrace();
		}
	}

	public static void saveBitmap(Bitmap bm, String picName) {
		// Log.e("", "保存图片");
		try {
			File f = new File(Constants.filePath + "/", picName + ".JPEG");
			if (f.exists()) {
				f.delete();
			}
			FileOutputStream out = new FileOutputStream(f);
			bm.compress(Bitmap.CompressFormat.JPEG, 100, out);
			out.flush();
			out.close();
			Log.e("", "已经保存");
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (NullPointerException e) {
			// TODO: handle exception
			e.printStackTrace();
		}
	}

	public static File createSDDir(String dirName) throws IOException {
		File dir = new File(Constants.filePath + dirName);
		if (Environment.getExternalStorageState().equals(
				Environment.MEDIA_MOUNTED)) {
			System.out.println("createSDDir:" + dir.getAbsolutePath());
			System.out.println("createSDDir:" + dir.mkdir());
		}
		return dir;
	}

	public static boolean isFileExist(String fileName) {
		File file = new File(Constants.filePath + fileName);
		file.isFile();
		return file.exists();
	}

	public static void delFile(String fileName) {
		File file = new File(Constants.filePath + fileName);
		if (file.isFile()) {
			file.delete();
		}
		file.exists();
	}

	public static void deleteDir() {
		File dir = new File(Constants.filePath);
		if (dir == null || !dir.exists() || !dir.isDirectory())
			return;

		for (File file : dir.listFiles()) {
			if (file.isFile())
				file.delete(); // 删除所有文件
			else if (file.isDirectory())
				deleteDir(); // 递规的方式删除文件夹
		}
		dir.delete();// 删除目录本身
	}

	public static boolean fileIsExists(String path) {
		try {
			File f = new File(path);
			if (!f.exists()) {
				return false;
			}
		} catch (Exception e) {
			return false;
		}
		return true;
	}

	/*
	 * 字符串转换成bitmap
	 * 
	 * @param str
	 * 
	 * @return
	 */
	public static Bitmap convertStringToBitmap(String str) {
		Bitmap bitmap = null;
		try {

			byte[] bitmapArray = Base64.decode(str, Base64.NO_WRAP);
			bitmap = BitmapFactory.decodeByteArray(bitmapArray, 0,
					bitmapArray.length);
		} catch (Exception e) {
			// TODO: handle exception
		}
		return bitmap;
	}

	/*
	 * bitmap转换成string
	 */
	public static String bitmapToString(Bitmap bitmap2) {
		// TODO Auto-generated method stub
		ByteArrayOutputStream baos = new ByteArrayOutputStream();// outputstream
		bitmap2.compress(CompressFormat.JPEG, 100, baos);
		byte[] appicon = baos.toByteArray();// 转为byte数组
		return Base64.encodeToString(appicon, Base64.NO_WRAP);
	}

	/*
	 * 将图片切为圆形
	 * 
	 * @param bitmap
	 * 
	 * @param pix
	 * 
	 * @return
	 */
	public static Bitmap toOvalBitmap(Bitmap bitmap, float pix) {
		try {
			Bitmap output = Bitmap.createBitmap(bitmap.getHeight(),
					bitmap.getWidth(), Config.ARGB_8888);
			Canvas canvas = new Canvas(output);
			Paint paint = new Paint();
			Rect rect = new Rect(0, 0, bitmap.getWidth(), bitmap.getWidth());
			RectF rectF = new RectF(rect);
			float roundPx = pix;
			paint.setAntiAlias(true);
			canvas.drawARGB(0, 0, 0, 0);
			int color = 0xff424242;
			paint.setColor(color);
			canvas.drawOval(rectF, paint);
			canvas.drawRoundRect(rectF, roundPx, roundPx, paint);
			paint.setXfermode(new PorterDuffXfermode(Mode.SRC_IN));
			canvas.drawBitmap(bitmap, rect, rect, paint);
			return output;
		} catch (Exception e) {
			// TODO: handle exception
			return null;
		}
	}

	public static Bitmap toRoundBitmap(Bitmap bitmap) {
		if (bitmap != null) {
			int width = bitmap.getWidth();
			int height = bitmap.getHeight();
			final int color = Color.parseColor("#00FF00");
			float roundPx;
			float left, top, right, bottom, dst_left, dst_top, dst_right, dst_bottom;
			if (width <= height) {
				roundPx = width / 2;
				left = 0;
				top = 0;
				right = width;
				bottom = width;
				height = width;
				dst_left = 0;
				dst_top = 0;
				dst_right = width;
				dst_bottom = width;
			} else {
				roundPx = height / 2;
				float clip = (width - height) / 2;
				left = clip;
				right = width - clip;
				top = 0;
				bottom = height;
				width = height;
				dst_left = 0;
				dst_top = 0;
				dst_right = height;
				dst_bottom = height;
			}

			Bitmap output = Bitmap.createBitmap(width, height, Config.ARGB_8888);
			Canvas canvas = new Canvas(output);

			final Paint paint = new Paint();
			paint.setAntiAlias(true);

			final Rect src = new Rect((int) left, (int) top, (int) right,(int) bottom);
			final Rect dst = new Rect((int) dst_left, (int) dst_top,(int) dst_right, (int) dst_bottom);
			canvas.drawARGB(0, 0, 0, 0);
			paint.setColor(color);
			paint.setDither(true);

			canvas.drawCircle(roundPx, roundPx, roundPx, paint);
			paint.setXfermode(new PorterDuffXfermode(android.graphics.PorterDuff.Mode.SRC_IN));
			canvas.drawBitmap(bitmap, src, dst, paint);
			return output;
		}
		else
			return null;
	}
	
	public static boolean deleteUserInfo() {
		try {
			//1.67版本前生成的文件夹
				String path = Constants.userIcon;
				File dir = new File(path);
				if (dir.exists()) {
					 File[] childFiles = dir.listFiles(); 
					for (int i = 0; i < childFiles.length; i++) {  
						if (childFiles[i].isFile()) {  
							childFiles[i].delete();  
						}  
					  }  
					dir.delete();
				}
		} catch (Exception e) {
			return false;
		}
		return true;
	}
}
