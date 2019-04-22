package com.dzqc.enterprise.ui.work;

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

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.adapter.WorkSchoolAdapter;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.model.WorkSchoolListMode;
import com.dzqc.enterprise.model.WorkSchoolListMode.DataList.RowList;
import com.dzqc.enterprise.ui.BaseActivity;
import com.dzqc.enterprise.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class WorkSchoolListActivity extends BaseActivity implements
		OnClickListener {
	private ImageView imgBack;
	private TextView tvHeader;
	
	private ListView mlistViewSchool;
	List<RowList> rowLists; //学校列表容器
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.work_school_list);
		initHeader();
		initView();
	}
	private void initHeader()
	{
		imgBack=(ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_school_check));
	}
	
	private void initView() {
		mlistViewSchool=(ListView) findViewById(R.id.mListSchool);
		
		mlistViewSchool.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View v, int position,
					long index) {
				// TODO Auto-generated method stub
				RowList row=rowLists.get((int) index);
				Intent intent=new Intent(WorkSchoolListActivity.this,WorkSchoolAddActivity.class);
				intent.putExtra("cityId", row.getId());
				startActivity(intent);
			}
		});
		loadCityInfo();
	}

	public void loadCityInfo()
	{
		Map<String, String> map = new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.henanCity,
				Urls.MethodType.GET, Urls.function.henanCity, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcEnterprise.isDebug) {
							Log.i("加载城市列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<WorkSchoolListMode>() {
						}.getType();
						WorkSchoolListMode resultBean = gson.fromJson(response,
								type);
						if (resultBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(resultBean.getToken());
							rowLists=resultBean.getList().getRows();
							mlistViewSchool.setAdapter(new WorkSchoolAdapter(WorkSchoolListActivity.this, rowLists,"choose"));
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
			this.finish();
			break;
		default:
			break;
		}
	}
}
