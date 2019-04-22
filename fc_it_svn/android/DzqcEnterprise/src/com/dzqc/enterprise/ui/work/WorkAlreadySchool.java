package com.dzqc.enterprise.ui.work;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ExpandableListView;
import android.widget.ExpandableListView.OnChildClickListener;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.adapter.WorkSchoolAddAdapter;
import com.dzqc.enterprise.adapter.WorkSchoolAlreadyAdapter;
import com.dzqc.enterprise.config.AppInfoKeeper;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;
import com.dzqc.enterprise.database.table.SchoolDao;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.model.WorkSchoolAddMode;
import com.dzqc.enterprise.model.WorkSchoolAddMode.DataList.RowList;
import com.dzqc.enterprise.ui.BaseActivity;
import com.dzqc.enterprise.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class WorkAlreadySchool extends BaseActivity implements OnClickListener{

	private ImageView imgBack;
	private TextView tvHeader;
	
	private ListView mlistSchool;
	
	String[]group= {"郑州","开封"};
	String[][]child= {{"郑州大学","河南工业大学"},{"开封大学"}};  
	
	private List<RowList> existschool;//已选学校列表
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.work_already_school);
		
		initHeader();
		initView();
	}
	
	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_school_already));
	}
	
	private void initView() {
		mlistSchool = (ListView) findViewById(R.id.mListSchool);
		loadSelectSchool();
	}
	
	private void loadSelectSchool()
	{
		String ids=AppInfoKeeper.getSelectSchool();
		if (ids.equals("000000")) {
			return ;
		}
		ids=ids.substring(0, ids.lastIndexOf(","));
		Map<String, String> map = new HashMap<String, String>();
		map.put("ids", ids);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getListByIDS,
				Urls.MethodType.GET, Urls.function.getListByIDS, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcEnterprise.isDebug) {
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
							mlistSchool.setAdapter(new WorkSchoolAlreadyAdapter(WorkAlreadySchool.this, existschool,"exist"));
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
