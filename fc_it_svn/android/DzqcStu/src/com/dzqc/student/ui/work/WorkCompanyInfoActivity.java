package com.dzqc.student.ui.work;

import java.util.HashMap;
import java.util.Map;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.CompanyInfoMode;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.SubmitDialog;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class WorkCompanyInfoActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvComRegMoney, tvComFaRen, tvComRunNo, tvComRunPhone,
	tvComType,tvComLocation,tvComRealName;
	
	private String comId;//企业ID
	private String comName,comPosition;
	private RelativeLayout rb_historyComment;
	
	private ProgressDialog pd;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.company_info);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();

		Intent intent = getIntent();
		if (intent!=null) {
			comId=intent.getStringExtra("comId");
		}
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
	}

	private void initView() {
		tvComRegMoney = (TextView) findViewById(R.id.tvComRegMoney);
		tvComFaRen = (TextView) findViewById(R.id.tvComFaRen);
		tvComRunNo = (TextView) findViewById(R.id.tvComRunSign);
		tvComRunPhone = (TextView) findViewById(R.id.tvComRunPhone);
		tvComType = (TextView) findViewById(R.id.tvComType);
		tvComLocation = (TextView) findViewById(R.id.tvComLocation);
		tvComRealName=(TextView) findViewById(R.id.tvComRealName);
		
		rb_historyComment=(RelativeLayout) findViewById(R.id.rb_historyComment);
		rb_historyComment.setOnClickListener(this);
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		pd = SubmitDialog.getProgressDialog(this, "请等待");
		pd.show();
		loadInfo();// 加载信息
	}

	private void loadInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("id", comId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.CompanyInfo,
				Urls.MethodType.GET, Urls.function.comdetail, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取企业详情返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<CompanyInfoMode>() {
						}.getType();
						CompanyInfoMode comBean = gson.fromJson(response,
								type);
						if (comBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(comBean.getToken());
							com.dzqc.student.model.CompanyInfoMode.Data comInfo=comBean.getData();
							tvComRunPhone.setText(comInfo.getOperators_phone());
							tvComFaRen.setText(comInfo.getLega_lperson());
							tvComRunNo.setText(comInfo.getReg_number());
							tvComRegMoney.setText(comInfo.getMoney());
							
							tvComType.setText(comInfo.getIndustry());
							tvComLocation.setText(comInfo.getSeat_of());
							tvComRealName.setText(comInfo.getCard_name());
							
							comName=comInfo.getCompanyname();
							tvHeader.setText(comName);
						}else {
							ToastUtils.showToast(comBean.getInfo());
						}
						if (pd.isShowing()) {
							pd.cancel();
						}
					}
					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.img_registerBack:
			AppManager.getAppManager().finishActivity(WorkCompanyInfoActivity.this);
			break;
		case R.id.rb_historyComment:
			Intent infoIntent=new Intent(this, WorkHistoryActivity.class);
			infoIntent.putExtra("comId", comId);
			startActivity(infoIntent);
			break;
		default:
			break;
		}
	}
}
