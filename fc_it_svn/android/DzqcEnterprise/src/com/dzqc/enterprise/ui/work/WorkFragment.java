package com.dzqc.enterprise.ui.work;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.adapter.WorkListAdapter;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.model.WorkListMode;
import com.dzqc.enterprise.model.WorkListResult;
import com.dzqc.enterprise.model.WorkListResult.workList;
import com.dzqc.enterprise.model.WorkListResult.workList.rowInfo;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnLoadMoreListener;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnRefreshListener;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;

public class WorkFragment extends Fragment implements OnClickListener {
	TextView titleTextView,tvLeft,tvRight;
    private PullRefreshLoadMore mListView;
	
	private List<WorkListMode> listWork;//任务列表
	private WorkListAdapter workListAdapter;
	private View emptyView;
	
	private int pageIndex=1;
	private int pageSize=10;
	private List<rowInfo> listMode;// 任务列表
	
	@Override
	public View onCreateView(LayoutInflater inflater,
			@Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		View view = inflater.inflate(R.layout.fragment_serve, null);
		initNav(view);
		initView(view);
		return view;
	}

	private void initNav(View view) {
		// TODO Auto-generated method stub
		tvLeft= (TextView) view.findViewById(R.id.leftText);
		tvLeft.setVisibility(View.VISIBLE);
		tvLeft.setText("");
		tvLeft.setBackgroundResource(R.drawable.screening);
		
		titleTextView = (TextView) view.findViewById(R.id.titleText);
		titleTextView.setText(R.string.bottommenu_serve);
		
		tvRight=(TextView) view.findViewById(R.id.rightText);
		tvRight.setVisibility(View.VISIBLE);
		tvRight.setBackgroundResource(R.drawable.add2);
		tvRight.setOnClickListener(this);
	}

	private void initView(View view)
	{
		listWork=new ArrayList<WorkListMode>();
		mListView=(PullRefreshLoadMore) view.findViewById(R.id.workListView);
		
		mListView.setCanLoadMore(true);
		mListView.setCanRefresh(true);
		mListView.setAutoLoadMore(true);
		mListView.setMoveToFirstItemAfterRefresh(true);
		mListView.setDoRefreshOnUIChanged(true);
		
		mListView.setOnRefreshListener(new onRefreshListenerImp());
		mListView.setOnLoadListener(new onLoadMoreListenerImp());
		mListView.setOnItemClickListener(new onItemClickListenerImp());
		
		emptyView=view.findViewById(R.id.emptyView);
		mListView.setEmptyView(emptyView);
		
		loadInfo(1,-1);
	}
	
	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.rightText:
			startActivity(new Intent(getActivity(), WorkPublishActivity.class));
			break;

		default:
			break;
		}
	}
	
	private class onItemClickListenerImp implements OnItemClickListener{

		@Override
		public void onItemClick(AdapterView<?> parent, View v, int position,
				long index) {
			// TODO Auto-generated method stub
			rowInfo infoMode=listMode.get((int) index);
			String id=infoMode.getId();//任务Id
			String status=infoMode.getState();//任务状态
			Intent intent = new Intent(getActivity(), WorkDetailActivity.class);
			intent.putExtra("workId", id);
			//intent.putExtra("workStatus", status);
			if (DzqcEnterprise.isDebug) {
				Log.i("item值为+++++", id+"<><><>"+status);
			}
			startActivity(intent);
		}
		
	}
	
	private void loadInfo(int index, final int typeload) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("onePage", pageSize+"");
		map.put("nowPage", index + "");
		HttpRequest.HttpPost(Urls.ROOTURL, Method.myPublishList,
				Urls.MethodType.GET, Urls.function.myPublishList, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcEnterprise.isDebug) {
							Log.i("获取企业发布信息列表结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<WorkListResult>() {
						}.getType();
						WorkListResult workBean = gson.fromJson(response, type);
						if (workBean.getStatus().equals("1")) {
							List<rowInfo> listTemp=new ArrayList<WorkListResult.workList.rowInfo>();
							UserInfoKeeper.updToken(workBean.getToken());
							workList works = workBean.getList();
							listTemp = works.getRows();
							if (typeload==-1) {
								listMode=listTemp;
								workListAdapter = new WorkListAdapter(
										getActivity(), listMode);
								mListView.setAdapter(workListAdapter);
							}
							if (typeload==0) {
								listMode=listTemp;
								if (workListAdapter != null) {
									workListAdapter.mList = listMode;
									workListAdapter.notifyDataSetChanged();
								}
								mListView.onRefreshComplete(); // 下拉刷新完成
							} else if (typeload==1) {
								listMode=listTemp;
								if (workListAdapter != null) {
									workListAdapter.mList
											.addAll(listMode);
									workListAdapter.notifyDataSetChanged();
								}
								mListView.onLoadMoreComplete(); // 加载更多完成
							}

						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}

	
	
	//onRefresh实现类
	private class onRefreshListenerImp implements OnRefreshListener{

		@Override
		public void onRefresh() {
			// TODO Auto-generated method stub
			loadInfo(1, 0);
		}
		
	}
	
	//onLoadMore实现类
	private class onLoadMoreListenerImp implements OnLoadMoreListener{

		@Override
		public void onLoadMore() {
			// TODO Auto-generated method stub
			pageIndex++;
			loadInfo(pageIndex, 1);
			if (DzqcEnterprise.isDebug) {
				Log.i("pageIndex------", pageIndex+"");
			}
		}
		
	}
	
}
