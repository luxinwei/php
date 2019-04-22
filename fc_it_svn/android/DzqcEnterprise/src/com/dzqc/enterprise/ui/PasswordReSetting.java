package com.dzqc.enterprise.ui;

import java.util.HashMap;
import java.util.Map;

import org.json.JSONException;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.json.JsonToStrUtils;
import com.dzqc.enterprise.ui.listener.AccountEditTextWatcher;
import com.dzqc.enterprise.ui.listener.PwdEditTextWatcher;
import com.dzqc.enterprise.utils.ToastUtils;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

public class PasswordReSetting extends BaseActivity implements OnClickListener {

	private JsonToStrUtils jsonToStr;
	
	private EditText etNewPwd;
	private EditText etConfirmPwd;
	private TextView tvConfirm,tvHeader;
	
	private String newPwd,confirmPwd,email,code;
	
	private ImageView rePwdBack;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.password_resetting);
		Intent intentPhone=getIntent();
		email=intentPhone.getStringExtra("email");
		code=intentPhone.getStringExtra("code");
		//初始化组件
		initView();
	}
	
	@SuppressWarnings("deprecation")
	private void initView()
	{
		rePwdBack=(ImageView) findViewById(R.id.img_registerBack);
		rePwdBack.setOnClickListener(this);
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.header_resetting_pwd));
		
		etNewPwd=(EditText) findViewById(R.id.et_resettingPwd);
		etConfirmPwd=(EditText) findViewById(R.id.et_confirmPwd);
		tvConfirm=(TextView) findViewById(R.id.tv_confirm);
		tvConfirm.setOnClickListener(this);
		tvConfirm.setEnabled(false);
		tvConfirm.setBackgroundDrawable(DzqcEnterprise.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));

		etNewPwd.addTextChangedListener(new AccountEditTextWatcher(tvConfirm,etConfirmPwd));
		etConfirmPwd.addTextChangedListener(new PwdEditTextWatcher(tvConfirm,etNewPwd));
	}
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tv_confirm:
			newPwd=etNewPwd.getText().toString();
			confirmPwd=etConfirmPwd.getText().toString();
			if (!newPwd.equals(confirmPwd)) {
				ToastUtils.showToast(R.string.alert_pwd_noequal);
				return;
			}
			Map<String, String> updPwdMap=new HashMap<String, String>();
			updPwdMap.put("email",email);
			updPwdMap.put("code", code);
			updPwdMap.put("password",newPwd);
			HttpRequest.HttpPost(Urls.ROOTURL, Method.forgetPwd, Urls.MethodType.GET,Urls.function.forgetPwd, updPwdMap, new HttpCallback() {
				
				@Override
				public void httpSuccess(String response) {
					jsonToStr = new JsonToStrUtils(response);
					try {
						ToastUtils.showToast(jsonToStr.getJsonContent());
						if (jsonToStr.getResultStatus().equals("1")) {
							startActivity(new Intent(PasswordReSetting.this,UserLogin.class));
							PasswordReSetting.this.finish();
						}
					} catch (JSONException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
				}
				
				@Override
				public void httpFail(String response) {
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

		case R.id.img_registerBack:
			PasswordReSetting.this.finish();
			break;
		default:
			break;
		}
	}
	
	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		super.onBackPressed();
		PasswordReSetting.this.finish();
	}
}
