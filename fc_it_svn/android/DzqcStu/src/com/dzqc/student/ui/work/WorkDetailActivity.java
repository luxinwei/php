package com.dzqc.student.ui.work;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.Window;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.adapter.FileAdapter;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.My_join_data;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.model.WorkDetailModel;
import com.dzqc.student.model.WorkDetailRowMode;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.ui.view.MyListView;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.AppTimeUtils;
import com.dzqc.student.utils.SubmitDialog;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class WorkDetailActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvComPosition, tvMoney, tvNeedPerson, tvLeaveDay,
			tvPubPerson, tvPubDate;
	private TextView tvSeeAll, tvContentInfo;
	private ImageView imgComMsg;
	private MyListView lvFile;// 附件列表
	private List<WorkDetailRowMode> listfile;// 附件容器

	private TextView tvApplyWork;// 任务申请
	private TextView tvApplyExit;// 已申请状态下，申请退出
	private TextView tvAgreeExit, tvAgreeReady;// 已同意状态下，申请退出，准备
	private TextView tvInFile;// 归档
	private LinearLayout liAgree;// 已同意下的容器
	private RelativeLayout rlDoing;// 进行中
	private TextView tvWorkComment;//评论项目
	private ProgressBar pdStatus;// 进行中状态
	private TextView tvProgressAllSum;// 总天数
	private TextView tvProgressLeaveSum;// 剩余天数
	
	private ImageView imgBgStatus;// 申请状态img
	private String mytype;// 申请状态
	private String workId;// 任务Id
	private String joinId;//任务参与ID
	private String comId;//公司ID

	private String content;//任务要求说明
	
	private ProgressDialog pd;
	private LayoutInflater dialogflate;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.work_detail_layout);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();
		initAction();

		Intent intent = getIntent();
		if (intent != null) {
			workId = intent.getStringExtra("workId");
		}
	}

	private void initAction() {
		tvApplyExit = (TextView) findViewById(R.id.tv_apply_exit);
		liAgree = (LinearLayout) findViewById(R.id.li_agree);
		tvAgreeExit = (TextView) findViewById(R.id.tv_agree_exit);
		tvAgreeReady = (TextView) findViewById(R.id.tv_agree_ready);
		rlDoing = (RelativeLayout) findViewById(R.id.rl_doing);
		pdStatus = (ProgressBar) findViewById(R.id.pd_day);
		tvApplyWork = (TextView) findViewById(R.id.tv_apply_work);
		tvProgressAllSum=(TextView) findViewById(R.id.tv_progress_SumDay);//任务总天数
		tvProgressLeaveSum=(TextView) findViewById(R.id.tv_progress_leaveDay);//任务剩余天数
		
		tvWorkComment=(TextView) findViewById(R.id.tv_work_comment);//评论项目
		tvWorkComment.setOnClickListener(this);
		
		tvInFile = (TextView) findViewById(R.id.tv_refuse_inFile);

		tvApplyWork.setOnClickListener(this);//申请任务
		tvApplyExit.setOnClickListener(this);//已申请状态下申请退出
		tvAgreeExit.setOnClickListener(this);//已同意状态下申请退出
		tvAgreeReady.setOnClickListener(this);//已同意状态下准备动作
		tvInFile.setOnClickListener(this);//归档动作
		tvWorkComment.setOnClickListener(this);//评论项目
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_detail_title));
	}

	private void initView() {
		dialogflate=LayoutInflater.from(this);
		
		tvComPosition = (TextView) findViewById(R.id.tv_com_position);
		tvMoney = (TextView) findViewById(R.id.tv_money);
		tvNeedPerson = (TextView) findViewById(R.id.tv_need_person);
		tvLeaveDay = (TextView) findViewById(R.id.tv_leave_day);
		tvPubPerson = (TextView) findViewById(R.id.tv_publish_person);
		tvPubPerson.setOnClickListener(this);
		tvPubDate = (TextView) findViewById(R.id.tv_date_show);

		imgComMsg = (ImageView) findViewById(R.id.img_com_msg);
		imgComMsg.setOnClickListener(this);

		imgBgStatus = (ImageView) findViewById(R.id.img_work_status);

		tvSeeAll = (TextView) findViewById(R.id.tv_enable_all);
		tvSeeAll.setOnClickListener(this);
		tvContentInfo = (TextView) findViewById(R.id.tv_ContentInfo);

		lvFile = (MyListView) findViewById(R.id.lv_files);
		
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		pd = SubmitDialog.getProgressDialog(this, "请等待");
		pd.show();
		loadInfo();// 加载信息
	}

	private void loadInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("id", workId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.StuTaskDetail,
				Urls.MethodType.GET, Urls.function.detail, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取任务详情列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<WorkDetailModel>() {
						}.getType();
						WorkDetailModel detailBean = gson.fromJson(response,
								type);
						if (detailBean.getStatus() == 1) {
							UserInfoKeeper.updToken(detailBean.getToken());
							com.dzqc.student.model.Data dataInfo = detailBean
									.getData();
							tvComPosition.setText(dataInfo.getTitle());
							tvMoney.setText(dataInfo.getPay_money()==null?"0元":dataInfo.getPay_money()+"元");
							tvNeedPerson.setText("已报"+dataInfo.getJoin_number()+"人");
							tvLeaveDay.setText(dataInfo.getWork_days()==null?"0天":dataInfo.getWork_days()+"天");
							
							tvPubPerson.setText(dataInfo.getPublisherData()
									.getCompanyname());
						
							tvPubDate.setText(AppTimeUtils.millsToDateFormat(dataInfo.getAddtime()));
							
							//获取公司ID
							comId=dataInfo.getPublisherData().getId();
							
							//对内容部分处理
							String tempContent=dataInfo.getContent();
							content=tempContent;
							if (tempContent.length()>100) {
								tempContent=tempContent.subSequence(0, 100)+"...";
								tvSeeAll.setVisibility(View.VISIBLE);
							}else {
								tvSeeAll.setVisibility(View.GONE);
							}
							// 内容部分
							tvContentInfo.setText(tempContent);
							
							My_join_data myData = dataInfo.getMy_join_data();
							if (myData != null) {
								joinId=myData.getId();//获取任务参与ID
								mytype = myData.getState();
								if (mytype == null) {// 没有我的报名信息则为空
									// 任务申请
									tvApplyWork.setVisibility(View.VISIBLE);
								} else {
									if (mytype.equals("0")) {// 0:等待审核//已提交，申请退出
										tvApplyExit.setVisibility(View.VISIBLE);
										imgBgStatus.setBackgroundResource(R.drawable.bg_apply);
									} else if (mytype.equals("10")) {// 10:已同意（申请退出，或准备）
										liAgree.setVisibility(View.VISIBLE);
										imgBgStatus.setBackgroundResource(R.drawable.bg_unified);
									} else if (mytype.equals("20")) {// 20:已拒绝
										tvInFile.setVisibility(View.VISIBLE);
										imgBgStatus.setBackgroundResource(R.drawable.bg_refuse2);
									}else if (mytype.equals("30")) {//已准备/准备开始
										imgBgStatus.setBackgroundResource(R.drawable.get_ready);
									}
									else if (mytype.equals("40")) {// 40：进行中
										rlDoing.setVisibility(View.VISIBLE);
										imgBgStatus.setBackgroundResource(R.drawable.bg_conduct2);
										String workdays=dataInfo.getWork_days();//任务周期
										String leavedays=String.valueOf(dataInfo.getSurplus_days());//剩余天数
										tvProgressAllSum.setText("共"+workdays+"天");
										tvProgressLeaveSum.setText("剩余"+leavedays+"天");
										pdStatus.setMax(Integer.parseInt(workdays));
										pdStatus.setProgress(Integer.parseInt(workdays)-Integer.parseInt(leavedays));
									} else if (mytype.equals("60")) {// 60：已退出
										imgBgStatus.setBackgroundResource(R.drawable.back_out);//已退出
									} else if (mytype.equals("50")) {// 50：申请退出
										imgBgStatus.setBackgroundResource(R.drawable.task_apply_exit);
									} else if (mytype.equals("70")) {// 已完成
										imgBgStatus.setBackgroundResource(R.drawable.finish);// 已完成
										tvWorkComment.setVisibility(View.VISIBLE);
									}
								}
							}else {
								// 没有我的报名信息则为空
								// 任务申请
								tvApplyWork.setVisibility(View.VISIBLE);
							}

							// 附件部分
							listfile = dataInfo.getFileList().getRows();
							lvFile.setAdapter(new FileAdapter(
									WorkDetailActivity.this, listfile));
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
			AppManager.getAppManager().finishActivity(WorkDetailActivity.this);
			break;
		case R.id.tv_apply_work:// 任务申请
			dialogShow("0",getResources().getString(R.string.work_apply),getResources().getString(R.string.work_apply_content));
			break;
		case R.id.tv_apply_exit:// 已申请状态下，申请退出
			dialogShow("1",getResources().getString(R.string.work_exit),getResources().getString(R.string.work_exit_content));
			break;
		case R.id.tv_agree_exit:// 已同意状态下，申请退出
			dialogShow("2",getResources().getString(R.string.work_exit),getResources().getString(R.string.work_exit_content));
			break;
		case R.id.tv_agree_ready:// 已同意状态下，准备
			dialogShow("3",getResources().getString(R.string.work_ready),getResources().getString(R.string.work_ready_content));
			break;
		case R.id.tv_refuse_inFile:// 归档
			dialogShow("4",getResources().getString(R.string.work_infile),getResources().getString(R.string.work_infile_content));
			break;
		case R.id.tv_publish_person://查看企业详情
			Intent infoIntent=new Intent(this, WorkCompanyInfoActivity.class);
			infoIntent.putExtra("comId", comId);
			startActivity(infoIntent);
			break;
		case R.id.tv_work_comment://评论项目
			Intent intent=new Intent(WorkDetailActivity.this, WorkCommentActivity.class);
			intent.putExtra("workId", workId);
			startActivity(intent);
		break;
		case R.id.tv_enable_all://查看全部
			tvContentInfo.setText(content);
			tvSeeAll.setVisibility(View.GONE);
			break;
		case R.id.img_com_msg:// 即时聊天
			
			break;
		default:
			break;
		}
	}

	public void dialogShow(final String type,String title,String content)
	{
		View view=dialogflate.inflate(R.layout.alert_dialog_layout,null);
		final AlertDialog alertDialog = new AlertDialog.Builder(this).create();  
		alertDialog.show();  
		Window window = alertDialog.getWindow();  
		window.setContentView(view);
		TextView tv_title = (TextView) window.findViewById(R.id.tv_MessageTitle);  
		TextView tv_message = (TextView) window.findViewById(R.id.tv_MessageContent);  
		TextView tvCancer=(TextView) window.findViewById(R.id.tvCancer);
		TextView tvConfirm=(TextView) window.findViewById(R.id.tvConfirm);
		tv_message.setText(content);
		tv_title.setText(title);  
	    tvCancer.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				alertDialog.dismiss();
			}
		});
	    tvConfirm.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				alertDialog.dismiss();
				if (type.equals("0")) {
					applyJoin();
				}else if (type.equals("1")) {
					applyOut();
				}else if (type.equals("2")) {
					applyOut();
				}else if (type.equals("3")) {
					waitStarkWork();
				}else if (type.equals("4")) {
					packWorkJoin();
				}
				
			}
		});
	}
	
	/**
	 * 归档任务
	 */
	private void packWorkJoin() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("joinid", joinId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.packTaskJoin,
				Urls.MethodType.GET, Urls.function.packTaskJoin, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i(" 归档任务返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel resultBean = gson.fromJson(response,
								type);
						if (resultBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(resultBean.getToken());
							ToastUtils.showToast(resultBean.getInfo());
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

	/**
	 * 准备 申请开始任务
	 */
	private void waitStarkWork() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("joinid", joinId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.waitStartTask,
				Urls.MethodType.GET, Urls.function.waitStartTask, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i(" 申请开始任务返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel resultBean = gson.fromJson(response,
								type);
						if (resultBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(resultBean.getToken());
							ToastUtils.showToast(resultBean.getInfo());
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

	/**
	 * 申请参与任务
	 */
	private void applyJoin() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("taskid", workId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.applayJoin,
				Urls.MethodType.GET, Urls.function.applayJoin, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("申请参与任务返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel resultBean = gson.fromJson(response,
								type);
						if (resultBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(resultBean.getToken());
							ToastUtils.showToast(resultBean.getInfo());
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

	/**
	 * 申请退出
	 */
	private void applyOut() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("joinid", joinId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.applayExitJoin,
				Urls.MethodType.GET, Urls.function.applayExitJoin, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("申请退出返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel resultBean = gson.fromJson(response,
								type);
						if (resultBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(resultBean.getToken());
							ToastUtils.showToast(resultBean.getInfo());
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
}
