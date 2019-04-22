package com.dzqc.student.ui;

import java.util.HashMap;
import java.util.Map;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.http.HttpImage;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.json.UserCertificationJson;
import com.dzqc.student.model.UserCertificationMode;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.SubmitDialog;

public class UserCertificationState extends BaseActivity{

	private TextView tvheader, tvName,tvNo,tvStuNo,tvSchool,tvMajor,tvDate;
	private ImageView imgState,imgback,imgPhoto;
	
	private UserCertificationJson jsonToStr;
	
	private ProgressDialog pd;// 耗时操作框
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.user_certification_status);
		AppManager.getAppManager().addActivity(this);
		initView();
	}
	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		getAuthenticationInfo();
	}
	/**
	 * 初始化组件
	 */
	private void initView()
	{
		tvheader=(TextView) findViewById(R.id.tvHeadInfo);
		tvheader.setText(getResources().getString(R.string.certificate_header_title));
		imgback=(ImageView) findViewById(R.id.img_registerBack);
		imgback.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				UserCertificationState.this.finish();
			}
		});
		
		tvName=(TextView) findViewById(R.id.tv_certificateName);
		tvNo=(TextView)findViewById(R.id.tv_certificateNo);
		tvStuNo=(TextView)findViewById(R.id.tv_certificateStuNo);
		tvSchool=(TextView)findViewById(R.id.tv_certificateSchool);
		tvMajor=(TextView)findViewById(R.id.tv_certificateMajor);
		tvDate=(TextView)findViewById(R.id.tv_certificateDate);
		
		imgState=(ImageView) findViewById(R.id.img_certification_status);
		imgPhoto=(ImageView) findViewById(R.id.img_certification_photo);
	}

	public void getAuthenticationInfo()
	{
		pd = SubmitDialog.getProgressDialog(UserCertificationState.this, "请等待");
		pd.show();
		Map<String, String> map=new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getRealNameAuthenticationInfo, Urls.MethodType.GET,Urls.function.getRealNameAuthenticationInfo, map, new HttpCallback() {
			
			@Override
			public void httpSuccess(String response) {
				// TODO Auto-generated method stub
				if (DzqcStu.isDebug) {
					Log.i("查询学生认证信息----------》》", response);
				}
				jsonToStr=new UserCertificationJson(response);
				bindData(jsonToStr.getJsonData());
			}
			
			@Override
			public void httpFail(String response) {
				// TODO Auto-generated method stub
			
			}
			
		});
	}
	
	
	private void bindData(UserCertificationMode mode)
	{
		if (mode!=null) {
			tvName.setText(mode.getRealName());
			tvNo.setText(mode.getId_card());
			tvStuNo.setText(mode.getUserNo());
			tvSchool.setText(mode.getSchool());
			tvDate.setText(mode.getSchoolyears());
			tvMajor.setText(mode.getMajor());
			String status=mode.getAudit();
			if (status!=null) {
				if (status.equals("20")) {
					imgState.setBackgroundResource(R.drawable.check_icon1);
				}else {
					imgState.setBackgroundResource(R.drawable.check_icon2);
				}
			}
			loadImage(mode.getStuPhoto());
		}
		else {
			if (pd.isShowing()) {
				pd.cancel();
			}
		}
	}
	
	/**
	 * 下载图片
	 */
	private void loadImage(String url){
		  HttpImage.loadImage(imgPhoto, url, R.drawable.sample_img, R.drawable.sample_img);
		  if (pd.isShowing()) {
				pd.cancel();
			}
	}
}
