package com.dzqc.student.ui.index;

import java.util.HashMap;
import java.util.Map;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.IndexDetailModel;
import com.dzqc.student.model.IndexDetailModel.DataInfo;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.work.WorkCompanyInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.AppTimeUtils;
import com.dzqc.student.utils.SubmitDialog;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

public class IndexDetailActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvJobPosition, tvJobType;
	
	private RelativeLayout rl_pullJob;
	private TextView tvPullMoney, tvPullNeedPerson;
	
	private LinearLayout li_partJob;
	private TextView tvPartMoney, tvPartNeedPerson,tvPartLong;
	
	private TextView tvPubOwner, tvPubDate;
	
	private TextView tvContentInfo;
	private TextView tvSeeAll;
	private TextView tvSubmitResume;
	
	private String indexId;//职位ID
	private String flag="";//标志是否是我投递的职位
	private String comId;
	
	private ProgressDialog pd;
	private String content;//兼职/全职要求说明
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.index_detail_layout);
		
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();
		
		Intent intent = getIntent();
		if (intent != null) {
			indexId = intent.getStringExtra("indexId");
			flag=intent.getStringExtra("flag")==null?"":intent.getStringExtra("flag");
		}
		if (flag.equals("detail")) {
			tvSubmitResume.setVisibility(View.GONE);
		}else {
			tvSubmitResume.setVisibility(View.VISIBLE);
		}
	}


	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
	}

	private void initView() {
		tvJobPosition=(TextView) findViewById(R.id.tv_job_position);
		tvJobType=(TextView) findViewById(R.id.tvJobType);
		
		rl_pullJob=(RelativeLayout) findViewById(R.id.rl_pullJob_info);
		tvPullMoney=(TextView) findViewById(R.id.tv_full_payMoney);
		tvPullNeedPerson=(TextView) findViewById(R.id.tv_full_need_person);
		
		li_partJob=(LinearLayout) findViewById(R.id.li_partJob_info);
		tvPartMoney=(TextView) findViewById(R.id.tv_part_payMoney);
		tvPartNeedPerson=(TextView) findViewById(R.id.tv_part_need_person);
		tvPartLong=(TextView) findViewById(R.id.tv_part_long);
		
		li_partJob.setVisibility(View.GONE);
		
		tvPubOwner = (TextView) findViewById(R.id.tv_publish_Owner);
		tvPubDate = (TextView) findViewById(R.id.tv_pub_date);
		tvPubOwner.setOnClickListener(this);
		
		tvSeeAll = (TextView) findViewById(R.id.tv_see_all);
		tvSeeAll.setOnClickListener(this);

		tvContentInfo=(TextView) findViewById(R.id.tv_JobContent);
		
		tvSubmitResume=(TextView) findViewById(R.id.tv_SubmitResume);
		tvSubmitResume.setOnClickListener(this);
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
	 * 推荐职位详情信息
	 */
	private void loadInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("id", indexId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.positionDetails,
				Urls.MethodType.GET, Urls.function.positionDetails, map,
				new HttpCallback() {

					@SuppressLint("NewApi") @Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取职位详情列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<IndexDetailModel>() {
						}.getType();
						IndexDetailModel detailBean = gson.fromJson(response,
								type);
						DataInfo dataInfo=detailBean.getData();
						if (detailBean.getStatus() == 1) {
							UserInfoKeeper.updToken(detailBean.getToken());
							String status=dataInfo.getState();
							if (status!=null) {
								if (status.equals("3")) {
									tvHeader.setText(getResources().getString(R.string.innovation_full_title));
									tvJobType.setText("全职");
									tvJobType.setTextColor(getResources().getColor(R.color.GRB13));
									tvJobType.setBackground(getResources().getDrawable(R.drawable.tv_bord_blue));
									rl_pullJob.setVisibility(View.VISIBLE);
									tvPullMoney.setText(dataInfo.getRemuneration()+"元/天");
									tvPullNeedPerson.setText("招聘"+dataInfo.getNumber()+"人");
								}else if (status.equals("2")) {
									tvHeader.setText(getResources().getString(R.string.innovation_part_title));
									tvJobType.setText("兼职");
									tvJobType.setTextColor(getResources().getColor(R.color.GRB16));
									tvJobType.setBackground(getResources().getDrawable(R.drawable.tv_bord_red));
									li_partJob.setVisibility(View.VISIBLE);
									tvPartMoney.setText(dataInfo.getRemuneration()+"元/天");
									tvPartNeedPerson.setText("招聘"+dataInfo.getNumber()+"人");
									tvPartLong.setText(dataInfo.getWorking_cycle()+"天时长");
								}else if (status.equals("10")) {
									tvJobType.setText("任务");
								}
							}
							tvJobPosition.setText(dataInfo.getPosition());
							tvPubOwner.setText(dataInfo.getRusername());
							tvPubDate.setText(AppTimeUtils.millsToDateFormat(dataInfo.getRegtime()));
							
							//对内容部分处理
							String tempContent=dataInfo.getResponsibility();
							content=tempContent;
							if (tempContent!=null) {
								if (tempContent.length()>100) {
									tempContent=tempContent.subSequence(0, 100)+"...";
									tvSeeAll.setVisibility(View.VISIBLE);
								}else {
									tvSeeAll.setVisibility(View.GONE);
								}
								// 内容部分
								tvContentInfo.setText(tempContent);
							}else {
								tvContentInfo.setText("");
							}
							comId=dataInfo.getUid();
							
						}else {
							ToastUtils.showToast(detailBean.getInfo());
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
			AppManager.getAppManager().finishActivity(IndexDetailActivity.this);
			break;
		case R.id.tv_see_all://查看全部
			tvContentInfo.setText(content);
			tvSeeAll.setVisibility(View.GONE);
			break;
		case R.id.tv_SubmitResume://提交简历
			submitResume();
			break;
		case R.id.tv_publish_Owner://查看企业详情
			Intent infoIntent=new Intent(this, WorkCompanyInfoActivity.class);
			infoIntent.putExtra("comId", comId);
			startActivity(infoIntent);
			break;
		default:
			break;
		}
	}
	/**
	 * 提交简历
	 */
	private void submitResume() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("id", indexId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.deliveryResume,
				Urls.MethodType.GET, Urls.function.deliveryResume, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i(" 提交简历返回结果----------》》", response);
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
