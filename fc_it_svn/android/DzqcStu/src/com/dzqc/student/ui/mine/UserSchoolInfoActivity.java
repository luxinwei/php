package com.dzqc.student.ui.mine;

import java.util.HashMap;
import java.util.Map;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.CertificationMode;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class UserSchoolInfoActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvSchool,tvMajor,tvSchoolDate;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.personal_school_info);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();

	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.mine_onSchool));
	}

	private void initView() {
		tvSchool = (TextView) findViewById(R.id.tv_userSchool);
		tvMajor = (TextView) findViewById(R.id.tv_userMajor);
		tvSchoolDate = (TextView) findViewById(R.id.tv_userGoSchoolDate);
		
		loadInfo();
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
	}

	
	/**
	 * 查询用户在校信息
	 */
	private void loadInfo() {
		Map<String, String> map = new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getRealNameAuthenticationInfo,
				Urls.MethodType.GET, Urls.function.getRealNameAuthenticationInfo, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("查询用户在校信息返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<CertificationMode>() {
						}.getType();
						CertificationMode authBean = gson.fromJson(response,
								type);
						UserInfoKeeper.updToken(authBean.getToken());
						com.dzqc.student.model.CertificationMode.Info info=authBean.getInfo();
						tvSchool.setText(info.getUniversity());
						tvMajor.setText(info.getMajor());
						tvSchoolDate.setText(info.getSchool_years()+"年");
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
			AppManager.getAppManager().finishActivity(UserSchoolInfoActivity.this);
			break;
		default:
			break;
		}
	}

}
