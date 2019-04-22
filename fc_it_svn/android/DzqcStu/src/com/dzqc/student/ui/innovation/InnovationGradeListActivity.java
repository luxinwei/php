package com.dzqc.student.ui.innovation;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.adapter.WorkGradeAdapter;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.IndustryMode;
import com.dzqc.student.model.WorkGradeListMode;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class InnovationGradeListActivity extends BaseActivity implements
		OnClickListener {
	private ImageView imgBack;
	private TextView tvHeader;
	
	private ListView mlistGrade;
	private List<WorkGradeListMode> listGrade;
	private WorkGradeAdapter gradeAdapter;
	
	private String type;//
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.innovation_school_list);
		AppManager.getAppManager().addActivity(this);
		Intent intent=getIntent();
		if (intent!=null) {
			type=intent.getStringExtra("type");
		}
		initHeader();
		initView();
	}
	private void initHeader()
	{
		imgBack=(ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
	}
	
	private void initView() {
		listGrade=new ArrayList<WorkGradeListMode>();
		mlistGrade=(ListView) findViewById(R.id.mListSchool);
		if (type.equals("grade")) {
			tvHeader.setText(getResources().getString(R.string.innovation_grade_check));
			WorkGradeListMode mode1=new WorkGradeListMode();
			mode1.setGradeName("大一");
			mode1.setGradeCode("1");
			listGrade.add(mode1);
			WorkGradeListMode mode2=new WorkGradeListMode();
			mode2.setGradeName("大一及以上");
			mode2.setGradeCode("2");
			listGrade.add(mode2);
			WorkGradeListMode mode3=new WorkGradeListMode();
			mode3.setGradeName("大二");
			mode3.setGradeCode("3");
			listGrade.add(mode3);
			
			WorkGradeListMode mode4=new WorkGradeListMode();
			mode4.setGradeName("大二及以上");
			mode4.setGradeCode("4");
			listGrade.add(mode4);
			
			WorkGradeListMode mode5=new WorkGradeListMode();
			mode5.setGradeName("大三");
			mode5.setGradeCode("5");
			listGrade.add(mode5);
			WorkGradeListMode mode6=new WorkGradeListMode();
			mode6.setGradeName("大三及以上");
			mode6.setGradeCode("6");
			listGrade.add(mode6);
			
			WorkGradeListMode mode7=new WorkGradeListMode();
			mode7.setGradeName("大四");
			mode7.setGradeCode("7");
			listGrade.add(mode7);
			
			WorkGradeListMode mode8=new WorkGradeListMode();
			mode8.setGradeName("大四及以上");
			mode8.setGradeCode("6");
			listGrade.add(mode8);
			
			gradeAdapter=new WorkGradeAdapter(this, listGrade,type);
			mlistGrade.setAdapter(gradeAdapter);
			
			mlistGrade.setOnItemClickListener(new OnItemClickListener() {

				@Override
				public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
						long arg3) {
					// TODO Auto-generated method stub
					ImageView img=(ImageView) arg1.findViewById(R.id.imgCheck);
					img.setBackgroundResource(R.drawable.confirm);
					String gradeName=listGrade.get((int) arg3).getGradeName();
					Intent intent=new Intent();
				    intent.putExtra("grade", gradeName);
				    intent.putExtra("id", listGrade.get((int) arg3).getGradeCode());
				    setResult(RESULT_OK, intent);
				    InnovationGradeListActivity.this.finish();
				}
			});
		}else {
			tvHeader.setText(getResources().getString(R.string.innovation_enterprise_info));
			loadIndustryInfo();
		}
	}
	
	private void loadIndustryInfo() {
		Map<String, String> map = new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getListByIndustry,
				Urls.MethodType.GET, Urls.function.getListByIndustry, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取行业列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type types = new TypeToken<IndustryMode>() {
						}.getType();
						IndustryMode industryBean = gson.fromJson(response,
								types);
						if (industryBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(industryBean.getToken());
							List<com.dzqc.student.model.IndustryMode.DataList.Rows> listrows= industryBean.getList().getRows();
							for (int i = 0; i < listrows.size(); i++) {
								com.dzqc.student.model.IndustryMode.DataList.Rows mode=listrows.get(i);
								WorkGradeListMode modeTemp=new WorkGradeListMode();
								modeTemp.setGradeName(mode.getName());
								modeTemp.setGradeCode(mode.getId());
								listGrade.add(modeTemp);
							}
							gradeAdapter=new WorkGradeAdapter(InnovationGradeListActivity.this, listGrade,type);
							mlistGrade.setAdapter(gradeAdapter);
							mlistGrade.setOnItemClickListener(new OnItemClickListener() {

								@Override
								public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
										long arg3) {
									// TODO Auto-generated method stub
									ImageView img=(ImageView) arg1.findViewById(R.id.imgCheck);
									img.setBackgroundResource(R.drawable.confirm);
									String gradeName=listGrade.get((int) arg3).getGradeName();
									Intent intent=new Intent();
								    intent.putExtra("grade", gradeName);
								    intent.putExtra("id", listGrade.get((int) arg3).getGradeCode());
								    setResult(RESULT_OK, intent);
								    InnovationGradeListActivity.this.finish();
								}
							});
						}else {
							ToastUtils.showToast(industryBean.getInfo());
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
			AppManager.getAppManager().finishActivity(InnovationGradeListActivity.this);
			break;
		default:
			break;
		}
	}
}
