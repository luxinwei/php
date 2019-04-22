package com.dzqc.enterprise.utils;

import com.dzqc.enterprise.config.DzqcEnterprise;

import android.graphics.Bitmap;
import android.graphics.Bitmap.Config;
import android.graphics.Canvas;
import android.graphics.Paint;
import android.graphics.PorterDuff.Mode;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.PorterDuffXfermode;
import android.graphics.Rect;
import android.graphics.RectF;
import android.widget.ImageView;

public class BitmapToRound {
	// 图片设置圆角方法
	public static void toRoundCorner(ImageView iv, int pixels) {
		pixels = DensityUtils.dp2Px(DzqcEnterprise.getInstance(), pixels);
		if (iv.getDrawable() != null) {
			Bitmap bitmap = ((BitmapDrawable) (iv.getDrawable())).getBitmap();
			Bitmap output = Bitmap.createBitmap(bitmap.getWidth(),
					bitmap.getHeight(), Config.ARGB_8888);
			Canvas canvas = new Canvas(output);
			final int color = 0xff424242;
			final Paint paint = new Paint();
			final Rect rect = new Rect(0, 0, bitmap.getWidth(),
					bitmap.getHeight());
			final RectF rectF = new RectF(rect);
			final float roundPx = pixels;
			paint.setAntiAlias(true);
			canvas.drawARGB(0, 0, 0, 0);
			paint.setColor(color);
			canvas.drawRoundRect(rectF, roundPx, roundPx, paint);
			paint.setXfermode(new PorterDuffXfermode(Mode.SRC_IN));
			canvas.drawBitmap(bitmap, rect, rect, paint);
			iv.setImageBitmap(output);
		}
	}

}
