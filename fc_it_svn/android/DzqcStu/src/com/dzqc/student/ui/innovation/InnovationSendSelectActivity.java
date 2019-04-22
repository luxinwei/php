package com.dzqc.student.ui.innovation;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.database.LocalShoolDbHelp;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.model.UserBasicMode;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.MainActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.EncodeUtf8;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.CompoundButton.OnCheckedChangeListener;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

public class InnovationSendSelectActivity extends BaseActivity implements
		OnClickListener {
	private ImageView imgBack;
	private TextView tvHeader;
	
	private TextView tvAlreadySchool,tvAlreadyMajor,tvConfirm;
	private ImageView imgSchoolGo,imgMajorGo,imgGradeGo;

	private int gradeCode=100;
	private int enterpriseCode=200;
	private int majorCode=300;
	
	private TextView tvSelectGrades,tvSelectMajors,tvSelectSchools,tv_SelectEnterprise;
	
	private CheckBox cbxStudentType,cbxEnterpriseType;
	private LinearLayout liStudent;
	private RelativeLayout rlEnterprise,rlStudentCheck,rlEnterpriseCheck;
	
	public Bundle bundle1;//发布内容参数
	
	private LocalShoolDbHelp dbHelp;
	private List<Map<String, String>> listMapSchool;//已选学校
	private String alreadySchoolsName,alreadySchoolsId;//已选学校字符串，id
	private String alreadyMajorsName,alreadyMajorsId;//已选专业字符串，id
	private String alreadyGradeName,alreadyGradeId;//已选级别字符串，id
	private String alreadyEntName,alreadyEntId;//已选企业类型字符串，id
	private String stuCheckType,entCheckType;//企业或学生选择
	private String Uid;//学生UId
	
	private String title,content;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.innovation_send_select);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();
		
		dbHelp=LocalShoolDbHelp.getInstance(this);
		listMapSchool=new ArrayList<Map<String,String>>();
		Intent intent=getIntent();
		if (intent!=null) {
			bundle1=intent.getBundleExtra("bundle1");
			title=bundle1.getString("title");
			content=bundle1.getString("content");
		}
	}
	private void initHeader()
	{
		imgBack=(ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.innovation_send_limit));
	}
	
	private void initView() {
		liStudent=(LinearLayout) findViewById(R.id.liStudent);
		rlEnterprise=(RelativeLayout) findViewById(R.id.rlEnterprise);
		rlStudentCheck=(RelativeLayout) findViewById(R.id.rlStudentCheck);
		rlEnterpriseCheck=(RelativeLayout) findViewById(R.id.rlEnterpriseCheck);
		rlEnterprise.setOnClickListener(this);
		rlStudentCheck.setOnClickListener(this);
		rlEnterpriseCheck.setOnClickListener(this);
		cbxStudentType=(CheckBox) findViewById(R.id.cbx_studentType);
		cbxEnterpriseType=(CheckBox) findViewById(R.id.cbx_enterpriseType);
		cbxStudentType.setOnCheckedChangeListener(new OnCheckedChangeListener() {
			
			@Override
			public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
				// TODO Auto-generated method stub
			if (isChecked) {
				liStudent.setVisibility(View.VISIBLE);//显示学生推送选择列表
			}else {
				liStudent.setVisibility(View.GONE);//隐藏学生推送选择列表
			 }	
			}
		});
		cbxEnterpriseType.setOnCheckedChangeListener(new OnCheckedChangeListener() {
			
			@Override
			public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
				// TODO Auto-generated method stub
				if (isChecked) {
					rlEnterprise.setVisibility(View.VISIBLE);//显示企业推送选择列表
				}else {
					rlEnterprise.setVisibility(View.GONE);//隐藏企业推送选择列表
				 }	
			}
		});
		
		
		tvAlreadySchool = (TextView) findViewById(R.id.tvAlreadySchool);
		tvAlreadyMajor = (TextView) findViewById(R.id.tvAlreadyMajor);
		tvConfirm = (TextView) findViewById(R.id.tvCompletedAction);
		imgSchoolGo = (ImageView) findViewById(R.id.imgSchoolGo);
		imgMajorGo = (ImageView) findViewById(R.id.imgMajorGo);
		imgGradeGo = (ImageView) findViewById(R.id.imgGradeGo);
		tvAlreadySchool.setOnClickListener(this);
		tvAlreadyMajor.setOnClickListener(this);
		imgSchoolGo.setOnClickListener(this);
		imgMajorGo.setOnClickListener(this);
		imgGradeGo.setOnClickListener(this);
		tvConfirm.setOnClickListener(this);
		
		tvSelectGrades=(TextView) findViewById(R.id.tv_SelectGrades);
		tvSelectMajors=(TextView) findViewById(R.id.tv_SelectMajors);
		tvSelectSchools=(TextView) findViewById(R.id.tv_SelectSchools);
		tv_SelectEnterprise=(TextView) findViewById(R.id.tv_SelectEnterprise);
		
		getUserBasicInfo();
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		alreadySchoolsId="";
		alreadySchoolsName="";
		listMapSchool=dbHelp.getSchoolInfo();
		Map<String, String> mapSchool=new HashMap<String, String>();
		for (int i = 0; i < listMapSchool.size(); i++) {
			mapSchool =listMapSchool.get(i);
			alreadySchoolsId=mapSchool.get("schoolId")+","+alreadySchoolsId;
			alreadySchoolsName=mapSchool.get("schoolName")+","+alreadySchoolsName;
		}
		if (DzqcStu.isDebug) {
			Log.i("已选结果----",alreadySchoolsName);
		}
		
		if (alreadySchoolsName.equals("")) {
			tvSelectSchools.setText("");
		}else {
			tvSelectSchools.setText(alreadySchoolsName.substring(0, alreadySchoolsName.lastIndexOf(",")));
		}
	}
	
	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tvAlreadySchool:
			if (alreadySchoolsId.length()==0) {
				ToastUtils.showToast("你的小仓库中没有选择的学校");
				return;
			}
			Intent intentSchool=new  Intent(this, InnovationAlreadySchool.class);
			intentSchool.putExtra("schoolIds", alreadySchoolsId.substring(0, alreadySchoolsId.lastIndexOf(",")));
			startActivity(intentSchool);
			break;
		case R.id.tvAlreadyMajor:
			break;
		case R.id.imgSchoolGo:
			startActivity(new Intent(this, InnovationSchoolListActivity.class));
			break;
		case R.id.imgMajorGo:
			if (alreadySchoolsId.equals("")) {
				ToastUtils.showToast("请先选中学校");
				return;
			}
			Intent intent=new Intent(InnovationSendSelectActivity.this, InnovationMajorListActivity.class);
			intent.putExtra("schoolIds", alreadySchoolsId.substring(0, alreadySchoolsId.lastIndexOf(",")));
			startActivityForResult(intent, majorCode);
			break;
		case R.id.imgGradeGo://选择级别
			Intent intentGrade=new Intent(InnovationSendSelectActivity.this, InnovationGradeListActivity.class);
			intentGrade.putExtra("type", "grade");
			startActivityForResult(intentGrade, gradeCode);
			break;
		case R.id.img_registerBack:
			AppManager.getAppManager().finishActivity(InnovationSendSelectActivity.this);
			break;
		case R.id.tvCompletedAction://完成
			SubmitInfo();
			break;
		case R.id.rlStudentCheck://学生范围选择
			if (cbxStudentType.isChecked()) {
				cbxStudentType.setChecked(false);
				liStudent.setVisibility(View.GONE);//隐藏学生推送选择列表
			}else {
				cbxStudentType.setChecked(true);
				liStudent.setVisibility(View.VISIBLE);//显示学生推送选择列表
			}
			break;
		case R.id.rlEnterpriseCheck://企业范围选择
			if (cbxEnterpriseType.isChecked()) {
				cbxEnterpriseType.setChecked(false);
				rlEnterprise.setVisibility(View.GONE);
			}else {
				cbxEnterpriseType.setChecked(true);
				rlEnterprise.setVisibility(View.VISIBLE);
			}
			break;
		case R.id.rlEnterprise://企业类型选择
			Intent intentEnterprise=new Intent(InnovationSendSelectActivity.this, InnovationGradeListActivity.class);
			intentEnterprise.putExtra("type", "enterprise");
			startActivityForResult(intentEnterprise, 200);
			break;
		default:
			break;
		}
	}
	
	//判断所选类别
	private boolean checkType(){
		boolean flag=true;
		if (cbxEnterpriseType.isChecked()&&cbxStudentType.isChecked()) {
			stuCheckType="1";//企业学生都推送
			entCheckType="1";
			if (tv_SelectEnterprise.getText().equals("")||tvSelectSchools.getText().equals("")||tvSelectMajors.getText().equals("")||tvSelectGrades.getText().equals("")) {
				ToastUtils.showToast("推送的企业所属行业或学生范围不能为空");
				flag= false;
			}
		}else if (cbxEnterpriseType.isChecked()&&!cbxStudentType.isChecked()) {
			entCheckType="1";//只推送企业
			stuCheckType="0";
			alreadySchoolsId="";
			alreadyMajorsId="";
			alreadyGradeId="";
			if (tv_SelectEnterprise.getText().equals("")) {
				ToastUtils.showToast("请选择企业所属行业");
				flag= false;
			}
		}else if (!cbxEnterpriseType.isChecked()&&cbxStudentType.isChecked()) {
			stuCheckType="1";//只推送学生
			entCheckType="0";
			alreadyEntId="";
			if (tvSelectSchools.getText().equals("")||tvSelectMajors.getText().equals("")||tvSelectGrades.getText().equals("")) {
				ToastUtils.showToast("请选择推送的学生范围");
				flag= false;
			}
		}else if (!cbxEnterpriseType.isChecked()&&!cbxStudentType.isChecked()) {
			ToastUtils.showToast("请至少选择一种推送类型");
			flag= false;
		}
		return flag;
	}
	
	//提交信息
	private void SubmitInfo() {
		if (DzqcStu.isDebug) {
			Log.i("验证boolean值", checkType()+"");
		}
	    if (!checkType()) {//检查推送类别,并验证
			return;
		};
		Map<String, String> map = new HashMap<String, String>();
		map.put("title", title);
		map.put("desc", content);
		map.put("uid", Uid);
		map.put("student_type", stuCheckType);
		map.put("company_type", entCheckType);
		map.put("university", alreadySchoolsId);
		map.put("major", alreadyMajorsId);
		map.put("grade", alreadyGradeId);
		map.put("typeid", alreadyEntId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.publishIdea,
				Urls.MethodType.GET, Urls.function.publishIdea, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("提交双创返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel submitBean = gson.fromJson(response,
								type);
						if (submitBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(submitBean.getToken());
							ToastUtils.showToast(submitBean.getInfo());
							Intent intent=new Intent(InnovationSendSelectActivity.this, MainActivity.class);
							intent.putExtra("flag", "innovation");
							startActivity(intent);
							InnovationSendSelectActivity.this.finish();
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
	
	
	//获取用户基本信息
	private void getUserBasicInfo()
	{
		Map<String, String> map = new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.myBaseData,
				Urls.MethodType.GET, Urls.function.myBaseData, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("用户基本信息返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<UserBasicMode>() {
						}.getType();
						UserBasicMode userBean = gson.fromJson(response,
								type);
						if (userBean.getStatus()==1) {
							UserInfoKeeper.updToken(userBean.getToken());
							Uid=userBean.getUser().getId();
						}else {
							ToastUtils.showToast(userBean.getInfo());
						}
					}
					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}
	
	
	
	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		// TODO Auto-generated method stub
		super.onActivityResult(requestCode, resultCode, data);
		if (requestCode==gradeCode) {
			if (resultCode==RESULT_OK) {
				String grade= data.getStringExtra("grade");
				String idString=data.getStringExtra("id");
				alreadyGradeId=idString;
				tvSelectGrades.setText(grade);
			}
		}
		if (requestCode==enterpriseCode) {
			if (resultCode==RESULT_OK) {
				String enterprise= data.getStringExtra("grade");
				String idString=data.getStringExtra("id");
				alreadyEntId=idString;
				tv_SelectEnterprise.setText(enterprise);
			}
		}
		if (requestCode==majorCode) {
			if (resultCode==RESULT_OK) {
				String majorId= data.getStringExtra("majorId");
				String majorName=data.getStringExtra("majorName");
				alreadyMajorsId=majorId;
				tvSelectMajors.setText(majorName);
			}
		}
	}
}
