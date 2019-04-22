package com.dzqc.enterprise.ui;

import java.util.ArrayList;
import java.util.List;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.ui.listener.PhoneEditTextWatcher;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

public class UserCertificationActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;
	
	private EditText etCompanyName,etCompanyNo,etCompanyMoney,etOwner;
	private TextView tvCheck,tvStep;
	private TextView tvCertifiCancer;//取消认证
	
	private String comName,comNo,comMoney,comOwnerName,comMainCheck;
	
	private RelativeLayout rl_errorInfo;
	// 认证状态
	private String statusRes;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.user_certification);
		
		initView();
		
		Intent intent = getIntent();
		if (intent != null) {
			statusRes = intent.getStringExtra("status");
			if (statusRes != null)
				if (statusRes.equals("30")) {
					rl_errorInfo.setVisibility(View.VISIBLE);
				} else {
					rl_errorInfo.setVisibility(View.GONE);
				}
		}
	}
	private void initView()
	{
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.certification_company_title));
		
		rl_errorInfo = (RelativeLayout) findViewById(R.id.rl_errorInfo);
		etCompanyName=(EditText) findViewById(R.id.et_companyName);
		etCompanyNo=(EditText) findViewById(R.id.et_companyNo);
		etCompanyMoney=(EditText) findViewById(R.id.et_companyMoney);
		etOwner=(EditText) findViewById(R.id.et_companyOwnerName);
		
		tvCertifiCancer=(TextView) findViewById(R.id.tvRight);
		tvCertifiCancer.setOnClickListener(this);
		tvCertifiCancer.setVisibility(View.VISIBLE);
		
		tvCheck=(TextView) findViewById(R.id.tv_mainCheck);
		tvStep=(TextView) findViewById(R.id.tv_certification_step1);
		tvStep.setOnClickListener(this);
		
		addEditTextListener();
	}
	/**
	 * 给EditText添加监听事件，判断注册按钮能否点击
	 */
	private void addEditTextListener() {
		List<EditText> listName = new ArrayList<EditText>();
		listName.add(etCompanyNo);
		listName.add(etCompanyMoney);
		listName.add(etOwner);
		etCompanyName.addTextChangedListener(new PhoneEditTextWatcher(tvStep,
				listName));
		List<EditText> listNo = new ArrayList<EditText>();
		listNo.add(etCompanyName);
		listNo.add(etCompanyMoney);
		listNo.add(etOwner);
		etCompanyNo.addTextChangedListener(new PhoneEditTextWatcher(
				tvStep, listNo));
		List<EditText> listMoney = new ArrayList<EditText>();
		listMoney.add(etCompanyName);
		listMoney.add(etCompanyNo);
		listMoney.add(etOwner);
		etCompanyMoney.addTextChangedListener(new PhoneEditTextWatcher(tvStep ,
				listMoney));
		List<EditText> listOwner = new ArrayList<EditText>();
		listOwner.add(etCompanyName);
		listOwner.add(etCompanyNo);
		listOwner.add(etCompanyMoney);
		etOwner.addTextChangedListener(new PhoneEditTextWatcher(tvStep,
				listOwner));
	}

	
	
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tv_mainCheck:
			
			break;
		case R.id.tv_certification_step1://下一步
			comName=etCompanyName.getText().toString();
			comNo=etCompanyNo.getText().toString();
			comMoney=etCompanyMoney.getText().toString();
			comOwnerName=etOwner.getText().toString();
			Bundle bundleOne=new Bundle();
			bundleOne.putString("comName", comName);
			bundleOne.putString("comNo", comNo);
			bundleOne.putString("comMoney", comMoney);
			bundleOne.putString("comOwnerName", comOwnerName);
			Intent oneIntent=new Intent(UserCertificationActivity.this, UserCertificationStepActivity.class);
			oneIntent.putExtra("bundleOne", bundleOne);
			startActivity(oneIntent);
			break;
		case R.id.tvRight:
			startActivity(new Intent(UserCertificationActivity.this, MainActivity.class));
			this.finish();
			break;
		default:
			break;
		}
	}
}
