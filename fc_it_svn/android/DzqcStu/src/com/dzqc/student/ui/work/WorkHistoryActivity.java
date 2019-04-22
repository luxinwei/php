package com.dzqc.student.ui.work;

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
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.adapter.WorkHistoryAdapter;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.WorkListResult;
import com.dzqc.student.model.WorkListResult.workList;
import com.dzqc.student.model.WorkListResult.workList.rowInfo;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnLoadMoreListener;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnRefreshListener;

public class WorkHistoryActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private String comId;
	private String workName;
	
	private int pageIndex=1;
	private com.ygs.pullrefreshloadmore.PullRefreshLoadMore mlistView;
	private WorkHistoryAdapter workHistoryAdapter;
	private List<rowInfo> listMode=new ArrayList<WorkListResult.workList.rowInfo>();// 任务列表
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.work_history_layout);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();

		Intent intent = getIntent();
		if (intent!=null) {
			comId=intent.getStringExtra("comId");
		}
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_history));
	}

	private void initView() {
		workHistoryAdapter = new WorkHistoryAdapter(this, listMode);
		mlistView=(PullRefreshLoadMore) findViewById(R.id.mHistoryList);
		mlistView.setAdapter(workHistoryAdapter);
		
		mlistView.setOnRefreshListener(new OnRefreshListener() {
			
			@Override
			public void onRefresh() {
				// TODO Auto-generated method stub
				loadInfo(1,0);
			}
		});
		mlistView.setOnLoadListener(new OnLoadMoreListener() {
			
			@Override
			public void onLoadMore() {
				// TODO Auto-generated method stub
				pageIndex++;
				loadInfo(pageIndex,1);
			}
		});
		mlistView.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View v, int position,
					long index) {
				// TODO Auto-generated method stub
				TextView tvcode=(TextView) v.findViewById(R.id.tv_work_id);
				TextView tvName=(TextView)v.findViewById(R.id.tv_work_name);
				Intent intent=new Intent(WorkHistoryActivity.this, ComCommentListActivity.class);
				intent.putExtra("workId", tvcode.getText());
				intent.putExtra("comName", tvName.getText());
				intent.putExtra("comPosition", workName);
				startActivity(intent);
			}
		});
		
		mlistView.setCanLoadMore(true);
		mlistView.setCanRefresh(true);
		mlistView.setAutoLoadMore(true);
		mlistView.setMoveToFirstItemAfterRefresh(true);
		mlistView.setDoRefreshOnUIChanged(true);
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		 //loadInfo();
	}

	
	/**
	 * 加载信息
	 */
	private void loadInfo(int index, final int typeload) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("id", comId);
		map.put("nowPage", index + "");
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getPublishListByCompany,
				Urls.MethodType.GET, Urls.function.getPublishListByCompany, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("历史项目结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<WorkListResult>() {
						}.getType();
						WorkListResult listBean = gson.fromJson(response,
								type);
						if (listBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(listBean.getToken());
							workList works = listBean.getList();
							List<rowInfo> listModeTemp = works.getRows();
							if (typeload==0) {
								if (workHistoryAdapter != null) {
									workHistoryAdapter.mList = listModeTemp;
									workHistoryAdapter.notifyDataSetChanged();
								}
								mlistView.onRefreshComplete(); // 下拉刷新完成
							} else if (typeload==1) {
								if (workHistoryAdapter != null) {
									for (rowInfo o : listModeTemp) {
										workHistoryAdapter.mList
										.add(o);
									}
									workHistoryAdapter.notifyDataSetChanged();
								}
								mlistView.onLoadMoreComplete(); // 加载更多完成
							}
						}else {
							ToastUtils.showToast(listBean.getInfo());
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
			AppManager.getAppManager().finishActivity(WorkHistoryActivity.this);
			break;
		default:
			break;
		}
	}
}
