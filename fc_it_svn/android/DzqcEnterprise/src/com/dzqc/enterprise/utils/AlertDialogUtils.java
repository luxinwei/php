package com.dzqc.enterprise.utils;

import com.dzqc.enterprise.R;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.TextView;

public class AlertDialogUtils {

	public static void show(Context context, int messageRes, int positiveRes) {
		AlertDialog.Builder builder = new AlertDialog.Builder(context);
		builder.setMessage(messageRes);
		builder.setPositiveButton(positiveRes, null);
		builder.create().show();
	}

	public static void show(Context context, int title, int message, int positiveRes, DialogInterface.OnClickListener listener) {
		AlertDialog.Builder builder = new AlertDialog.Builder(context);
		builder.setTitle(title);
		builder.setMessage(message);
		builder.setPositiveButton(positiveRes, listener);
		builder.setNegativeButton(R.string.cancel, null);
		builder.create().show();
	}

	public static void show(Context context, int title, int message, int positiveRes, DialogInterface.OnClickListener listener, int negativeRes, DialogInterface.OnClickListener cancelListener) {
		AlertDialog.Builder builder = new AlertDialog.Builder(context);
		builder.setTitle(title);
		builder.setMessage(message);
		builder.setPositiveButton(positiveRes, listener);
		builder.setNegativeButton(negativeRes, cancelListener);
		builder.create().show();
	}

	public static void show(Context context, int message, int positiveRes, DialogInterface.OnClickListener listener) {
		View view = LayoutInflater.from(context).inflate(R.layout.view_dialog_string, null, false);
		AlertDialog.Builder builder = new AlertDialog.Builder(context);
		builder.setView(view);
		((TextView) view.findViewById(R.id.txt_message)).setText(message);
		builder.setPositiveButton(positiveRes, listener);
		builder.setNegativeButton(R.string.cancel, null);
		builder.create().show();
	}

}
