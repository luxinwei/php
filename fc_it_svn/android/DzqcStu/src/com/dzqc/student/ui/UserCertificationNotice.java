package com.dzqc.student.ui;

import com.dzqc.student.R;
import com.dzqc.student.utils.AppManager;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

public class UserCertificationNotice extends BaseActivity{

	private TextView tvHeader,tvConfirm;
	private ImageView imgBack;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.user_certification_notice);
		AppManager.getAppManager().addActivity(this);
		
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.certificate_header_title));
		imgBack=(ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				UserCertificationNotice.this.finish();
			}
		});
		
		tvConfirm=(TextView) findViewById(R.id.tv_confirm);
		tvConfirm.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				startActivity(new Intent(UserCertificationNotice.this, MainActivity.class));
				AppManager.getAppManager().finishActivity(UserCertificationNotice.this);
			}
		});
	}
}
