package com.dzqc.student.ui.index;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.adapter.IndexListAdapter;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.IndexListMode;
import com.dzqc.student.model.IndexListMode.DataList;
import com.dzqc.student.model.IndexListMode.DataList.Rows;
import com.dzqc.student.ui.UserLogin;
import com.dzqc.student.ui.work.WorkDetailActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnLoadMoreListener;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnRefreshListener;

public class IndexFragment extends Fragment implements View.OnClickListener {

	TextView titleText;
	TextView tvRight;
	ImageView imgRight;
	RelativeLayout rlImage;
	View viewPoint;
	
	private TextView tvAll, tvTask, tvPartJob, tvPullJob;
	private PullRefreshLoadMore indexListView;

	private IndexListAdapter indexListAdapter;
	private int pageIndex = 1;
	private List<Rows> listMode;// 任务列表

	private List<TextView> tvList;//存放头标签TextView
	
	private String flagCheck="0";
	private LinearLayout liEmpty;
	
	private LayoutInflater dialogInflater;//检查版本的布局
	
	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_index, null);
		dialogInflater=LayoutInflater.from(getActivity());
		initNav(view);
		initView(view);
		
		return view;
	}

	@SuppressLint("NewApi") private void initNav(View view) {
		((TextView) view.findViewById(R.id.leftText))
				.setVisibility(View.INVISIBLE);
		titleText = (TextView) view.findViewById(R.id.titleText);
		titleText.setText(R.string.bottommenu_index);
		
		rlImage=(RelativeLayout) view.findViewById(R.id.rlImage);
		rlImage.setVisibility(View.VISIBLE);
		imgRight=(ImageView) view.findViewById(R.id.imgRight);
		imgRight.setBackground(getResources().getDrawable(R.drawable.home_massage));
		//imgRight.setOnClickListener(this);
		viewPoint=view.findViewById(R.id.RedPoint);
		viewPoint.setVisibility(View.VISIBLE);
		viewPoint.setBackground(getResources().getDrawable(R.drawable.red_point));
	}

	private void initView(View view) {
		// TODO Auto-generated method stub
		tvList=new ArrayList<TextView>();
		listMode = new ArrayList<Rows>();
		tvAll = (TextView) view.findViewById(R.id.tvIndex_All);
		tvTask = (TextView) view.findViewById(R.id.tvIndex_Task);
		tvPartJob = (TextView) view.findViewById(R.id.tvIndex_part_job);
		tvPullJob = (TextView) view.findViewById(R.id.tvIndex_full_job);

		tvList.add(tvAll);
		tvList.add(tvTask);
		tvList.add(tvPartJob);
		tvList.add(tvPullJob);
		tvAll.setOnClickListener(this);
		tvTask.setOnClickListener(this);
		tvPartJob.setOnClickListener(this);
		tvPullJob.setOnClickListener(this);
		
		liEmpty=(LinearLayout)view.findViewById(R.id.li_Empty);
		indexListView = (PullRefreshLoadMore) view
				.findViewById(R.id.indexListView);
		indexListView.setEmptyView(liEmpty);
		
		indexListAdapter = new IndexListAdapter(getActivity(), listMode);
		indexListView.setAdapter(indexListAdapter);
		
		indexListView.setCanRefresh(true);
		indexListView.setCanLoadMore(true);
		indexListView.setAutoLoadMore(true);
		indexListView.setMoveToFirstItemAfterRefresh(true);
		indexListView.setDoRefreshOnUIChanged(true);
		//indexListView.setDoLoadOnUIChanged();

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
				Rows rows=indexListAdapter.mList.get((int) index);
				String status=rows.getState();
				Intent intent;
				if (status!=null) {
					if (status.equals("10")) {
						intent = new Intent(getActivity(),WorkDetailActivity.class);
						intent.putExtra("workId", id);
					}else {
						intent = new Intent(getActivity(), IndexDetailActivity.class);
						intent.putExtra("indexId", id);
					}
					startActivity(intent);
				}
				if (DzqcStu.isDebug) {
					Log.i("item值为+++++", id+"<><><>"+status);
				}
			}
		});
		loadInfo(1, 0);//首次加载
	}

	private void loadInfo(int index, final int typeload) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("state",flagCheck);
		map.put("nowPage",index+"");
		HttpRequest.HttpPost(Urls.ROOTURL, Method.positionList,
				Urls.MethodType.GET, Urls.function.positionList, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取推荐列表返回结果----------》》", response);
						}
						if (response.equals(getResources().getString(R.string.no_login))) {
							startActivity(new Intent(getActivity(), UserLogin.class));
							AppManager.getAppManager().finishActivity(getActivity());
							return;
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<IndexListMode>() {
						}.getType();
						IndexListMode workBean = gson.fromJson(response, type);
						if (workBean.getStatus()==1) {
							UserInfoKeeper.updToken(workBean.getToken());
							DataList works = workBean.getList();
							List<Rows> listModeTemp = works.getRows();
							if (typeload == 0) {
								if (indexListAdapter != null) {
									indexListAdapter.mList = listModeTemp;
									indexListAdapter.notifyDataSetChanged();
								}
								indexListView.onRefreshComplete(); // 下拉刷新完成
							} else if (typeload == 1) {
								if (indexListAdapter != null) {
									for (Rows o : listModeTemp) {
										indexListAdapter.mList.add(o);
									}									
									indexListAdapter.notifyDataSetChanged();
								}
								indexListView.onLoadMoreComplete(); // 加载更多完成
							}

						}else {
							ToastUtils.showToast(workBean.getInfo());
							indexListView.onRefreshComplete();
						} 
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}

	@Override
	public void onPause() {
		super.onPause();
	}

	@Override
	public void onResume() {
		super.onResume();
	}

	@SuppressLint("NewApi") @Override
	public void onClick(View v) {
		setTextViewBg();
		switch (v.getId()) {
		case R.id.tvIndex_All://查看全部
			flagCheck="0";
			tvAll.setBackground(getResources().getDrawable(R.drawable.tv_bord_radius_left));
			tvAll.setTextColor(getResources().getColor(R.color.GRB6));
			loadInfo(1, 0);
			break;
		case R.id.tvIndex_Task://查看任务列表
			flagCheck="1";
			tvTask.setBackground(getResources().getDrawable(R.drawable.tv_bord_check));
			tvTask.setTextColor(getResources().getColor(R.color.GRB6));
			loadInfo(1, 0);
			break;
		case R.id.tvIndex_part_job://查看兼职列表
			flagCheck="2";
			tvPartJob.setBackground(getResources().getDrawable(R.drawable.tv_bord_check));
			tvPartJob.setTextColor(getResources().getColor(R.color.GRB6));
			loadInfo(1, 0);
			break;
		case R.id.tvIndex_full_job://查看全职列表
			flagCheck="3";
			tvPullJob.setBackground(getResources().getDrawable(R.drawable.tv_bord_radius_right_check));
			tvPullJob.setTextColor(getResources().getColor(R.color.GRB6));
			loadInfo(1, 0);
			break;
		case R.id.imgRight://查看消息列表
			/*Intent intent=new Intent(getActivity(), IndexDetailActivity.class);
			startActivity(intent);*/
			break;
		default:
			break;
		}
	}
	//清除背景样式
	@SuppressLint("NewApi") private void setTextViewBg()
	{
		for (TextView tv : tvList) {
			if (tv==tvAll) {
				tv.setBackground(getResources().getDrawable(R.drawable.tv_bord_radius_left_uncheck));
			}else if (tv==tvPullJob) {
				tv.setBackground(getResources().getDrawable(R.drawable.tv_bord_radius_right));
			}else {
				tv.setBackground(getResources().getDrawable(R.drawable.tv_bord_uncheck));
			}
			tv.setTextColor(getResources().getColor(R.color.GRB2));
		}
	}
	
	public void dialogShow(String title,String content)
	{
		View view=dialogInflater.inflate(R.layout.alert_dialog_layout,null);
		final AlertDialog alertDialog = new AlertDialog.Builder(getActivity()).create();  
		alertDialog.show();
		Window window = alertDialog.getWindow();  
		window.setContentView(view);
		TextView tv_title = (TextView) window.findViewById(R.id.tv_MessageTitle);  
		TextView tv_message = (TextView) window.findViewById(R.id.tv_MessageContent);  
		TextView tvCancer=(TextView) window.findViewById(R.id.tvCancer);
		TextView tvConfirm=(TextView) window.findViewById(R.id.tvConfirm);
		tv_message.setText(content);
		tv_title.setText(title); 
		tvCancer.setText(getResources().getString(R.string.alert_cancer));
		tvConfirm.setText(getResources().getString(R.string.alert_confirm));
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
			}
		});
	}
}
