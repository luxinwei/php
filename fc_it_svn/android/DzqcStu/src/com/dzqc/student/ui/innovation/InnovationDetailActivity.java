package com.dzqc.student.ui.innovation;

import java.util.HashMap;
import java.util.Map;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.InnovationDetailModel;
import com.dzqc.student.model.InnovationDetailModel.DataInfo;
import com.dzqc.student.model.InnovationDetailModel.DataInfo.UserInfo;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.AppTimeUtils;
import com.dzqc.student.utils.SubmitDialog;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

public class InnovationDetailActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvPubOwner, tvPubDate;
	private TextView tvIdeasTitle;
	private TextView tvContentInfo;
	
	private String innovationId;//双创ID
	private String Uid;//发布者id
	
	private ImageView imgAgree;//赞
	
	private ProgressDialog pd;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.innovation_detail_layout);
		AppManager.getAppManager().addActivity(this);
		
		Intent intent = getIntent();
		if (intent != null) {
			innovationId = intent.getStringExtra("innovationId");
		}
		initHeader();
		initView();
	}


	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.innovation_detail_title));
	}

	private void initView() {
		tvIdeasTitle=(TextView) findViewById(R.id.tv_ideas_title);
		tvPubOwner = (TextView) findViewById(R.id.tv_ideas_Owner);
		tvPubDate = (TextView) findViewById(R.id.tv_ideas_date);
		imgAgree=(ImageView) findViewById(R.id.imgAgree);
		imgAgree.setOnClickListener(this);
		tvPubOwner.setOnClickListener(this);
		
		tvContentInfo=(TextView) findViewById(R.id.tv_JobContent);
		
	}
	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		pd = SubmitDialog.getProgressDialog(this, "请等待");
		pd.show();
		loadInfo();// 加载信息
	}
	/**
	 *双创详情信息
	 */
	private void loadInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("id", innovationId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.ideasDetail,
				Urls.MethodType.GET, Urls.function.ideasDetail, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取双创详情返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<InnovationDetailModel>() {
						}.getType();
						InnovationDetailModel detailBean = gson.fromJson(response,
								type);
						if (detailBean.getStatus() == 1) {
							UserInfoKeeper.updToken(detailBean.getToken());
							DataInfo dataInfo=detailBean.getData();
							UserInfo userInfo=dataInfo.getUser();
							if (userInfo!=null) {
								tvPubOwner.setText(userInfo.getRealname());
							}
							tvIdeasTitle.setText(dataInfo.getTitle());
							tvContentInfo.setText(dataInfo.getDesc());
							//时间转换
							String date=AppTimeUtils.millsToDateFormat(detailBean.getData().getAddtime());
							tvPubDate.setText(date);
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
			AppManager.getAppManager().finishActivity(InnovationDetailActivity.this);
			break;
		case R.id.imgAgree://赞
			supportInfo();
			break;
		case R.id.tv_ideas_Owner://查看Usre信息
			Intent infoIntent=new Intent(this, IndexUserInfoActivity.class);
			startActivity(infoIntent);
			break;
		default:
			break;
		}
	}
	/**
	 * 赞
	 */
	private void supportInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("id", innovationId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.agreeIdeas,
				Urls.MethodType.GET, Urls.function.agreeIdeas, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("赞双创返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel applyBean = gson.fromJson(response,
								type);
						if (applyBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(applyBean.getToken());
							ToastUtils.showToast(applyBean.getInfo());
						}else {
							ToastUtils.showToast(applyBean.getInfo());
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
}
