package com.dzqc.student.ui.work;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

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
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnLoadMoreListener;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnRefreshListener;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.LinearLayout;
import android.widget.TextView;

public class WorkFragment extends Fragment implements View.OnClickListener {

	private TextView titleText;

	private PullRefreshLoadMore mListView;

	private WorkListAdapter workListAdapter;
	private int pageIndex=1;
	private List<rowInfo> listMode;// 任务列表

	private LinearLayout liEmpty;
	
	@Override
	public View onCreateView(LayoutInflater inflater,
			@Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_work, null);
		initNav(view);

		initView(view);
		return view;
	}

	private void initNav(View view) {
		((TextView) view.findViewById(R.id.leftText))
				.setVisibility(View.INVISIBLE);
		titleText = (TextView) view.findViewById(R.id.titleText);
		titleText.setText(R.string.bottommenu_work);
	}

	private void initView(View view) {
		mListView = (PullRefreshLoadMore) view.findViewById(R.id.workListView);
		liEmpty=(LinearLayout)view.findViewById(R.id.li_Empty);
		mListView.setEmptyView(liEmpty);
		workListAdapter = new WorkListAdapter(
				getActivity(), listMode);
		mListView.setAdapter(workListAdapter);
		mListView.setCanLoadMore(true);
		mListView.setCanRefresh(true);
		mListView.setAutoLoadMore(true);
		mListView.setMoveToFirstItemAfterRefresh(true);
		mListView.setDoRefreshOnUIChanged(true);
		mListView.setOnRefreshListener(new onRefreshListenerImp());
		mListView.setOnLoadListener(new onLoadMoreListenerImp());
		mListView.setOnItemClickListener(new onItemClickListenerImp());
		
		listMode=new ArrayList<WorkListResult.workList.rowInfo>();
		
		loadInfo(1, 0);
	}

	private void loadInfo(int index, final int typeload) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("nowPage", index + "");
		map.put("state", "");
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
								mListView.onRefreshComplete(); // 下拉刷新完成
							} else if (typeload==1) {
								if (workListAdapter != null) {
									for (rowInfo o : listModeTemp) {
										workListAdapter.mList.add(o);
									}
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

	private class onItemClickListenerImp implements OnItemClickListener {

		@Override
		public void onItemClick(AdapterView<?> parent, View v, int position,
				long index) {
			// TODO Auto-generated method stub
			TextView tvid=(TextView) v.findViewById(R.id.tv_work_id);
			String id=tvid.getText().toString();
			//rowInfo infoMode=listMode.get((int) index);
			//String id=infoMode.getId();//任务Id
			//String status=infoMode.getState();//任务状态
			Intent intent = new Intent(getActivity(), WorkDetailActivity.class);
			intent.putExtra("workId", id);
			//intent.putExtra("workStatus", status);
			if (DzqcStu.isDebug) {
				Log.i("item值为+++++", id+"<><><>");
			}
			startActivity(intent);
		}

	}

	// onRefresh实现类
	private class onRefreshListenerImp implements OnRefreshListener {

		@Override
		public void onRefresh() {
			// TODO Auto-generated method stub
			loadInfo(1, 0);
		}

	}

	// onLoadMore实现类
	private class onLoadMoreListenerImp implements OnLoadMoreListener {

		@Override
		public void onLoadMore() {
			// TODO Auto-generated method stub
			pageIndex++;
			loadInfo(pageIndex, 1);
			if (DzqcStu.isDebug) {
				Log.i("pageIndex------", pageIndex+"");
			}
		}

	}

	@Override
	public void onClick(View v) {

	}
}
