package com.dzqc.student.ui.mine;

import java.util.HashMap;
import java.util.Map;

import android.os.Bundle;
import android.util.Log;
import android.util.TypedValue;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
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
import com.dzqc.student.utils.EncodeUtf8;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class UserSayingActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader, tvRight;


	private EditText etContent;

	private String content;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.personal_saying);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.mine_user_say));

		tvRight = (TextView) findViewById(R.id.tvRight);
		tvRight.setVisibility(View.VISIBLE);
		tvRight.setText(getResources().getString(R.string.mine_save));
		tvRight.setTextColor(getResources().getColor(R.color.GRB5));
		tvRight.setTextSize(TypedValue.COMPLEX_UNIT_SP, 18);
		tvRight.setOnClickListener(this);
	}

	private void initView() {
		etContent = (EditText) findViewById(R.id.et_userSaying);
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
	}

	/**
	 * 提交个人说明信息
	 */
	private void submitInfo() {
		Map<String, String> map = new HashMap<String, String>();
		content=etContent.getText().toString();
		map.put("personal_note", content);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.submitResume,
				Urls.MethodType.GET, Urls.function.submitResume, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("提交个人说明返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel submitBean = gson.fromJson(response,
								type);
						if (submitBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(submitBean.getToken());
							ToastUtils.showToast(submitBean.getInfo());
							UserSayingActivity.this.finish();
						} else {
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
			AppManager.getAppManager().finishActivity(UserSayingActivity.this);
			break;
		case R.id.tvRight:
			if (etContent.getText().equals("")) {
				ToastUtils.showToast(getResources().getString(
						R.string.mine_user_say_alert));
			} else {
				// 提交说明信息
				submitInfo();
			}
			break;
		default:
			break;
		}
	}

}
