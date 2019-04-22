package com.dzqc.student.utils;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;

public class SafeProgressDialog extends ProgressDialog {
	 private Activity parentActivity;
	 /**
	  * 重写dismiss方法,防止其Activity被destroy后调用此方法报错
	  */
	 public SafeProgressDialog(Context context) {
	  super(context);
	  parentActivity = (Activity) context;
	 }
	 @Override
	 public void dismiss() {
	  if (parentActivity != null && !parentActivity.isFinishing()) {
	   super.dismiss();
	  }
	 }


}
