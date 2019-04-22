package com.dzqc.student.ui.index;

import java.util.HashMap;
import java.util.Map;

import android.app.ProgressDialog;
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
import com.dzqc.student.model.UserModel;
import com.dzqc.student.model.UserModel.Info;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.SubmitDialog;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class IndexUserInfoActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvOnSchool, tvStuNo, tvSchoolDate, tvSex,
	tvMajor,tvCardId,tvPhone;
	
	private RelativeLayout rb_historyComment;
	
	private ProgressDialog pd;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.user_info);
		AppManager.getAppManager().addActivity(this);
		
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
		tvSchoolDate = (TextView) findViewById(R.id.tvBeginSchool);
		tvSex = (TextView) findViewById(R.id.tvUserSex);
		tvMajor = (TextView) findViewById(R.id.tvUserMajor);
		tvCardId = (TextView) findViewById(R.id.tvUserCardId);
		tvPhone=(TextView) findViewById(R.id.tvUserPhone);
		
		rb_historyComment=(RelativeLayout) findViewById(R.id.rb_UserHistoryComment);
		rb_historyComment.setOnClickListener(this);
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		pd = SubmitDialog.getProgressDialog(this, "请等待");
		pd.show();
		loadInfo();// 加载信息
	}

	private void loadInfo() {
		Map<String, String> map = new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getRealNameAuthenticationInfo,
				Urls.MethodType.GET, Urls.function.getRealNameAuthenticationInfo, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取学生详情返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<UserModel>() {
						}.getType();
						UserModel userBean = gson.fromJson(response,
								type);
						
						if (userBean!=null) {
							UserInfoKeeper.updToken(userBean.getToken());
							Info userInfo=userBean.getInfo();
							tvOnSchool.setText(userInfo.getUniversity());
							tvStuNo.setText(userInfo.getUser_no());
							tvSchoolDate.setText(userInfo.getSchool_years());
							tvSex.setText(userInfo.getSex());
							
							tvMajor.setText(userInfo.getMajor());
							tvCardId.setText(userInfo.getId_card());
							tvPhone.setText(userInfo.getMobile());
							tvHeader.setText(userInfo.getRealname());
						}else {
							ToastUtils.showToast("获取信息失败");
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
			AppManager.getAppManager().finishActivity(IndexUserInfoActivity.this);
			break;
		case R.id.rb_UserHistoryComment:
			/*Intent infoIntent=new Intent(this, WorkHistoryActivity.class);
			infoIntent.putExtra("comId", comId);
			infoIntent.putExtra("workId", workId);
			startActivity(infoIntent);*/
			break;
		default:
			break;
		}
	}
}
