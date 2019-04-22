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
import com.dzqc.student.adapter.MyPostionListAdapter;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.MyPositionListMode;
import com.dzqc.student.model.MyPositionListMode.PositionList;
import com.dzqc.student.model.MyPositionListMode.PositionList.Rows;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexDetailActivity;
import com.dzqc.student.ui.work.WorkDetailActivity;
import com.dzqc.student.utils.AppManager;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnLoadMoreListener;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnRefreshListener;

public class MyJobList extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;
	
	private PullRefreshLoadMore indexListView;

	private MyPostionListAdapter myPostionListAdapter;
	private int pageIndex = 1;
	private List<Rows> listMode;// 任务列表
	
	private LinearLayout liEmpty;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.my_job_history);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();
	}
	
	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.mine_submit_position));
	}
	
	private void initView() {
		// TODO Auto-generated method stub
		liEmpty=(LinearLayout)findViewById(R.id.li_Empty);
		
		indexListView = (PullRefreshLoadMore)findViewById(R.id.myListView);
		indexListView.setEmptyView(liEmpty);
		myPostionListAdapter = new MyPostionListAdapter(MyJobList.this, listMode);
		indexListView.setAdapter(myPostionListAdapter);
		indexListView.setCanLoadMore(true);
		indexListView.setCanRefresh(true);
		indexListView.setAutoLoadMore(true);
		indexListView.setMoveToFirstItemAfterRefresh(true);
		indexListView.setDoRefreshOnUIChanged(true);

		indexListView.setOnRefreshListener(new OnRefreshListener() {

			@Override
			public void onRefresh() {
				// TODO Auto-generated method stub
				loadInfo(1, 0);
			}
		});
		indexListView.setOnLoadListener(new OnLoadMoreListener() {

			@Override
			public void onLoadMore() {
				// TODO Auto-generated method stub
				pageIndex++;
				loadInfo(pageIndex, 1);
			}
		});
		indexListView.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View v,
					int position, long index) {
				// TODO Auto-generated method stub
				TextView tvid=(TextView) v.findViewById(R.id.tv_work_id);
				String id=tvid.getText().toString();
				Rows rows=myPostionListAdapter.mList.get((int) index);
				String status=rows.getRstate();
				Intent intent = null;
				if (status!=null) {
					if (status.equals("10")) {
						intent = new Intent(MyJobList.this,WorkDetailActivity.class);
						intent.putExtra("workId", id);
					}else {
						intent = new Intent(MyJobList.this, IndexDetailActivity.class);
						intent.putExtra("indexId", id);
						intent.putExtra("flag", "detail");
					}
					startActivity(intent);
				}
				if (DzqcStu.isDebug) {
					Log.i("item值为+++++", id+"<><><>");
				}
			}
		});

		listMode = new ArrayList<Rows>();
		loadInfo(1, 0);
	}
	private void loadInfo(int index, final int typeload) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("nowPage", index + "");
		HttpRequest.HttpPost(Urls.ROOTURL, Method.findDelivery,
				Urls.MethodType.GET, Urls.function.findDelivery, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取自己投递职位列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<MyPositionListMode>() {
						}.getType();
						MyPositionListMode myPostionBean = gson.fromJson(response, type);
						if (myPostionBean.getStatus()==1) {
							UserInfoKeeper.updToken(myPostionBean.getToken());
							PositionList positionList=myPostionBean.getList();
							List<Rows> listModeTemp = positionList.getRows();
							if (typeload == 0) {
								if (myPostionListAdapter != null) {
									myPostionListAdapter.mList = listModeTemp;
									myPostionListAdapter.notifyDataSetChanged();
								}
								indexListView.onRefreshComplete(); // 下拉刷新完成
							} else if (typeload == 1) {
								if (myPostionListAdapter != null) {
									for (Rows o : listModeTemp) {
										myPostionListAdapter.mList.add(o);
									}									
									myPostionListAdapter.notifyDataSetChanged();
								}
								indexListView.onLoadMoreComplete(); // 加载更多完成
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
			AppManager.getAppManager().finishActivity(MyJobList.this);
			break;
		default:
			break;
		}
	}

}
