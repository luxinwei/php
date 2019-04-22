package com.dzqc.student.ui;

import java.util.HashMap;
import java.util.Map;

import org.json.JSONException;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.http.Urls.MethodType;
import com.dzqc.student.json.JsonToStrUtils;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.ui.listener.AccountEditTextWatcher;
import com.dzqc.student.ui.listener.PwdEditTextWatcher;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

public class PasswordForget extends BaseActivity implements OnClickListener {

	private EditText etPhone;
	private EditText etSmsCode;
	private TextView tvSmsSend, tvNextStep,tvHeader;
	private int timeNum = 60;// 短信倒计时总时间
	private String phone,smsCode;
	private ImageView rePwdBack;
	
	private boolean timerThread=true;//倒计时线程标示
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.password_forget);
		AppManager.getAppManager().addActivity(this);
		initView();
	}

	@SuppressWarnings("deprecation")
	private void initView() {
		rePwdBack=(ImageView) findViewById(R.id.img_registerBack);
		rePwdBack.setOnClickListener(this);
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.header_forget_pwd));
		
		etPhone = (EditText) findViewById(R.id.et_findPwd_userPhone);
		etSmsCode = (EditText) findViewById(R.id.et_findPwd_ValicateCode);

		tvSmsSend = (TextView) findViewById(R.id.tv_findPwd_sendCode);
		tvSmsSend.setOnClickListener(this);
		tvNextStep = (TextView) findViewById(R.id.tv_nextStep);
		tvNextStep.setOnClickListener(this);
		tvNextStep.setEnabled(false);
		tvNextStep.setBackgroundDrawable(DzqcStu.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));
		
		etPhone.addTextChangedListener(new AccountEditTextWatcher(tvNextStep,etSmsCode));
		etSmsCode.addTextChangedListener(new PwdEditTextWatcher(tvNextStep,etPhone));
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tv_findPwd_sendCode:
			phone = etPhone.getText().toString();
			if (phone.equals("")) {
				ToastUtils.showToast(R.string.alert_telephone_empty);
				return;
			}
			Map<String, String> phonemap=new HashMap<String, String>();
			phonemap.put("mobile", phone);
			phonemap.put("type", Urls.type_find_pwd);
			HttpRequest.HttpPost(Urls.ROOTURL, Method.SendSmsCode,
					MethodType.GET, Urls.function.sendSmsCode, phonemap,
					new HttpCallback() {

						@Override
						public void httpSuccess(String response) {
							// TODO Auto-generated method stub
							Gson gson = new Gson();
							java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
							}.getType();
							NormalResultModel regBean = gson.fromJson(response, type);
							ToastUtils.showToast(regBean.getInfo());
							if (regBean.getStatus().equals("1")) {
								UserInfoKeeper.updToken(regBean.getToken());
								new Thread(new smsTimeThread()).start();
								tvSmsSend.setEnabled(false);
							}
						}

						@Override
						public void httpFail(String response) {
							// TODO Auto-generated method stub

						}
					});
			break;
		case R.id.tv_nextStep:
			smsCodeValidate();
			break;
		case R.id.img_registerBack:
			PasswordForget.this.finish();
			break;
		default:
			break;
		}
	}
	
	/**
	 * 短信验证码有效性判断
	 * 
	 * @return
	 */
	private void smsCodeValidate() {
		smsCode=etSmsCode.getText().toString();
		Map<String, String> checkemap=new HashMap<String, String>();
		checkemap.put("code", smsCode);
		checkemap.put("type", Urls.type_find_pwd);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.CheckSmsCode, MethodType.GET,
				Urls.function.chkSmsCode, checkemap, new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel regBean = gson.fromJson(response, type);
						ToastUtils.showToast(regBean.getInfo());
						if (regBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(regBean.getToken());
							smsCode=etSmsCode.getText().toString();
							Intent intentPwd=new Intent(PasswordForget.this,PasswordReSetting.class);
							intentPwd.putExtra("mobile", phone);
							intentPwd.putExtra("code", smsCode);
							startActivity(intentPwd);
							timerThread=false;
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("httpFail------->", response);
						}
					}
				});
	}
	
	
	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		super.onBackPressed();
		PasswordForget.this.finish();
		AppManager.getAppManager().finishActivity(PasswordForget.this);
	}
	
	/**
	 * 发送短信倒计时提醒
	 * 
	 * @author Administrator
	 * 
	 */
	class smsTimeThread implements Runnable {

		@Override
		public void run() {
			// TODO Auto-generated method stub
			while (timeNum > 0&&timerThread) {
				timeNum--;
				mHandler.post(new Runnable() {// 通过它在UI主线程中修改显示的剩余时间

					@Override
					public void run() {
						// TODO Auto-generated method stub
						tvSmsSend.setText(timeNum + "s后重新发送");
						if (DzqcStu.isDebug) {
							Log.i("倒计时时间为=========》", timeNum + "s后重新发送");
						}
					}
				});
				try {
					Thread.sleep(1000);// 线程休眠一秒钟
				} catch (InterruptedException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			mHandler.sendEmptyMessage(0x001);
		}

	};
	
	@SuppressLint("HandlerLeak")
	private Handler mHandler = new Handler() {
		@Override
		public void handleMessage(android.os.Message msg) {
			switch (msg.what) {
			case 0x001:
				tvSmsSend.setText("发送验证码");
				tvSmsSend.setEnabled(true);
				break;

			default:
				break;
			}
		};
	};
}
