package com.dzqc.student.ui.work;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import android.app.ProgressDialog;
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
import com.dzqc.student.adapter.WorkCommentListAdapter;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.ComCommentListMode;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.SubmitDialog;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnLoadMoreListener;
import com.ygs.pullrefreshloadmore.PullRefreshLoadMore.OnRefreshListener;

public class ComCommentListActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private String workId;//企业ID
	private String comPosition;//任务名称
	
	private WorkCommentListAdapter commentAdapter;
	private PullRefreshLoadMore mCommentList;
	private List<com.dzqc.student.model.ComCommentListMode.ListData.Rows> commentList;
	
	private TextView tvWorkName;
	
	private ProgressDialog pd;
	private TextView tvEmptyInfo;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.work_comment_list_layout);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();

		Intent intent = getIntent();
		if (intent!=null) {
			workId=intent.getStringExtra("workId");
			comPosition=intent.getStringExtra("comName");
		}
		tvWorkName.setText(comPosition);
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_comment_title));
	}

	private void initView() {
		tvEmptyInfo=(TextView) findViewById(R.id.tvEmptyInfo);
		tvWorkName=(TextView) findViewById(R.id.tvComPosition);
		mCommentList=(PullRefreshLoadMore) findViewById(R.id.workCommentList);
		mCommentList.setCanLoadMore(false);
		mCommentList.setCanRefresh(false);
		mCommentList.setAutoLoadMore(false);
		mCommentList.setMoveToFirstItemAfterRefresh(false);
		mCommentList.setDoRefreshOnUIChanged(false);
		mCommentList.setEmptyView(tvEmptyInfo);
		
		mCommentList.setOnRefreshListener(new OnRefreshListener() {
			
			@Override
			public void onRefresh() {
				// TODO Auto-generated method stub
				mCommentList.onRefreshComplete();
			}
		});
		mCommentList.setOnLoadListener(new OnLoadMoreListener() {
			
			@Override
			public void onLoadMore() {
				// TODO Auto-generated method stub
				mCommentList.onRefreshComplete();
				mCommentList.setCanRefresh(false);
			}
		});
		mCommentList.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				// TODO Auto-generated method stub
				
			}
		});
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
		map.put("taskid", workId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getListByTask,
				Urls.MethodType.GET, Urls.function.getListByTask, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取评价列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<ComCommentListMode>() {
						}.getType();
						ComCommentListMode commentBean = gson.fromJson(response,
								type);
						if (commentBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(commentBean.getToken());
							commentList=commentBean.getList().getRows();
							commentAdapter = new WorkCommentListAdapter(
									ComCommentListActivity.this, commentList);
							mCommentList.setAdapter(commentAdapter);
						}else {
							ToastUtils.showToast(commentBean.getInfo());
						}
						if(pd.isShowing())
						{
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
			AppManager.getAppManager().finishActivity(ComCommentListActivity.this);
			break;
		default:
			break;
		}
	}
}
