package com.dzqc.student.ui.work;

import java.util.HashMap;
import java.util.Map;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.RatingBar.OnRatingBarChangeListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.index.IndexUserInfoActivity;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class WorkCommentActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private String workId;
	
	private TextView tvSubmit;
	private RatingBar ratingBar;
	private EditText etContent;
	private String score="5";//默认5星好评
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.work_comment_submit);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();

		Intent intent = getIntent();
		if (intent!=null) {
			workId=intent.getStringExtra("workId");
		}
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_comment_header));
	}

	private void initView() {
		tvSubmit=(TextView) findViewById(R.id.tvWorkComment);
		tvSubmit.setOnClickListener(this);
		
		ratingBar=(RatingBar) findViewById(R.id.ratingBarComment);
		etContent=(EditText) findViewById(R.id.etCommentContent);
		
		ratingBar.setOnRatingBarChangeListener(new OnRatingBarChangeListener() {
			
			@Override
			public void onRatingChanged(RatingBar ratingBar, float rating,
					boolean fromUser) {
				// TODO Auto-generated method stub
				score=String.valueOf(rating);
			}
		});
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		
	}

	/**
	 * 非空判断
	 * @return
	 */
	private String isEmpty()
	{
		String flag="";
		String commentTemp=etContent.getText().toString();
		if (score.equals("0.0")) {
			flag="1";
		}else if (commentTemp.equals("")) {
			flag="2";
		}
		return flag;
	}
	
	/**
	 * 提交评论
	 */
	private void submitInfo() {
		if (isEmpty().equals("1")) {
			ToastUtils.showToast("请输入有效评分");
			return;
		}else if (isEmpty().equals("2")) {
			ToastUtils.showToast("请输入评论内容");
			return;
		}
		Map<String, String> map = new HashMap<String, String>();
		map.put("taskid", workId);
		map.put("content", etContent.getText().toString());
		map.put("star", score);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.addComment,
				Urls.MethodType.GET, Urls.function.addComment, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("提交评论返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel submitBean = gson.fromJson(response,
								type);
						if (submitBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(submitBean.getToken());
							ToastUtils.showToast(submitBean.getInfo());
						}else {
							ToastUtils.showToast(submitBean.getInfo());
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
			AppManager.getAppManager().finishActivity(WorkCommentActivity.this);
			break;
		case R.id.tvWorkComment:
			submitInfo();
			break;
		default:
			break;
		}
	}
}
