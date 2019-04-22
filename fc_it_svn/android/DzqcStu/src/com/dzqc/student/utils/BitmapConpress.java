package com.dzqc.student.utils;

/******
 * 图片压缩处理类
 * ********/
import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Matrix;

public class BitmapConpress {
	// 压缩图片的采样率（图片大小）
	public static Bitmap compressImage(Bitmap image, int size) {
		ByteArrayOutputStream baos = new ByteArrayOutputStream();
		Bitmap bitmap = null;
		if (image != null) {
			// 质量压缩方法，这里100表示不压缩，把压缩后的数据存放到baos中
			image.compress(Bitmap.CompressFormat.JPEG, 100, baos);
			int options = 100;
			// 循环判断如果压缩后图片是否大于options，大于继续压缩
			while (baos.toByteArray().length / 1024 > size) {
				// 重置baos即清空baos
				baos.reset();
				// 这里压缩options%，把压缩后的数据存放到baos中
				image.compress(Bitmap.CompressFormat.JPEG, options, baos);
				options -= 10;
			}
			// 把压缩后的数据baos存放到ByteArrayInputStream中
			ByteArrayInputStream isBm = new ByteArrayInputStream(baos.toByteArray());
			// 把ByteArrayInputStream数据生成图片
			bitmap = BitmapFactory.decodeStream(isBm, null, null);
			try {
				if (!image.isRecycled()) {
					baos.close();
					isBm.close();
				}
			} catch (Exception e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
		return bitmap;
	}

	/***
	 * 压缩图片的大小（压缩图片的长宽） 参数：图片路径，需要显示的高、宽、需要在内存占用的大小
	 * ***/
	public static Bitmap getimage(String srcPath, float height, float width, int size) {

		BitmapFactory.Options newOpts = new BitmapFactory.Options();
		// 开始读入图片，此时把options.inJustDecodeBounds 设回true了
		newOpts.inJustDecodeBounds = true;
		Bitmap bitmap = BitmapFactory.decodeFile(srcPath, newOpts);// 此时返回bm为空
		newOpts.inJustDecodeBounds = false;
		int w = newOpts.outWidth;
		int h = newOpts.outHeight;
		// 缩放比。由于是固定比例缩放，只用高或者宽其中一个数据进行计算即可
		int be = 1;// be=1表示不缩放
		if (w > width || h > height) {
			int w_be = (int) (w / width);
			int h_be = (int) (h / height);
			be = w_be > h_be ? w_be : h_be;
			while ((h / be) < DensityUtils.dp2Px(DzqcStu.getInstance(), 50) && be > 0) {
				be--;
			}
		}
		if (be <= 0)
			be = 1;
		// 设置缩放比例
		newOpts.inSampleSize = be;
		// 重新读入图片，注意此时已经把options.inJustDecodeBounds 设回false了
		bitmap = BitmapFactory.decodeFile(srcPath, newOpts);
		if (bitmap != null) {
			Bitmap outBitmap = fitTheScreenSizeImage(bitmap, width, height);
			// 压缩好比例大小后再进行质量压缩
			return compressImage(outBitmap, size);
		} else
			return BitmapFactory.decodeResource(DzqcStu.getInstance().getResources(), R.drawable.error_img);
	}

	// 设置图片的长宽满足特定大小
	public static Bitmap fitTheScreenSizeImage(Bitmap m, float width, float height) {
		if (m != null) {
			int hh = m.getHeight();
			float csale = 1;
			float w = width / m.getWidth();
			float h = height / hh;
			csale = w > h ? h : w;
			while (hh * csale < DensityUtils.dp2Px(DzqcStu.getInstance(), 50)) {
				csale += 0.1f;
			}
			Matrix matrix = new Matrix();
			matrix.postScale(csale, csale);
			return Bitmap.createBitmap(m, 0, 0, m.getWidth(), m.getHeight(), matrix, true);
		} else
			return null;
	}
}
