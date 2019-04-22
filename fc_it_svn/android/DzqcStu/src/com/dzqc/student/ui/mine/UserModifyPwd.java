package com.dzqc.student.ui.mine;

import java.util.HashMap;
import java.util.Map;

import android.app.AlertDialog;
import android.app.AlertDialog.Builder;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.Window;
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
import com.dzqc.student.ui.UserLogin;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class UserModifyPwd extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private String userId;
	
	private TextView tvSubmit;
	private EditText etOldPwd,etNewPwd,etReNewPwd;
	private String newPwd,reNewPwd,oldPwd;
	private LayoutInflater inflater;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.user_modify_pwd);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();

		inflater=LayoutInflater.from(this);
		
		Intent intent = getIntent();
		if (intent!=null) {
			userId=intent.getStringExtra("userId");
		}
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.mine_user_modify_pwd_header));
	}

	private void initView() {
		tvSubmit = (TextView) findViewById(R.id.tvUpdPwd);
		etOldPwd = (EditText) findViewById(R.id.edit_oldPwd);
		etNewPwd = (EditText) findViewById(R.id.edit_newPwd);
		etReNewPwd = (EditText) findViewById(R.id.edit_reNewPwd);
		tvSubmit.setOnClickListener(this);
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
	}

	//判断两次输入密码的一致性
	private boolean checkPwd()
	{
		boolean  flag=true;
		oldPwd=etOldPwd.getText().toString();
		newPwd=etNewPwd.getText().toString();
		reNewPwd=etReNewPwd.getText().toString();
		if (!newPwd.equals(reNewPwd)) {
			flag=false;
		}else {
			flag=true;
		}
		return flag;
	}
	
	/**
	 * 修改密码
	 */
	private void submitInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("oldPwd", oldPwd);
		map.put("newPwd", newPwd);
		map.put("reNewPwd", reNewPwd);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.modifyPwd,
				Urls.MethodType.GET, Urls.function.modifyPwd, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("提交修改密码返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel submitBean = gson.fromJson(response,
								type);
						if (submitBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(submitBean.getToken());
							//密码修改成功，重新登录
							View view=inflater.inflate(R.layout.alert_dialog_confirm,null);
							final AlertDialog alertDialog = new AlertDialog.Builder(UserModifyPwd.this).create();  
							alertDialog.show();
							alertDialog.setCancelable(false);
							Window window = alertDialog.getWindow();
							window.setContentView(view);
							TextView tv_title = (TextView) window.findViewById(R.id.tv_MessageTitle);  
							TextView tv_message = (TextView) window.findViewById(R.id.tv_MessageContent);  
							TextView tvConfirm=(TextView) window.findViewById(R.id.tvConfirm);
							tv_title.setText("提示");
							tv_message.setText("密码修改成功，请重新登录");
							tvConfirm.setOnClickListener(new OnClickListener() {
								
								@Override
								public void onClick(View v) {
									// TODO Auto-generated method stub
									//密码修改成功，重新登录
									alertDialog.dismiss();
									AppManager.getAppManager().AppExit(UserModifyPwd.this);
									UserInfoKeeper.setLoginState(-1);
									UserInfoKeeper.updToken("");
									startActivity(new Intent(UserModifyPwd.this, UserLogin.class));
								}
							});
							
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
			AppManager.getAppManager().finishActivity(UserModifyPwd.this);
			break;
		case R.id.tvUpdPwd://提交修改密码
			if (checkPwd()) {
				submitInfo();
			}else {
				ToastUtils.showToast(getResources().getString(R.string.alert_pwd_noequal));
				return;
			};
			break;
		default:
			break;
		}
	}
}
