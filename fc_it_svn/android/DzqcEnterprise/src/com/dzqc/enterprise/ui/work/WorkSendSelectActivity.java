package com.dzqc.enterprise.ui.work;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.ui.BaseActivity;

public class WorkSendSelectActivity extends BaseActivity implements
		OnClickListener {
	private ImageView imgBack;
	private TextView tvHeader;
	
	private TextView tvAlreadySchool,tvAlreadyMajor,tvAlreadyGrade,tvNext;
	private ImageView imgSchoolGo,imgMajorGo,imgGradeGo;

	private int gradeCode=100;
	private TextView tvSelectGrades,tvSelectMajors,tvSelectSchools;
	private TextView etSendPerson;//推送人数
	
	public Bundle bundle1;//发布内容参数
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.work_send_select);
		initHeader();
		initView();
		
		Intent intent=getIntent();
		if (intent!=null) {
			bundle1=intent.getBundleExtra("bundle1");
		}
	}
	private void initHeader()
	{
		imgBack=(ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_send_limit));
	}
	
	private void initView() {
		tvAlreadySchool = (TextView) findViewById(R.id.tvAlreadySchool);
		tvAlreadyMajor = (TextView) findViewById(R.id.tvAlreadyMajor);
		tvAlreadyGrade = (TextView) findViewById(R.id.tvAlreadyGrade);
		tvNext = (TextView) findViewById(R.id.tvNextStep);
		imgSchoolGo = (ImageView) findViewById(R.id.imgSchoolGo);
		imgMajorGo = (ImageView) findViewById(R.id.imgMajorGo);
		imgGradeGo = (ImageView) findViewById(R.id.imgGradeGo);
		tvAlreadySchool.setOnClickListener(this);
		tvAlreadyMajor.setOnClickListener(this);
		tvAlreadyGrade.setOnClickListener(this);
		imgSchoolGo.setOnClickListener(this);
		imgMajorGo.setOnClickListener(this);
		imgGradeGo.setOnClickListener(this);
		tvNext.setOnClickListener(this);
		
		tvSelectGrades=(TextView) findViewById(R.id.tv_SelectGrades);
		tvSelectMajors=(TextView) findViewById(R.id.tv_SelectMajors);
		tvSelectSchools=(TextView) findViewById(R.id.tv_SelectSchools);
		etSendPerson=(TextView) findViewById(R.id.etPersonNum);
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tvAlreadySchool:
			startActivity(new Intent(this, WorkAlreadySchool.class));
			break;
		case R.id.tvAlreadyMajor:
			break;
		case R.id.tvAlreadyGrade:
			break;
		case R.id.imgSchoolGo:
			startActivity(new Intent(this, WorkSchoolListActivity.class));
			break;
		case R.id.imgMajorGo:
			break;
		case R.id.imgGradeGo://选择级别
			startActivityForResult(new Intent(this, WorkGradeListActivity.class), gradeCode);
			break;
		case R.id.img_registerBack:
			this.finish();
			break;
		case R.id.tvNextStep:
			Intent intent=new Intent(this, WorkOtherInfoActivity.class);
			Bundle bundle2=new Bundle();
			bundle2.putString("schools", tvSelectSchools.getText().toString());
			bundle2.putString("majors", tvSelectMajors.getText().toString());
			bundle2.putString("grades", tvSelectGrades.getText().toString());
			bundle2.putString("sendNum", etSendPerson.getText().toString());
			intent.putExtra("bundle2", bundle2);
			intent.putExtra("bundle1", bundle1);
			startActivity(intent);
			break;
		default:
			break;
		}
	}
	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		// TODO Auto-generated method stub
		super.onActivityResult(requestCode, resultCode, data);
		if (requestCode==gradeCode) {
			if (resultCode==RESULT_OK) {
				String grade= data.getStringExtra("grade");
				tvSelectGrades.setText(grade);
			}
		}
	}
}
