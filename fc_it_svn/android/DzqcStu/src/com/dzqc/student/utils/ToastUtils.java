package com.dzqc.student.utils;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;

import android.view.Gravity;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Toast;

public class ToastUtils {

	private static Toast toast;

	public static void showToast(String text) {
		if (toast == null) {
			toast = Toast.makeText(DzqcStu.getInstance(), text,
					Toast.LENGTH_SHORT);
		} else {
			toast.setText(text);
		}
		toast.setGravity(Gravity.CENTER, 0, 0);
		toast.show();
	}

	public static void showToast(int textRes) {
		if (toast == null) {
			toast = Toast.makeText(DzqcStu.getInstance(), textRes,
					Toast.LENGTH_SHORT);
		} else {
			toast.setText(textRes);
		}
		toast.setGravity(Gravity.CENTER, 0, 0);
		toast.show();
	}

	public static void showImageToast(int textRes, int imgId) {
		Toast imgToast = Toast.makeText(DzqcStu.getInstance(), "已完成",
				Toast.LENGTH_LONG);
		toast.setGravity(Gravity.CENTER, 0, 0);
		LinearLayout toastView = (LinearLayout) toast.getView();
		ImageView imageCodeProject = new ImageView(DzqcStu.getInstance());
		imageCodeProject.setImageResource(R.drawable.scan_left_top);
		toastView.addView(imageCodeProject, 0);
		imgToast.show();
	}

	public static void showAnimToast(String textRes)
	{
		SubmitDialog.getProgressDialog(DzqcStu.getInstance(), textRes);
	}
}
