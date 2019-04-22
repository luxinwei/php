package com.dzqc.enterprise.ui;

import java.util.HashMap;
import java.util.Map;

import org.json.JSONException;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.http.Urls.MethodType;
import com.dzqc.enterprise.json.JsonToStrUtils;
import com.dzqc.enterprise.ui.listener.AccountEditTextWatcher;
import com.dzqc.enterprise.ui.listener.PwdEditTextWatcher;
import com.dzqc.enterprise.utils.ToastUtils;

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

	private JsonToStrUtils jsonToStr;
	
	private EditText etEmail,etEmailCode;
	private TextView tvEmailSend, tvStep,tvHeader;
	private int timeNum = 60;// 邮件倒计时总时间
	private String email,emailValidateCode;
	private ImageView rePwdBack;
	
	private boolean timerThread=true;//倒计时线程标示
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.password_forget);

		initView();
	}

	@SuppressWarnings("deprecation")
	/**
	 * 初始化组件
	 */
	private void initView() {
		rePwdBack=(ImageView) findViewById(R.id.img_registerBack);
		rePwdBack.setOnClickListener(this);
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.header_forget_pwd));
		
		etEmail = (EditText) findViewById(R.id.et_email);
		etEmailCode=(EditText) findViewById(R.id.et_findPwd_ValicateCode);
		
		tvEmailSend = (TextView) findViewById(R.id.tv_findPwd_sendEmail);
		tvEmailSend.setOnClickListener(this);
		tvStep = (TextView) findViewById(R.id.tv_NextStep);
		tvStep.setOnClickListener(this);
		tvStep.setEnabled(false);
		tvStep.setBackgroundDrawable(DzqcEnterprise.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));
		
		etEmail.addTextChangedListener(new AccountEditTextWatcher(tvStep,etEmailCode));
		etEmailCode.addTextChangedListener(new PwdEditTextWatcher(tvStep,etEmail));
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tv_findPwd_sendEmail:
			email = etEmail.getText().toString();
			if (email.equals("")) {
				ToastUtils.showToast(R.string.email_send_empty);
				return;
			}
			Map<String, String> phonemap=new HashMap<String, String>();
			phonemap.put("email", email);
			phonemap.put("type", Urls.typeEmail);
			HttpRequest.HttpPost(Urls.ROOTURL, Method.SendEmail,
					MethodType.GET, Urls.function.send, phonemap,
					new HttpCallback() {

						@Override
						public void httpSuccess(String response) {
							// TODO Auto-generated method stub
							jsonToStr = new JsonToStrUtils(response);
							try {
								ToastUtils.showToast(jsonToStr.getJsonContent());
								if (jsonToStr.getResultStatus().equals("1")) {
									new Thread(new smsTimeThread()).start();
									tvEmailSend.setEnabled(false);
								}
							} catch (JSONException e) {
								// TODO Auto-generated catch block
								e.printStackTrace();
								ToastUtils.showToast(getString(R.string.email_send_error));
							}
						}

						@Override
						public void httpFail(String response) {
							// TODO Auto-generated method stub

						}
					});
			break;
		case R.id.tv_NextStep:
			emailCodeValidate();
			break;
		case R.id.img_registerBack:
			PasswordForget.this.finish();
			break;
		default:
			break;
		}
	}
	
	/**
	 * 邮箱验证码有效性判断
	 * 
	 * @return
	 */
	private void emailCodeValidate() {
		email=etEmail.getText().toString();
		emailValidateCode=etEmailCode.getText().toString();
		Map<String, String> checkemap=new HashMap<String, String>();
		checkemap.put("email", email);
		checkemap.put("code", emailValidateCode);
		checkemap.put("type", Urls.typeEmail);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.chkEmailCode, MethodType.GET,
				Urls.function.chkEmailCode, checkemap, new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						jsonToStr = new JsonToStrUtils(response);
						try {
							if (DzqcEnterprise.isDebug) {
								Log.i("httpSuccess------->", jsonToStr.getResultStatus());
							}
							ToastUtils.showToast(jsonToStr.getJsonContent());
							if (jsonToStr.getResultStatus().equals("1")) {//验证码有效跳转至重置密码页面
								Intent intentPwd=new Intent(PasswordForget.this,PasswordReSetting.class);
								intentPwd.putExtra("email", email);
								intentPwd.putExtra("code", emailValidateCode);
								startActivity(intentPwd);
								timerThread=false;
							}else {
							}
						} catch (JSONException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
						if (DzqcEnterprise.isDebug) {
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
						tvEmailSend.setText(timeNum + "s后重新发送");
						if (DzqcEnterprise.isDebug) {
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
		public void handleMessage(android.os.Message msg) {
			switch (msg.what) {
			case 0x001:
				tvEmailSend.setText("发送验证码");
				tvEmailSend.setEnabled(true);
				break;

			default:
				break;
			}
		};
	};
}
