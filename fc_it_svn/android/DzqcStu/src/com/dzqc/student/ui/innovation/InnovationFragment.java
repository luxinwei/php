package com.dzqc.student.ui.innovation;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.dzqc.student.R;
import com.dzqc.student.adapter.InnovationListAdapter;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.InnovationListMode;
import com.dzqc.student.model.InnovationListMode.DataList;
import com.dzqc.student.model.InnovationListMode.DataList.Rows;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnLoadMoreListener;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnRefreshListener;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;

public class InnovationFragment extends Fragment implements OnClickListener {
	TextView titleTextView;
	RelativeLayout rLayout;
	ImageView imgRight;
	
	private PullRefreshLoadMore innovationListView;

	private InnovationListAdapter innovationListAdapter;
	private int pageIndex = 1;
	private List<Rows> listMode;// 双创列表
	
	private LinearLayout liEmpty;
	@Override
	public View onCreateView(LayoutInflater inflater,
			@Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		View view = inflater.inflate(R.layout.fragment_innovation, null);
		initNav(view);
		initView(view);
		return view;
	}

	@SuppressLint("NewApi") private void initNav(View view) {
		// TODO Auto-generated method stub
		((TextView) view.findViewById(R.id.leftText))
				.setVisibility(View.INVISIBLE);
		titleTextView = (TextView) view.findViewById(R.id.titleText);
		titleTextView.setText(R.string.bottommenu_create);
		rLayout=(RelativeLayout) view.findViewById(R.id.rlImage);
		rLayout.setVisibility(View.VISIBLE);
		
		imgRight=(ImageView) view.findViewById(R.id.imgRight);
		imgRight.setBackground(getResources().getDrawable(R.drawable.add2));
		imgRight.setOnClickListener(this);
		imgRight.setVisibility(View.GONE);
	}

	private void initView(View view) {
		// TODO Auto-generated method stub
		listMode = new ArrayList<Rows>();
		liEmpty=(LinearLayout)view.findViewById(R.id.li_Empty);
		
		innovationListView = (PullRefreshLoadMore) view
				.findViewById(R.id.innovationListView);
		innovationListAdapter = new InnovationListAdapter(getActivity(), listMode);
		innovationListView.setAdapter(innovationListAdapter);
		innovationListView.setCanLoadMore(true);
		innovationListView.setCanRefresh(true);
		innovationListView.setAutoLoadMore(true);
		innovationListView.setMoveToFirstItemAfterRefresh(true);
		innovationListView.setDoRefreshOnUIChanged(true);
		innovationListView.setEmptyView(liEmpty);
		innovationListView.setOnRefreshListener(new OnRefreshListener() {

			@Override
			public void onRefresh() {
				// TODO Auto-generated method stub
				loadInfo(1, 0);
			}
		});
		innovationListView.setOnLoadListener(new OnLoadMoreListener() {

			@Override
			public void onLoadMore() {
				// TODO Auto-generated method stub
				pageIndex++;
				loadInfo(pageIndex, 1);
			}
		});
		innovationListView.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View v,
					int position, long index) {
				// TODO Auto-generated method stub
				TextView tvid=(TextView) v.findViewById(R.id.tv_innovation_id);
				String id=tvid.getText().toString();
				Intent intent = new Intent(getActivity(), InnovationDetailActivity.class);
				intent.putExtra("innovationId", id);
				if (DzqcStu.isDebug) {
					Log.i("item值为+++++", id+"<><><>");
				}
				startActivity(intent);
			}
		});
		loadInfo(1, 0);//首次加载;
	}
	private void loadInfo(int index, final int typeload) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("nowPage", index + "");
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getIdeasList,
				Urls.MethodType.GET, Urls.function.getIdeasList, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取双创列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<InnovationListMode>() {
						}.getType();
						InnovationListMode innovationBean = gson.fromJson(response, type);
						if (innovationBean.getStatus()==1) {
							UserInfoKeeper.updToken(innovationBean.getToken());
							DataList works = innovationBean.getList();
							List<Rows> listModeTemp = works.getRows();
							if (typeload == 0) {
								if (innovationListAdapter != null) {
									innovationListAdapter.mList = listModeTemp;
									innovationListAdapter.notifyDataSetChanged();
								}
								innovationListView.onRefreshComplete(); // 下拉刷新完成
							} else if (typeload == 1) {
								if (innovationListAdapter != null) {
									for (Rows o : listModeTemp) {
										innovationListAdapter.mList.add(o);
									}
									innovationListAdapter.notifyDataSetChanged();
								}
								innovationListView.onLoadMoreComplete(); // 加载更多完成
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
	public void onClick(View view) {
		// TODO Auto-generated method stub
		switch (view.getId()) {
		case R.id.imgRight://发布双创
			Intent intent=new Intent(getActivity(), InnovationPublishActivity.class);
			startActivity(intent);
			break;

		default:
			break;
		}
	}
}
