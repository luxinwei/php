package com.dzqc.student.ui;

import java.util.HashMap;
import java.util.Map;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.LoginMode;
import com.dzqc.student.ui.listener.AccountEditTextWatcher;
import com.dzqc.student.ui.listener.PwdEditTextWatcher;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.umeng.socialize.UMAuthListener;
import com.umeng.socialize.UMShareAPI;
import com.umeng.socialize.bean.SHARE_MEDIA;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

public class UserLogin extends BaseActivity implements OnClickListener {

	private UMShareAPI mShareAPI = null;// 友盟接口类

	private ImageView btnQQ, btnWeiXin, btnWeiBo;

	private EditText et_userName, et_userPwd;
	private TextView tvLogin, tvForgetPwd, tvRegister;

	private LinearLayout li_rememberPwd;
	private CheckBox cbxPwd;//记住密码
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.user_login);
		AppManager.getAppManager().addActivity(this);
		initView();
	}

	// 初始化组件
	@SuppressWarnings("deprecation")
	private void initView() {
		mShareAPI = UMShareAPI.get(this);//获取UMShareAPI

		et_userName = (EditText) findViewById(R.id.et_userName);
		et_userPwd = (EditText) findViewById(R.id.et_userPwd);

		tvLogin = (TextView) findViewById(R.id.tv_login);
		tvLogin.setOnClickListener(this);
		
		tvLogin.setEnabled(false);
		tvLogin.setBackgroundDrawable(DzqcStu.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));
		 

		tvForgetPwd = (TextView) findViewById(R.id.tv_forgetPwd);
		tvForgetPwd.setOnClickListener(this);

		tvRegister = (TextView) findViewById(R.id.tv_registerUser);
		tvRegister.setOnClickListener(this);

		btnQQ = (ImageView) findViewById(R.id.btn_QQ);
		btnQQ.setOnClickListener(this);
		btnWeiXin = (ImageView) findViewById(R.id.btn_WeiXin);
		btnWeiXin.setOnClickListener(this);
		btnWeiBo = (ImageView) findViewById(R.id.btn_WeiBo);
		btnWeiBo.setOnClickListener(this);

		et_userName.addTextChangedListener(new AccountEditTextWatcher(tvLogin,
				et_userPwd));
		et_userPwd.addTextChangedListener(new PwdEditTextWatcher(tvLogin,
				et_userName));
		
		li_rememberPwd=(LinearLayout) findViewById(R.id.li_rememberPwd);
		li_rememberPwd.setOnClickListener(this);
		cbxPwd=(CheckBox) findViewById(R.id.cbx_rememberPwd);
		
		isRememberPwd();
	}

	//判断是否记住密码了
	private void isRememberPwd()
	{
		//String isRemember=UserInfoKeeper.getToken(DzqcStu.getInstance());
		int isLogin=UserInfoKeeper.getLoginState();
		if (isLogin==-1) {
			cbxPwd.setChecked(false);
		}else {
			cbxPwd.setChecked(true);
		}
	}
	
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		SHARE_MEDIA platform = null;
		switch (v.getId()) {
		case R.id.tv_login:
			// final ProgressDialog
			// pd=SubmitDialog.getProgressDialog(UserLogin.this, "加载中...");
			// pd.show();
			Map<String, String> map = new HashMap<String, String>();
			map.put("username", et_userName.getText().toString());
			map.put("password", et_userPwd.getText().toString());
			HttpRequest.HttpPost(Urls.ROOTURL, Method.UserLogin,
					Urls.MethodType.GET, Urls.function.login, map,
					new HttpCallback() {

						@Override
						public void httpSuccess(String response) {
							// TODO Auto-generated method stub
							if (DzqcStu.isDebug) {
								Log.i("登录成功返回结果----------》》", response);
							}
							Gson gson = new Gson();
							java.lang.reflect.Type type = new TypeToken<LoginMode>() {
							}.getType();
							LoginMode loginBean = gson.fromJson(response, type);
							ToastUtils.showToast(loginBean.getInfo());
							if (loginBean.getStatus() == 1) {
								UserInfoKeeper.updToken(loginBean.getToken());
								if (cbxPwd.isChecked()) {
									UserInfoKeeper.setLoginState(1);
								}else {
									UserInfoKeeper.setLoginState(-1);
								}
								String audit = loginBean.getAudit();
								if (audit.equals("20") || audit.equals("10")) {
									startActivity(new Intent(UserLogin.this,
											MainActivity.class));
								} else if (audit.equals("30")) {
									Intent intent = new Intent(UserLogin.this,
											UserCertification.class);
									intent.putExtra("status", "30");
									startActivity(intent);
								} else {
									Intent intent = new Intent(UserLogin.this,
											UserCertification.class);
									intent.putExtra("status", "0");
									startActivity(intent);
								}
								UserInfoKeeper.setAuditCode(audit);
								// 跳转到主页面
								AppManager.getAppManager().finishActivity(UserLogin.this);
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
		case R.id.btn_QQ:// qq登录
			platform = SHARE_MEDIA.QQ;
			mShareAPI.doOauthVerify(UserLogin.this, platform, umAuthListener);
			break;
		case R.id.btn_WeiXin:// 微信登录
			platform = SHARE_MEDIA.WEIXIN;
			mShareAPI.doOauthVerify(UserLogin.this, platform, umAuthListener);
			break;
		case R.id.btn_WeiBo:// 新浪微博登录
			platform = SHARE_MEDIA.SINA;
			mShareAPI.doOauthVerify(UserLogin.this, platform, umAuthListener);
			break;
		case R.id.tv_registerUser:
			startActivity(new Intent(UserLogin.this, UserRegister.class));
			break;
		case R.id.li_rememberPwd:
			if (cbxPwd.isChecked()) {
				cbxPwd.setChecked(false);
				UserInfoKeeper.setLoginState(-1);
			}else {
				cbxPwd.setChecked(true);
				UserInfoKeeper.setLoginState(1);
			}
			break;
		default:
			break;
			
		}
	}

	/** auth callback interface **/
	private UMAuthListener umAuthListener = new UMAuthListener() {
		@Override
		public void onComplete(SHARE_MEDIA platform, int action,
				Map<String, String> data) {
			if (DzqcStu.isDebug) {
				Toast.makeText(getApplicationContext(), "other Authorize succeed",
						Toast.LENGTH_SHORT).show();
			}
			
			if (platform.equals(SHARE_MEDIA.WEIXIN)) {
				Toast.makeText(getApplicationContext(), "WeiXin Authorize succeed",
						Toast.LENGTH_SHORT).show();
			}else {
				Toast.makeText(getApplicationContext(), "other Authorize succeed",
						Toast.LENGTH_SHORT).show();
			}
			//mShareAPI.getPlatformInfo(UserLogin.this, platform, umAuthListener);
		}

		@Override
		public void onError(SHARE_MEDIA platform, int action, Throwable t) {
			
			if (platform.equals(SHARE_MEDIA.WEIXIN)) {
				Toast.makeText(getApplicationContext(), "WeiXin Authorize fail",
						Toast.LENGTH_SHORT).show();
			}else {
				Toast.makeText(getApplicationContext(), "Authorize fail",
						Toast.LENGTH_SHORT).show();
			}
		}

		@Override
		public void onCancel(SHARE_MEDIA platform, int action) {
			if (platform.equals(SHARE_MEDIA.WEIXIN)) {
				Toast.makeText(getApplicationContext(), "WeiXin Authorize cancer",
						Toast.LENGTH_SHORT).show();
			}else {
				Toast.makeText(getApplicationContext(), "Authorize cancer",
						Toast.LENGTH_SHORT).show();
			}
		}
	};

	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		Log.d("auth", "on activity re 2");
		mShareAPI.onActivityResult(requestCode, resultCode, data);
		Log.d("auth", "on activity re 3");
	}

}
