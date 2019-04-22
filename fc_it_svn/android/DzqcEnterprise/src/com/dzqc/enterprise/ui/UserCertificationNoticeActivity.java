package com.dzqc.enterprise.ui;

import com.dzqc.enterprise.R;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

public class UserCertificationNoticeActivity extends BaseActivity{

	private TextView tvHeader,tvConfirm;
	private ImageView imgBack;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.user_certification_notice);
		
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.certification_company_title));
		imgBack=(ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				UserCertificationNoticeActivity.this.finish();
			}
		});
		
		tvConfirm=(TextView) findViewById(R.id.tv_confirm);
		tvConfirm.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				startActivity(new Intent(UserCertificationNoticeActivity.this, UserCertificationState.class));
				UserCertificationNoticeActivity.this.finish();
			}
		});
	}

}
