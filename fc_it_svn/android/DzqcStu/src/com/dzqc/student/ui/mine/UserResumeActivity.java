package com.dzqc.student.ui.mine;

import java.util.HashMap;
import java.util.Map;

import android.annotation.SuppressLint;
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
import com.dzqc.student.http.HttpImage;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.ResumeMode;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class UserResumeActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvUserName,tvCardId;
	private TextView tvUserPhone,tvEmail,tvSchool,tvMajor,tvSchoolDate,tvUserSay;
	private ImageView imgUserPic,imgSex;
	private RelativeLayout rl_userSay;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.personal_resume_info);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.mine_resume));
	}

	private void initView() {
		imgUserPic = (ImageView) findViewById(R.id.img_userResumePic);
		tvUserName = (TextView) findViewById(R.id.tv_userResumeName);
		imgSex = (ImageView) findViewById(R.id.img_userResumeSex);
		tvCardId = (TextView) findViewById(R.id.tv_userResumeCardId);
		tvUserPhone=(TextView) findViewById(R.id.tv_userResumePhone);
		tvEmail=(TextView) findViewById(R.id.tv_userResumeEmail);
		tvSchool=(TextView) findViewById(R.id.tv_userResumeSchool);
		tvMajor=(TextView) findViewById(R.id.tv_userResumeMajor);
		tvSchoolDate=(TextView) findViewById(R.id.tv_userSchoolDate);
		
		rl_userSay=(RelativeLayout) findViewById(R.id.rl_userSay);
		rl_userSay.setOnClickListener(this);
		
		tvUserSay=(TextView) findViewById(R.id.tv_userResumeSay);
		
		}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		loadInfo();//查询简历
	}

	
	/**
	 * 查询用户基本信息
	 */
	private void loadInfo() {
		Map<String, String> map = new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.viewPersonalResume,
				Urls.MethodType.GET, Urls.function.viewPersonalResume, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("用户简历信息返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<ResumeMode>() {
						}.getType();
						ResumeMode resumeBean = gson.fromJson(response,
								type);
						if (resumeBean.getStatus()==1) {
							UserInfoKeeper.updToken(resumeBean.getToken());
							bindResumeInfo(resumeBean);						
						}else {
							ToastUtils.showToast(resumeBean.getInfo());
						}
						
					}
					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}

	@SuppressLint("NewApi") private void bindResumeInfo(ResumeMode resumeBean)
	{
		tvUserName.setText(resumeBean.getData().getRealname());
		tvUserPhone.setText(resumeBean.getData().getMobile());
		//tvEmail.setText(resumeBean.getData().getEmail());
		tvCardId.setText(resumeBean.getData().getId_card());
		String sexId=resumeBean.getData().getSex();
		if (sexId.equals("1")) {
			imgSex.setBackground(getResources().getDrawable(R.drawable.male));
		}else {
			imgSex.setBackground(getResources().getDrawable(R.drawable.female));
		}
		tvSchool.setText(resumeBean.getData().getUniversity());
		tvMajor.setText(resumeBean.getData().getMajor());
		tvSchoolDate.setText(resumeBean.getData().getSchool_years()+"年");
		tvUserSay.setText(resumeBean.getData().getPersonal_note());
		String url=resumeBean.getData().getDownload_url();
		if (url!=null) {
			if (!url.equals("")) {
				HttpImage.loadImage(imgUserPic, url, R.drawable.myimg,  R.drawable.myimg);
			}
		}
	}
	
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.img_registerBack:
			AppManager.getAppManager().finishActivity(UserResumeActivity.this);
			break;
		case R.id.rl_userSay://个人说明
			Intent intent=new Intent(UserResumeActivity.this, UserSayingActivity.class);
			startActivity(intent);
			break;
		default:
			break;
		}
	}

}
