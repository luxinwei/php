package com.dzqc.student.ui.innovation;

import com.dzqc.student.R;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

public class InnovationPublishActivity extends BaseActivity implements
		OnClickListener {
	private ImageView imgBack;
	private TextView tvHeader;

	private EditText etPublishTitle, etPublishContent;
	private TextView  tvNextStep;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.innovation_publish_layout);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.innovation_publish_step));
	}

	private void initView() {
		etPublishTitle = (EditText) findViewById(R.id.et_publistTitle);
		etPublishContent = (EditText) findViewById(R.id.et_publistContent);

		tvNextStep = (TextView) findViewById(R.id.tv_publish_Step);
		tvNextStep.setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tv_publish_Step:
			if (isEmpty()) {
				Intent pubIntent=new Intent(this, InnovationSendSelectActivity.class);
				Bundle bundle1=new Bundle();
				bundle1.putString("title", etPublishTitle.getText().toString());
				bundle1.putString("content", etPublishContent.getText().toString());
				pubIntent.putExtra("bundle1", bundle1);
				startActivity(pubIntent);
			}else {
				ToastUtils.showToast("请输入有效值");
			}
			break;
		case R.id.img_registerBack:
			AppManager.getAppManager().finishActivity(InnovationPublishActivity.this);
			break;
		default:
			break;
		}
	}
	//非空判断
	private boolean isEmpty()
	{
		if (etPublishTitle.getText().toString().equals("")||etPublishContent.getText().toString().equals("")) {
			return false;
		}else {
			return true;
		}
	}
}
