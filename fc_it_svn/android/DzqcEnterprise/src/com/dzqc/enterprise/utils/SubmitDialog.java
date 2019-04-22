package com.dzqc.enterprise.utils;

import com.dzqc.enterprise.R;

import android.app.ProgressDialog;
import android.content.Context;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;
import android.widget.TextView;

public class SubmitDialog {
	
	public static ProgressDialog getProgressDialog(Context c,String str){
		ProgressDialog pd=new SafeProgressDialog(c);
		pd.setCancelable(true);
		pd.setCanceledOnTouchOutside(false);
		pd.show();
		pd.setContentView(R.layout.progress_load);
		ImageView image=(ImageView) pd.findViewById(R.id.progressLoad_image);
		TextView tv=(TextView) pd.findViewById(R.id.progressLoad_tv);
		tv.setText(str);
		Animation animation=AnimationUtils.loadAnimation(c, R.anim.anim_dialog);
		image.startAnimation(animation);
		return pd;
	}
}
