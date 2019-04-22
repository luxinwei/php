package com.dzqc.student.ui.mine;

import java.util.HashMap;
import java.util.Map;

import org.json.JSONException;

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
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.json.JsonToStrUtils;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.UserCertification;
import com.dzqc.student.ui.UserCertificationState;
import com.dzqc.student.utils.AppManager;

public class PersonalInfoActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;
	
	private JsonToStrUtils jsonToStr;
	private String certiStatus="";
	
	private RelativeLayout rl_basic,rl_contact,rl_shool,rl_patform,rl_resume,rl_userCertification;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.user_basic_info);
		AppManager.getAppManager().addActivity(this);
		initView();
	}
	private void  initView()
	{
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getString(R.string.mine_header_title));
		imgBack=(ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		
		rl_userCertification=(RelativeLayout) findViewById(R.id.rl_userCertification);
		rl_basic=(RelativeLayout) findViewById(R.id.rl_userBasicInfo);
		rl_contact=(RelativeLayout) findViewById(R.id.rl_userContactInfo);
		rl_shool=(RelativeLayout) findViewById(R.id.rl_userOnSchool);
		rl_patform=(RelativeLayout) findViewById(R.id.rl_userPatform);
		rl_resume=(RelativeLayout) findViewById(R.id.rl_userResume);
		rl_userCertification.setOnClickListener(this);
		rl_basic.setOnClickListener(this);
		rl_contact.setOnClickListener(this);
		rl_shool.setOnClickListener(this);
		rl_patform.setOnClickListener(this);
		rl_resume.setOnClickListener(this);
	}
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.rl_userCertification://认证信息
			getAuthenticationInfo();
			break;
		case R.id.img_registerBack:
			AppManager.getAppManager().finishActivity(PersonalInfoActivity.this);
			break;
		case R.id.rl_userBasicInfo://基本信息
			startActivity(new Intent(PersonalInfoActivity.this, UserBasicActivity.class));
			break;
		case R.id.rl_userContactInfo://联系信息
			startActivity(new Intent(PersonalInfoActivity.this, UserContactActivity.class));
			break;
		case R.id.rl_userOnSchool://在校信息
			startActivity(new Intent(PersonalInfoActivity.this, UserSchoolInfoActivity.class));
			break;
		case R.id.rl_userPatform://平台信息
			startActivity(new Intent(PersonalInfoActivity.this, UserPatformInfoActivity.class));
			break;
		case R.id.rl_userResume://我的简历
			startActivity(new Intent(PersonalInfoActivity.this, UserResumeActivity.class));
			break;
		default:
			break;
		}
	}
	public void getAuthenticationInfo()
	{
		Map<String, String> map=new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getRealNameAuthenticationInfo, Urls.MethodType.GET,Urls.function.getRealNameAuthenticationInfo, map, new HttpCallback() {
			
			@Override
			public void httpSuccess(String response) {
				// TODO Auto-generated method stub
				if (DzqcStu.isDebug) {
					Log.i("查询学生认证信息----------》》", response);
				}
				jsonToStr=new JsonToStrUtils(response);
				try {
					certiStatus=jsonToStr.getResultStatus();
					if (certiStatus.equals("0")) {
						Intent intent=new Intent(PersonalInfoActivity.this, UserCertification.class);
						startActivity(intent);
					}else if (certiStatus.equals("10")||certiStatus.equals("20")) {
						startActivity(new Intent(PersonalInfoActivity.this, UserCertificationState.class));
					}else if (certiStatus.equals("30")) {
						Intent intent=new Intent(PersonalInfoActivity.this, UserCertification.class);
						intent.putExtra("status", "30");
						startActivity(intent);
					}
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			
			@Override
			public void httpFail(String response) {
				// TODO Auto-generated method stub
			
			}
			
		});
	}
}
