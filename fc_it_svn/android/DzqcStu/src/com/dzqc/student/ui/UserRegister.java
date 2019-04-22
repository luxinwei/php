package com.dzqc.student.ui;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.json.JSONException;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.http.Urls.MethodType;
import com.dzqc.student.json.JsonToStrUtils;
import com.dzqc.student.model.LoginMode;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.ui.listener.PhoneEditTextWatcher;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.text.Selection;
import android.text.Spannable;
import android.text.method.HideReturnsTransformationMethod;
import android.text.method.PasswordTransformationMethod;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

public class UserRegister extends BaseActivity implements OnClickListener {

	private JsonToStrUtils jsonToStr;

	private ImageView registerBack, imgPwdEye, imgRePwdEye;
	private TextView tvGoLogin, userRegister, tvSmsCode;

	private EditText userPhone, validateCode, userPwd, userRePwd;

	private String userAccount, valiCode, pwd, rePwd;
	private String effectFlag = "Y";// 短信验证码有效性标示
	private boolean eyeFlag = false;// 密码是否明文显示，默认密文
	private boolean eyeReFlag = false;// 确认密码框，密码是否明文显示，默认密文
	private int timeNum = 60;// 短信倒计时总时间
	
	private boolean timerThread=true;//倒计时线程标示
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.user_register);
		AppManager.getAppManager().addActivity(this);
		initView();
	}

	/**
	 * 初始化组件
	 */
	@SuppressWarnings("deprecation")
	private void initView() {
		userPhone = (EditText) findViewById(R.id.et_userPhone);

		validateCode = (EditText) findViewById(R.id.et_ValicateCode);
		userPwd = (EditText) findViewById(R.id.et_userPwd);
		userRePwd = (EditText) findViewById(R.id.et_userRePwd);

		registerBack = (ImageView) findViewById(R.id.img_registerBack);
		registerBack.setOnClickListener(this);

		imgPwdEye = (ImageView) findViewById(R.id.img_showPwd);
		imgPwdEye.setOnClickListener(this);
		imgRePwdEye = (ImageView) findViewById(R.id.img_showRePwd);
		imgRePwdEye.setOnClickListener(this);

		tvGoLogin = (TextView) findViewById(R.id.tv_goLogin);
		tvGoLogin.setOnClickListener(this);

		userRegister = (TextView) findViewById(R.id.userRegister);
		userRegister.setOnClickListener(this);
		userRegister.setEnabled(false);
		userRegister.setBackgroundDrawable(DzqcStu.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));

		tvSmsCode = (TextView) findViewById(R.id.tv_sendCode);
		tvSmsCode.setOnClickListener(this);

		// 给EditText添加监听事件，判断注册按钮能否点击
		addEditTextListener();
	}

	/**
	 * 给EditText添加监听事件，判断注册按钮能否点击
	 */
	private void addEditTextListener() {
		List<EditText> listPhone = new ArrayList<EditText>();
		listPhone.add(validateCode);
		listPhone.add(userPwd);
		listPhone.add(userRePwd);
		userPhone.addTextChangedListener(new PhoneEditTextWatcher(userRegister,
				listPhone));
		List<EditText> listCode = new ArrayList<EditText>();
		listCode.add(userPhone);
		listCode.add(userPwd);
		listCode.add(userRePwd);
		validateCode.addTextChangedListener(new PhoneEditTextWatcher(
				userRegister, listCode));
		List<EditText> listPwd = new ArrayList<EditText>();
		listPwd.add(validateCode);
		listPwd.add(userPhone);
		listPwd.add(userRePwd);
		userPwd.addTextChangedListener(new PhoneEditTextWatcher(userRegister,
				listPwd));
		List<EditText> listRePwd = new ArrayList<EditText>();
		listRePwd.add(validateCode);
		listRePwd.add(userPwd);
		listRePwd.add(userPhone);
		userRePwd.addTextChangedListener(new PhoneEditTextWatcher(userRegister,
				listRePwd));
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.img_registerBack:
			this.finish();
			break;
		case R.id.tv_goLogin:
			startActivity(new Intent(UserRegister.this, UserLogin.class));
			this.finish();
			break;
		case R.id.userRegister:
			userAccount = userPhone.getText().toString();
			valiCode = validateCode.getText().toString();
			pwd = userPwd.getText().toString();
			rePwd = userRePwd.getText().toString();
			// 判断短信验证码有效性
			if (smsCodeValidate().equals("N")) {
				ToastUtils.showToast(getResources().getString(
						R.string.alert_valicode_noeffect));
				return;
			}
			// 两次密码一致性判断
			if (!isEqualPwd()) {
				ToastUtils.showToast(getResources().getString(
						R.string.alert_pwd_noequal));
				return;
			}
			Map<String, String> map = new HashMap<String, String>();
			map.put("mobile", userAccount);
			map.put("password", pwd);
			map.put("code", valiCode);
			map.put("regchannel", Urls.Channel);
			registerOnClick(map);
			break;
		case R.id.tv_sendCode:// 发送验证码
			userAccount = userPhone.getText().toString();
			if (userAccount.equals("")) {
				ToastUtils.showToast(R.string.alert_telephone_empty);
				return;
			}
			Map<String, String> mapPhone = new HashMap<String, String>();
			mapPhone.put("mobile", userAccount);
			mapPhone.put("type", Urls.type_register);
			HttpRequest.HttpPost(Urls.ROOTURL, Method.SendSmsCode,
					MethodType.GET, Urls.function.sendSmsCode, mapPhone,
					new HttpCallback() {

						@Override
						public void httpSuccess(String response) {
							// TODO Auto-generated method stub
							jsonToStr = new JsonToStrUtils(response);
							try {
								ToastUtils.showToast(jsonToStr.getJsonContent());
								if (jsonToStr.getResultStatus().equals("1")) {
									new Thread(new smsTimeThread()).start();
									tvSmsCode.setEnabled(false);
								}
							} catch (JSONException e) {
								// TODO Auto-generated catch block
								e.printStackTrace();
							}
						}

						@Override
						public void httpFail(String response) {
							// TODO Auto-generated method stub
							jsonToStr = new JsonToStrUtils(response);
							try {
								ToastUtils.showToast(jsonToStr.getJsonContent());
							} catch (JSONException e) {
								// TODO Auto-generated catch block
								e.printStackTrace();
							}
						}
					});
			break;
		case R.id.img_showPwd:// 显示明文/密文密码
			if (!eyeFlag) {
				imgPwdEye.setBackgroundResource(R.drawable.reg_eye_after_icon);
				userPwd.setTransformationMethod(HideReturnsTransformationMethod
						.getInstance());// 设置密码可见
				eyeFlag = true;
			} else {
				imgPwdEye.setBackgroundResource(R.drawable.reg_eye_before_icon);
				userPwd.setTransformationMethod(PasswordTransformationMethod
						.getInstance());// 设置密码为不可见
				eyeFlag = false;
			}
			setCursorPosition(userPwd);
			break;
		case R.id.img_showRePwd:// 显示明文/密文密码
			if (!eyeReFlag) {
				imgRePwdEye
						.setBackgroundResource(R.drawable.reg_eye_after_icon);
				userRePwd
						.setTransformationMethod(HideReturnsTransformationMethod
								.getInstance());// 设置密码可见
				eyeReFlag = true;
			} else {
				imgRePwdEye
						.setBackgroundResource(R.drawable.reg_eye_before_icon);
				userRePwd.setTransformationMethod(PasswordTransformationMethod
						.getInstance());// 设置密码为不可见
				eyeReFlag = false;
			}
			setCursorPosition(userRePwd);
			break;

		default:
			break;
		}
	}

	private void setCursorPosition(EditText et) {
		// 切换后将EditText光标置于末尾
		CharSequence charSequence = et.getText();
		if (charSequence instanceof Spannable) {
			Spannable spanText = (Spannable) charSequence;
			Selection.setSelection(spanText, charSequence.length());
		}
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
						tvSmsCode.setText(timeNum + "s后重新发送");
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
				tvSmsCode.setText("发送验证码");
				tvSmsCode.setEnabled(true);
				break;
			case 0X002:
				AppManager.getAppManager().finishActivity(UserRegister.this);
				break;
			default:
				break;
			}
		};
	};

	/**
	 * 短信验证码有效性判断
	 * 
	 * @return
	 */
	private String smsCodeValidate() {
		Map<String, String> smsMap = new HashMap<String, String>();
		smsMap.put("code", valiCode);
		smsMap.put("type", Urls.type_register);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.CheckSmsCode, MethodType.GET,
				Urls.function.chkSmsCode, smsMap, new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						jsonToStr = new JsonToStrUtils(response);
						try {
							if (jsonToStr.getResultStatus().equals("1")) {
								effectFlag = "Y";
							}
						} catch (JSONException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
						jsonToStr = new JsonToStrUtils(response);
						try {
							if (!jsonToStr.getResultStatus().equals("1")) {
								effectFlag = "N";
							}
						} catch (JSONException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
					}
				});
		return effectFlag;
	}

	/**
	 * 两次输入密码一致性判断
	 * 
	 * @return
	 */
	private boolean isEqualPwd() {
		if (!rePwd.equals(pwd)) {
			return false;
		}
		return true;
	}

	/**
	 * 点击注册事件
	 */
	private void registerOnClick(Map<String, String> map) {
		HttpRequest.HttpPost(Urls.ROOTURL, Method.UserReg, MethodType.GET,
				Urls.function.reg, map, new HttpCallback() {

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
							timerThread=false;
							dragFinishTime();
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
						
					}
				});
	}

	//延迟一秒关闭页面
	private void dragFinishTime()
	{
		new Thread() {
			@Override
			public void run() {
				try {
					Thread.sleep(1000);
				} catch (InterruptedException e) {
					e.printStackTrace();
				}
				Message _Msg = mHandler.obtainMessage(0X002, "");
				mHandler.sendMessage(_Msg);
			}
		}.start();
	}
	
	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		super.onBackPressed();
		this.finish();
	}
}
