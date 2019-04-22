package com.dzqc.enterprise.ui;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
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
import com.dzqc.enterprise.ui.listener.PhoneEditTextWatcher;
import com.dzqc.enterprise.utils.ToastUtils;

import android.content.Intent;
import android.os.Bundle;
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
	private TextView tvGoLogin, userRegister;

	private EditText userEmail, userPwd, userRePwd;

	private String userAccount, pwd, rePwd;
	private boolean eyeFlag = false;// 密码是否明文显示，默认密文
	private boolean eyeReFlag = false;// 确认密码框，密码是否明文显示，默认密文
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.user_register);

		initView();
	}

	/**
	 * 初始化组件
	 */
	@SuppressWarnings("deprecation")
	private void initView() {
		userEmail = (EditText) findViewById(R.id.et_userEmail);

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
		userRegister.setBackgroundDrawable(DzqcEnterprise.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));

		// 给EditText添加监听事件，判断注册按钮能否点击
		addEditTextListener();
	}

	/**
	 * 给EditText添加监听事件，判断注册按钮能否点击
	 */
	private void addEditTextListener() {
		List<EditText> listPhone = new ArrayList<EditText>();
		listPhone.add(userPwd);
		listPhone.add(userRePwd);
		userEmail.addTextChangedListener(new PhoneEditTextWatcher(userRegister,
				listPhone));
		List<EditText> listPwd = new ArrayList<EditText>();
		listPwd.add(userEmail);
		listPwd.add(userRePwd);
		userPwd.addTextChangedListener(new PhoneEditTextWatcher(userRegister,
				listPwd));
		List<EditText> listRePwd = new ArrayList<EditText>();
		listRePwd.add(userPwd);
		listRePwd.add(userEmail);
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
			userAccount = userEmail.getText().toString();
			pwd = userPwd.getText().toString();
			rePwd = userRePwd.getText().toString();
			// 两次密码一致性判断
			if (!isEqualPwd()) {
				ToastUtils.showToast(getResources().getString(
						R.string.alert_pwd_noequal));
				return;
			}
			Map<String, String> map = new HashMap<String, String>();
			map.put("email", userAccount);
			map.put("password", pwd);
			map.put("regchannel", Urls.Channel);
			if (DzqcEnterprise.isDebug) {
				Log.i("注册输入参数---------》》", userAccount+"---"+pwd);
			}
			registerOnClick(map);
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
						jsonToStr = new JsonToStrUtils(response);
						try {
							ToastUtils.showToast(jsonToStr.getJsonContent());
							if (jsonToStr.getResultStatus().equals("1")) {
								UserRegister.this.finish();
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
	}

	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		super.onBackPressed();
		this.finish();
	}
}
