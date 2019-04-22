package com.dzqc.student.ui.innovation;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.adapter.WorkSchoolAlreadyAdapter;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.WorkSchoolAddMode;
import com.dzqc.student.model.WorkSchoolAddMode.DataList.RowList;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class InnovationAlreadySchool extends BaseActivity implements OnClickListener{

	private ImageView imgBack;
	private TextView tvHeader;
	
	private ListView mlistSchool;
	
	private List<RowList> existschool;//已选学校列表
	private String schoolIds;//已选学校id
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.innovation_already_school);
		AppManager.getAppManager().addActivity(this);
		Intent intent=getIntent();
		if (intent!=null) {
			schoolIds=intent.getStringExtra("schoolIds");
		}
		
		initHeader();
		initView();
	}
	
	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.innovation_school_already));
	}
	
	private void initView() {
		mlistSchool = (ListView) findViewById(R.id.mListSchool);
		loadSelectSchool();
	}
	
	private void loadSelectSchool()
	{
		if (schoolIds.equals("")) {
			return;
		}
		Map<String, String> map=new HashMap<String, String>();
		map.put("ids", schoolIds);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getListByIDS,
				Urls.MethodType.GET, Urls.function.getListByIDS, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("加载已选学校列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<WorkSchoolAddMode>() {
						}.getType();
						WorkSchoolAddMode resultBean = gson.fromJson(response,
								type);
						if (resultBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(resultBean.getToken());
							existschool=resultBean.getList().getRows();
							mlistSchool.setAdapter(new WorkSchoolAlreadyAdapter(InnovationAlreadySchool.this, existschool,"exist"));
						}else {
							ToastUtils.showToast(resultBean.getInfo());
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
			AppManager.getAppManager().finishActivity(InnovationAlreadySchool.this);
			break;

		default:
			break;
		}
	}

}
