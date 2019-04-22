package com.dzqc.enterprise.ui.mine;

import java.util.HashMap;
import java.util.Map;

import org.json.JSONException;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.model.ResultMode;
import com.dzqc.enterprise.ui.BaseActivity;
import com.dzqc.enterprise.ui.UserCertificationActivity;
import com.dzqc.enterprise.ui.UserCertificationState;
import com.google.gson.Gson;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

public class PersonalInfoActivity extends BaseActivity implements OnClickListener {

	private ImageView imgCertiInfo,imgBack;
	private TextView tvHeader;
	
	private String certiStatus="";
	private ResultMode restltMode;
	private Gson gson;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.user_basic_info);
		
		initView();
	}
	private void  initView()
	{
		imgCertiInfo=(ImageView) findViewById(R.id.img_certificationInfo);
		imgCertiInfo.setOnClickListener(this);
		
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getString(R.string.certification_company_title));
		imgBack=(ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
	}
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.img_certificationInfo:
			getAuthenticationInfo();
			break;
		case R.id.img_registerBack:
			PersonalInfoActivity.this.finish();
			break;
		default:
			break;
		}
	}
	public void getAuthenticationInfo()
	{
		Map<String, String> map=new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.realNameAuthstatus, Urls.MethodType.GET,Urls.function.realNameAuthstatus, map, new HttpCallback() {
			
			@Override
			public void httpSuccess(String response) {
				// TODO Auto-generated method stub
				if (DzqcEnterprise.isDebug) {
					Log.i("查询企业实名认证信息----------》》", response);
				}
				gson=new Gson();
				restltMode=gson.fromJson(response, ResultMode.class);
				certiStatus=restltMode.getStatus();
				if (certiStatus.equals("0")) {
					Intent intent=new Intent(PersonalInfoActivity.this, UserCertificationActivity.class);
					startActivity(intent);
				}else if (certiStatus.equals("10")||certiStatus.equals("20")) {
					startActivity(new Intent(PersonalInfoActivity.this, UserCertificationState.class));
				}else if (certiStatus.equals("30")) {
					Intent intent=new Intent(PersonalInfoActivity.this, UserCertificationActivity.class);
					intent.putExtra("status", "30");
					startActivity(intent);
				}
			}
			
			@Override
			public void httpFail(String response) {
				// TODO Auto-generated method stub
			
			}
			
		});
	}
}
