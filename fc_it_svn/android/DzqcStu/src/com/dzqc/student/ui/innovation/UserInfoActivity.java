package com.dzqc.student.ui.innovation;

import java.util.HashMap;
import java.util.Map;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.CompanyInfoMode;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class UserInfoActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvOnSchool, tvStuNo, tvBeginDate, tvUserSex,
	tvUserMajor,tvUserCardId,tvUserPhone;
	
	private String comId;//企业ID
	private String workId;//任务id
	private String comName,comPosition;
	private RelativeLayout rb_historyComment;
	
	private ProgressDialog pd;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.user_info);
		AppManager.getAppManager().addActivity(this);
		
		Intent intent = getIntent();
		if (intent!=null) {
			comId=intent.getStringExtra("comId");
			workId=intent.getStringExtra("workId");
		}
		initHeader();
		initView();
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
	}

	private void initView() {
		tvOnSchool = (TextView) findViewById(R.id.tvOnSchool);
		tvStuNo = (TextView) findViewById(R.id.tvStuNo);
		tvBeginDate = (TextView) findViewById(R.id.tvBeginSchool);
		tvUserSex = (TextView) findViewById(R.id.tvUserSex);
		tvUserMajor = (TextView) findViewById(R.id.tvUserMajor);
		tvUserCardId = (TextView) findViewById(R.id.tvUserCardId);
		tvUserPhone=(TextView) findViewById(R.id.tvUserPhone);
		
		rb_historyComment=(RelativeLayout) findViewById(R.id.rb_UserHistoryComment);
		rb_historyComment.setOnClickListener(this);
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		/*pd = SubmitDialog.getProgressDialog(this, "请等待");
		pd.show();
		loadInfo();// 加载信息
*/	}

	private void loadInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("id", comId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.CompanyInfo,
				Urls.MethodType.GET, Urls.function.comdetail, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取用户详情返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<CompanyInfoMode>() {
						}.getType();
						CompanyInfoMode comBean = gson.fromJson(response,
								type);
						if (comBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(comBean.getToken());
							
						}else {
							ToastUtils.showToast(comBean.getInfo());
						}
						if (pd.isShowing()) {
							pd.cancel();
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
			AppManager.getAppManager().finishActivity(UserInfoActivity.this);
			break;
		case R.id.rb_historyComment:
		/*	Intent infoIntent=new Intent(this, WorkHistoryActivity.class);
			infoIntent.putExtra("comId", comId);
			infoIntent.putExtra("workId", workId);
			startActivity(infoIntent);*/
			break;
		default:
			break;
		}
	}
}
