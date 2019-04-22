package com.dzqc.student.ui.mine;

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
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;

import com.dzqc.student.R;
import com.dzqc.student.adapter.WorkListAdapter;
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
import com.dzqc.student.ui.work.WorkDetailActivity;
import com.dzqc.student.utils.AppManager;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnLoadMoreListener;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnRefreshListener;

public class MyWorkStateList extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;
	
	private PullRefreshLoadMore workListView;

	private WorkListAdapter workListAdapter;
	private int pageIndex=1;
	private List<rowInfo> listMode;// 任务列表
	
	private LinearLayout liEmpty;
	private String state;//我的任务状态10报名中,20进行中,30已结束
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.my_workstate_layout);
		AppManager.getAppManager().addActivity(this);
		Intent intent=getIntent();
		if (intent!=null) {
			state=intent.getStringExtra("state");
		}
		initHeader();
		initView();
	}
	
	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		if (state.equals("10")) {
			tvHeader.setText(getResources().getString(R.string.mine_worked));
		}else if (state.equals("20")) {
			tvHeader.setText(getResources().getString(R.string.mine_working));
		}else if (state.equals("30")) {
			tvHeader.setText(getResources().getString(R.string.mine_work_over));
		}
	}
	
	private void initView() {
		// TODO Auto-generated method stub
		listMode=new ArrayList<WorkListResult.workList.rowInfo>();
		
		liEmpty=(LinearLayout)findViewById(R.id.li_Empty);
		
		workListView = (PullRefreshLoadMore)findViewById(R.id.myWorkListView);
		workListView.setEmptyView(liEmpty);
		workListAdapter = new WorkListAdapter(
				MyWorkStateList.this, listMode);
		workListView.setAdapter(workListAdapter);
		workListView.setCanLoadMore(true);
		workListView.setCanRefresh(true);
		workListView.setAutoLoadMore(true);
		workListView.setMoveToFirstItemAfterRefresh(true);
		workListView.setDoRefreshOnUIChanged(true);

		workListView.setOnRefreshListener(new OnRefreshListener() {

			@Override
			public void onRefresh() {
				// TODO Auto-generated method stub
				loadInfo(1, 0);
			}
		});
		workListView.setOnLoadListener(new OnLoadMoreListener() {

			@Override
			public void onLoadMore() {
				// TODO Auto-generated method stub
				pageIndex++;
				loadInfo(pageIndex, 1);
			}
		});
		workListView.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View v,
					int position, long index) {
				// TODO Auto-generated method stub
				TextView tvid=(TextView) v.findViewById(R.id.tv_work_id);
				String id=tvid.getText().toString();
				Intent intent = new Intent(MyWorkStateList.this, WorkDetailActivity.class);
				intent.putExtra("workId", id);
				if (DzqcStu.isDebug) {
					Log.i("item值为+++++", id+"<><><>");
				}
				startActivity(intent);
			}
		});
		loadInfo(1, 0);
	}

	private void loadInfo(int index, final int typeload) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("nowPage", index + "");
		map.put("state", state);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.myList,
				Urls.MethodType.GET, Urls.function.myList, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取我的任务列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<WorkListResult>() {
						}.getType();
						WorkListResult workBean = gson.fromJson(response, type);
						if (workBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(workBean.getToken());
							workList works = workBean.getList();
							List<rowInfo> listModeTemp = works.getRows();
							if (typeload==0) {
								if (workListAdapter != null) {
									workListAdapter.mList = listModeTemp;
									workListAdapter.notifyDataSetChanged();
								}
								workListView.onRefreshComplete(); // 下拉刷新完成
							} else if (typeload==1) {
								if (workListAdapter != null) {
									for (rowInfo o : listModeTemp) {
										workListAdapter.mList.add(o);
									}									
									workListAdapter.notifyDataSetChanged();
								}
								workListView.onLoadMoreComplete(); // 加载更多完成
							}

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
			AppManager.getAppManager().finishActivity(MyWorkStateList.this);
			break;
		default:
			break;
		}
	}

}
