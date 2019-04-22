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
import com.dzqc.student.adapter.MyInnovationListAdapter;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.MyInnovationListMode;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.ui.innovation.InnovationDetailActivity;
import com.dzqc.student.utils.AppManager;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnLoadMoreListener;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnRefreshListener;

public class MyInnovationList extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;
	
	private PullRefreshLoadMore innovationListView;

	private MyInnovationListAdapter innovationListAdapter;
	private int pageIndex = 1;
	private List<com.dzqc.student.model.MyInnovationListMode.DataList.Rows> listMode;// 双创列表
	

	private LinearLayout liEmpty;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.my_innovation_list);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();
	}
	
	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.mine_innovation));
	}
	
	private void initView() {
		// TODO Auto-generated method stub
		liEmpty=(LinearLayout)findViewById(R.id.li_Empty);
		
		innovationListView = (PullRefreshLoadMore)findViewById(R.id.innovationListView);
		innovationListAdapter = new MyInnovationListAdapter(MyInnovationList.this, listMode);
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
				Intent intent = new Intent(MyInnovationList.this, InnovationDetailActivity.class);
				intent.putExtra("innovationId", id);
				if (DzqcStu.isDebug) {
					Log.i("item值为+++++", id+"<><><>");
				}
				startActivity(intent);
			}
		});

		listMode = new ArrayList<com.dzqc.student.model.MyInnovationListMode.DataList.Rows>();
		loadInfo(1, 0);
	}
	private void loadInfo(int index, final int typeload) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("nowPage", index + "");
		HttpRequest.HttpPost(Urls.ROOTURL, Method.myPublishIdeasList,
				Urls.MethodType.GET, Urls.function.myPublishIdeasList, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取我的双创列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<MyInnovationListMode>() {
						}.getType();
						MyInnovationListMode innovationBean = gson.fromJson(response, type);
						if (innovationBean.getStatus()==1) {
							UserInfoKeeper.updToken(innovationBean.getToken());
							com.dzqc.student.model.MyInnovationListMode.DataList works = innovationBean.getList();
							List<com.dzqc.student.model.MyInnovationListMode.DataList.Rows> listModeTemp = works.getRows();
							if (typeload == 0) {
								if (innovationListAdapter != null) {
									innovationListAdapter.mList = listModeTemp;
									innovationListAdapter.notifyDataSetChanged();
								}
								innovationListView.onRefreshComplete(); // 下拉刷新完成
							} else if (typeload == 1) {
								if (innovationListAdapter != null) {
									for (com.dzqc.student.model.MyInnovationListMode.DataList.Rows o : listModeTemp) {
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
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.img_registerBack:
			AppManager.getAppManager().finishActivity(MyInnovationList.this);
			break;
		default:
			break;
		}
	}

}
