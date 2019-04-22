package com.dzqc.student.ui.mine;

import java.util.HashMap;
import java.util.Map;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class UserContactModifyPhone extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private String userId;
	
	private TextView tvSubmit,tvSendCode;
	private EditText etNewPhone,etCode;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.personal_contact_modify_phone);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();

		Intent intent = getIntent();
		if (intent!=null) {
			userId=intent.getStringExtra("userId");
		}
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.mine_modify_phone));
	}

	private void initView() {
		tvSubmit = (TextView) findViewById(R.id.tv_phoneSubmit);
		tvSendCode = (TextView) findViewById(R.id.tv_checkCode);
		etNewPhone = (EditText) findViewById(R.id.et_newPhone);
		etCode = (EditText) findViewById(R.id.et_phoneCode);
		tvSubmit.setOnClickListener(this);
		tvSendCode.setOnClickListener(this);
		//submitInfo();
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
	}

	
	/**
	 * 提交修改phone
	 */
	private void submitInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("userId", userId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.addComment,
				Urls.MethodType.GET, Urls.function.addComment, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("提交修改email返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel submitBean = gson.fromJson(response,
								type);
						if (submitBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(submitBean.getToken());
						}else {
							ToastUtils.showToast(submitBean.getInfo());
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
			AppManager.getAppManager().finishActivity(UserContactModifyPhone.this);
			break;
		case R.id.tv_phoneSubmit://提交修改
			break;
		case R.id.tv_checkCode://发送验证码
			break;
		default:
			break;
		}
	}
}
