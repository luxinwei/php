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
import com.dzqc.student.json.JsonToStrUtils;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.ui.listener.AccountEditTextWatcher;
import com.dzqc.student.ui.listener.PwdEditTextWatcher;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

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
	private TextView tvComplete,tvHeader;
	
	private String newPwd,confirmPwd,mobile,code;
	
	private ImageView rePwdBack;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.password_resetting);
		AppManager.getAppManager().addActivity(this);
		
		Intent intentPhone=getIntent();
		mobile=intentPhone.getStringExtra("mobile");
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
		tvComplete=(TextView) findViewById(R.id.tv_Comfirm);
		tvComplete.setOnClickListener(this);
		tvComplete.setEnabled(false);
		tvComplete.setBackgroundDrawable(DzqcStu.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));

		etNewPwd.addTextChangedListener(new AccountEditTextWatcher(tvComplete,etConfirmPwd));
		etConfirmPwd.addTextChangedListener(new PwdEditTextWatcher(tvComplete,etNewPwd));
	}
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tv_Comfirm:
			newPwd=etNewPwd.getText().toString();
			confirmPwd=etConfirmPwd.getText().toString();
			if (!newPwd.equals(confirmPwd)) {
				ToastUtils.showToast(R.string.alert_pwd_noequal);
				return;
			}
			Map<String, String> updPwdMap=new HashMap<String, String>();
			updPwdMap.put("mobile",mobile);
			updPwdMap.put("code", code);
			updPwdMap.put("password",newPwd);
			HttpRequest.HttpPost(Urls.ROOTURL, Method.ResetPwd, Urls.MethodType.GET,Urls.function.resetPwd, updPwdMap, new HttpCallback() {
				
				@Override
				public void httpSuccess(String response) {
					Gson gson = new Gson();
					java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
					}.getType();
					NormalResultModel regBean = gson.fromJson(response, type);
					ToastUtils.showToast(regBean.getInfo());
					if (regBean.getStatus().equals("1")) {
						UserInfoKeeper.updToken(regBean.getToken());
						startActivity(new Intent(PasswordReSetting.this,UserLogin.class));
						AppManager.getAppManager().finishActivity(PasswordReSetting.this);
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
		AppManager.getAppManager().finishActivity(PasswordReSetting.this);
	}
}
