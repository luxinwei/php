package com.dzqc.enterprise.ui.work;

import java.io.File;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.adapter.ApplyListAdapter;
import com.dzqc.enterprise.adapter.FileAdapter;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;
import com.dzqc.enterprise.http.DownloadThread;
import com.dzqc.enterprise.http.DownloadThread.DownloadListener;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.model.ApplyMode;
import com.dzqc.enterprise.model.ApplyMode.ListInfo.Rows;
import com.dzqc.enterprise.model.Data;
import com.dzqc.enterprise.model.My_join_data;
import com.dzqc.enterprise.model.ResultMode;
import com.dzqc.enterprise.model.WorkDetailModel;
import com.dzqc.enterprise.model.WorkDetailRowMode;
import com.dzqc.enterprise.ui.BaseActivity;
import com.dzqc.enterprise.utils.SubmitDialog;
import com.dzqc.enterprise.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Environment;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;

public class WorkDetailActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvComPosition, tvMoney, tvPayType, tvAlreadyPerson,
			tvLeaveDay, tvPubPerson, tvPubDate;
	private TextView tvContentInfo;
	private TextView tvSeeAll;
	private ImageView imgComMsg;

	private LinearLayout liApplyList;// 申请人列表容器
	private ImageView imgApplyPic;// 申请人头像
	private TextView tvApplyName, tvApplyDate;// 申请人、时间
	private LinearLayout liAgreeRef;// 同意、拒绝容器
	private LinearLayout liApplyExitStatus;// 申请退出容器
	private TextView tvAgreeAction, tvRefuseAction;// 同意拒绝操作
	private TextView tvApplyExitStatus, tvApplyConfirm;// 状态值、同意

	private TextView tvReSend;//重新推送
	
	private String workId;//任务ID
	private String joinId;//参与任务ID
	private String comId;//公司id
	private ProgressDialog pd;
	private ListView lvFile;// 附件列表
	private List<WorkDetailRowMode> listfile;// 附件容器
	private List<Rows> applyList;//申请人列表容器
	private ListView mApplyLIst;//申请人列表
	
	private TextView tvBegin; //开始项目
	private TextView tvEnd; //结束项目
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.work_detail_layout);
		initHeader();
		//initApplyListView();
		initView();
		
		Intent intent = getIntent();
		if (intent != null) {
			workId = intent.getStringExtra("workId");
		}
	}

	/*private void initApplyListView() {
		liApplyList = (LinearLayout) findViewById(R.id.li_apply_content);// 容器
		imgApplyPic = (ImageView) findViewById(R.id.img_apply_photo);
		tvApplyName = (TextView) findViewById(R.id.tv_apply_name);
		tvApplyDate = (TextView) findViewById(R.id.tv_apply_date);

		liAgreeRef = (LinearLayout) findViewById(R.id.li_ApplyAction);
		liApplyExitStatus = (LinearLayout) findViewById(R.id.li_ApplyStatus);
		tvAgreeAction = (TextView) findViewById(R.id.tv_apply_agree);
		tvRefuseAction = (TextView) findViewById(R.id.tv_apply_refuse);
		tvApplyExitStatus = (TextView) findViewById(R.id.tv_apply_status);
		tvApplyConfirm = (TextView) findViewById(R.id.tv_apply_comfirm);
	}*/

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_detail_title));
	}

	private void initView() {
		tvComPosition = (TextView) findViewById(R.id.tv_header_title);
		tvMoney = (TextView) findViewById(R.id.tv_money);
		tvPayType = (TextView) findViewById(R.id.tv_pay_type);
		tvLeaveDay = (TextView) findViewById(R.id.tv_leave_day);
		tvPubPerson = (TextView) findViewById(R.id.tv_publish_person);
		tvPubDate = (TextView) findViewById(R.id.tv_date_show);
		tvAlreadyPerson = (TextView) findViewById(R.id.tv_already_account);
		tvBegin= (TextView) findViewById(R.id.tv_begin_work);
		tvBegin.setOnClickListener(this);
		tvEnd=(TextView) findViewById(R.id.tv_end_work);
		tvEnd.setOnClickListener(this);
		
		imgComMsg = (ImageView) findViewById(R.id.img_com_msg);
		imgComMsg.setOnClickListener(this);
		
		tvSeeAll = (TextView) findViewById(R.id.tv_enable_all);
		tvReSend = (TextView) findViewById(R.id.tv_reSend);
		tvReSend.setVisibility(View.GONE);
		tvReSend.setOnClickListener(this);
		tvSeeAll.setOnClickListener(this);

		liApplyList = (LinearLayout) findViewById(R.id.li_apply_content);
		
		tvContentInfo=(TextView) findViewById(R.id.tvContentInfo);
		lvFile = (ListView) findViewById(R.id.lv_files);
		
		applyList=new ArrayList<Rows>();
		mApplyLIst=(ListView) findViewById(R.id.applyListView);
	}
	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		pd = SubmitDialog.getProgressDialog(this, "请等待");
		pd.show();
		loadInfo();// 加载信息
		applyListInfo();
	}
	/**
	 * 申请人列表信息
	 */
	private void applyListInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("taskid", workId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.listJoinStudents,
				Urls.MethodType.GET, Urls.function.listJoinStudents, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcEnterprise.isDebug) {
							Log.i("获取申请人列表返回结果----------》》", response);
						}
						Gson gson = new Gson(); 	
						java.lang.reflect.Type type = new TypeToken<ApplyMode>() {
						}.getType();
						ApplyMode applyBean = gson.fromJson(response,
								type);
						if (applyBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(applyBean.getToken());
							if (applyBean.getList().getTotal().equals("0")) {
								mApplyLIst.setAdapter(new ApplyListAdapter(WorkDetailActivity.this, null));
							}else {
								applyList=applyBean.getList().getRows();
								mApplyLIst.setAdapter(new ApplyListAdapter(WorkDetailActivity.this, applyList));
							}
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
	
	
	/**
	 * 任务详情信息
	 */
	private void loadInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("id", workId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.TaskDetail,
				Urls.MethodType.GET, Urls.function.detail, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcEnterprise.isDebug) {
							Log.i("获取任务详情列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<WorkDetailModel>() {
						}.getType();
						WorkDetailModel detailBean = gson.fromJson(response,
								type);
						if (detailBean.getStatus() == 1) {
							UserInfoKeeper.updToken(detailBean.getToken());
							Data dataInfo = detailBean
									.getData();
							tvComPosition.setText(dataInfo.getTitle());
							tvMoney.setText(dataInfo.getPay_money());
							tvPayType.setText(dataInfo.getPay_type()
									.equals("1") ? "首付和尾款" : "全款");
							tvPubPerson.setText(dataInfo.getPublisherData()
									.getCompanyname());
							tvPubDate.setText(dataInfo.getAddtime());
							tvAlreadyPerson.setText(dataInfo.getJoin_number()+"人");
							tvLeaveDay.setText(dataInfo.getSurplus_days()+"天");
							//获取公司ID
							comId=dataInfo.getPublisherData().getId();
							
							// 内容部分
							tvContentInfo.setText(dataInfo.getContent());

							// 附件部分
							listfile = dataInfo.getFileList().getRows();
							lvFile.setAdapter(new FileAdapter(
									WorkDetailActivity.this, listfile));
							lvFile.setOnItemClickListener(new OnItemClickListener() {

								@Override
								public void onItemClick(AdapterView<?> arg0,
										View arg1, int arg2, long arg3) {
									// TODO Auto-generated method stub
									File file=new File(Urls.Path.filePath);
									if (!file.exists()) {
										file.mkdirs();
									}
									new DownloadThread(file, listfile.get(
											(int) arg3).getDownload_url().toString(), new DownloadListener() {
												
												@Override
												public void success() {
													// TODO Auto-generated method stub
													ToastUtils.showToast("下载成功");
												}
												
												@Override
												public void failed() {
													// TODO Auto-generated method stub
													ToastUtils.showToast("下载失败");
												}
												
												@Override
												public void download(long downSize, long totalSize) {
													// TODO Auto-generated method stub
													
												}
											}).start();
								}
							});
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
			this.finish();
			break;
		case R.id.img_com_msg://即时消息
			break;
		case R.id.tv_reSend:// 重新发送

			break;
		case R.id.tv_enable_all:// 查看全部

			break;
		case R.id.tv_begin_work://开始项目
			 beginWork();
			break;
		case R.id.tv_end_work://结束任务
			endWork();
			break;
		default:
			break;
		}
	}
	/**
	 * 结束项目
	 */
	private void endWork() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("taskid", workId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.endTask,
				Urls.MethodType.GET, Urls.function.endTask, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcEnterprise.isDebug) {
							Log.i("结束任务返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<ResultMode>() {
						}.getType();
						ResultMode applyBean = gson.fromJson(response,
								type);
						if (applyBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(applyBean.getToken());
							ToastUtils.showToast(applyBean.getInfo());
						}else {
							ToastUtils.showToast(applyBean.getInfo());
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}
	
	/**
	 * 开始项目
	 */
	private void beginWork() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("taskid", workId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.startTask,
				Urls.MethodType.GET, Urls.function.startTask, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcEnterprise.isDebug) {
							Log.i("开始任务返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<ResultMode>() {
						}.getType();
						ResultMode applyBean = gson.fromJson(response,
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
