package com.dzqc.enterprise.ui;

import java.util.HashMap;
import java.util.Map;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.json.JsonToStrUtils;
import com.dzqc.enterprise.model.LoginMode;
import com.dzqc.enterprise.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.TextView;

public class UserLogin extends BaseActivity implements OnClickListener {

	private EditText et_userName, et_userPwd;
	private TextView tvLogin,tvForgetPwd,tvRegister;

	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.user_login);
		
		initView();
	}

	//初始化组件
	@SuppressWarnings("deprecation")
	private void initView() {
		et_userName = (EditText) findViewById(R.id.et_userName);
		et_userPwd = (EditText) findViewById(R.id.et_userPwd);
		
		tvLogin = (TextView) findViewById(R.id.tv_login);
		tvLogin.setOnClickListener(this);
		/*tvLogin.setEnabled(false);
		tvLogin.setBackgroundDrawable(DzqcEnterprise.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));
*/
		tvForgetPwd=(TextView) findViewById(R.id.tv_forgetPwd);
		tvForgetPwd.setOnClickListener(this);
		
		tvRegister=(TextView) findViewById(R.id.tv_registerUser);
		tvRegister.setOnClickListener(this);
		
		/*et_userName.addTextChangedListener(new AccountEditTextWatcher(tvLogin,et_userPwd));
		et_userPwd.addTextChangedListener(new PwdEditTextWatcher(tvLogin,et_userName));*/
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tv_login:
			Map<String, String> map=new HashMap<String, String>();
			map.put("username", et_userName.getText().toString());
			map.put("password", et_userPwd.getText().toString());
			HttpRequest.HttpPost(Urls.ROOTURL, Method.UserLogin, Urls.MethodType.GET,Urls.function.login, map, new HttpCallback() {
				
				@Override
				public void httpSuccess(String response) {
					// TODO Auto-generated method stub
					if (DzqcEnterprise.isDebug) {
						Log.i("登录成功返回结果----------》》", response);
					}
					Gson gson = new Gson();
					java.lang.reflect.Type type = new TypeToken<LoginMode>() {
					}.getType();
					LoginMode loginBean = gson.fromJson(response,
							type);
					String audit="";
					if (loginBean.getStatus().equals("1")) {
						UserInfoKeeper.updToken(loginBean.getToken());
						audit=loginBean.getAudit();
						if (audit.equals("10")||audit.equals("20")) {
							startActivity(new Intent(UserLogin.this, MainActivity.class));
						}else {
							startActivity(new Intent(UserLogin.this, UserCertificationActivity.class));
						}
					}else {
						ToastUtils.showToast(loginBean.getInfo().toString());
					}
				
				}
				
				@Override
				public void httpFail(String response) {
					// TODO Auto-generated method stub
				}
				
			});
			break;

		case R.id.tv_forgetPwd:
			startActivity(new Intent(UserLogin.this, PasswordForget.class));
			break;
		case R.id.tv_registerUser:
			startActivity(new Intent(UserLogin.this, UserRegister.class));
			break;
		default:
			break;
		}
	}
}
