package com.dzqc.student.ui.mine;

import java.util.HashMap;
import java.util.Map;

import com.dzqc.student.R;
import com.dzqc.student.alipay.PayDemoActivity;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpImage;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.UserBasicMode;
import com.dzqc.student.model.UserBasicMode.User;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

public class MineFragment extends Fragment implements View.OnClickListener {

	private ImageView imgBasicInfo;
	
	private RelativeLayout rlMyInnovation,rlHistoryJob;
	private RelativeLayout rlJoining,rlDoing,rlOver;
	private RelativeLayout rlSetting;
	private RelativeLayout rlPayMoney;
	
	private TextView tvUserName;
	private ImageView imgSex,imgUsrPic,imgCertificationState;
	
	private String state="";
	
	@Override
	public View onCreateView(LayoutInflater inflater,
			@Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_mine, null);
		initNav(view);
		initView(view);
		return view;
	}

	private void initNav(View view) {
		((TextView) view.findViewById(R.id.leftText))
				.setVisibility(View.INVISIBLE);
		TextView titleText = (TextView) view.findViewById(R.id.titleText);
		titleText.setText(R.string.bottommenu_mine);
	}

	private void initView(View view)
	{
		imgBasicInfo=(ImageView) view.findViewById(R.id.img_certificationGo);
		imgBasicInfo.setOnClickListener(this);
		
		rlMyInnovation=(RelativeLayout) view.findViewById(R.id.rlMyInnovation);
		rlMyInnovation.setOnClickListener(this);
		rlHistoryJob=(RelativeLayout) view.findViewById(R.id.rlHistoryJob);
		rlHistoryJob.setOnClickListener(this);
		rlJoining=(RelativeLayout) view.findViewById(R.id.rlJoining);
		rlDoing=(RelativeLayout) view.findViewById(R.id.rlDoing);
		rlOver=(RelativeLayout) view.findViewById(R.id.rlOver);
		rlJoining.setOnClickListener(this);
		rlDoing.setOnClickListener(this);
		rlOver.setOnClickListener(this);
		rlSetting=(RelativeLayout) view.findViewById(R.id.rl_setting);
		rlSetting.setOnClickListener(this);
		rlPayMoney=(RelativeLayout) view.findViewById(R.id.rlPayMoney);
		rlPayMoney.setOnClickListener(this);
		
		imgCertificationState=(ImageView) view.findViewById(R.id.img_userCertification);
		
		tvUserName=(TextView) view.findViewById(R.id.tv_userName);
		imgSex=(ImageView) view.findViewById(R.id.img_Sex);
		imgUsrPic=(ImageView) view.findViewById(R.id.img_userPic);
	}
	
	@Override
	public void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		loadBasicInfo();
	}
	
	@Override
	public void onClick(View v) {
		Intent intent=null;
		switch (v.getId()) {
		case R.id.img_certificationGo:
			startActivity(new Intent(getActivity(), PersonalInfoActivity.class));
			break;
		case R.id.rlMyInnovation:
			startActivity(new Intent(getActivity(), MyInnovationList.class));
			break;
		case R.id.rlHistoryJob:
			startActivity(new Intent(getActivity(), MyJobList.class));
			break;
		case R.id.rlJoining://报名中
			state="10";
			intent=new Intent(getActivity(), MyWorkStateList.class);
			intent.putExtra("state", state);
			startActivity(intent);
			break;
		case R.id.rlDoing://进行中
			state="20";
			intent=new Intent(getActivity(), MyWorkStateList.class);
			intent.putExtra("state", state);
			startActivity(intent);
			break;
		case R.id.rlOver://已结束
			state="30";
			intent=new Intent(getActivity(), MyWorkStateList.class);
			intent.putExtra("state", state);
			startActivity(intent);
			break;
		case R.id.rl_setting://设置
			startActivity(new Intent(getActivity(), UserSetActivity.class));
			break;
		case R.id.rlPayMoney://支付、提现
			startActivity(new Intent(getActivity(), PayDemoActivity.class));
			break;
		default:
			break;
		}
	}
	private void loadBasicInfo() {
		Map<String, String> map = new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.myBaseData,
				Urls.MethodType.GET, Urls.function.myBaseData, map,
				new HttpCallback() {

					@SuppressLint("NewApi") @Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("获取用户基本信息返回结果-----》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<UserBasicMode>() {
						}.getType();
						UserBasicMode baseBean = gson.fromJson(response, type);
						if (baseBean.getStatus()==1) {
							UserInfoKeeper.updToken(baseBean.getToken());
							User user=baseBean.getUser();
							tvUserName.setText(user.getRealname());
							if (user.getSex()!=null) {
								if (user.getSex().equals("1")) {
									imgSex.setBackground(getResources().getDrawable(R.drawable.male));
								}else {
									imgSex.setBackground(getResources().getDrawable(R.drawable.female));
								}
							}
							if (user.getAvatar()!=null) {
								HttpImage.loadImage(imgUsrPic, user.getAvatar(), R.drawable.mydefault, R.drawable.mydefault,360);
							}
							if (user.getAudit()!=null) {
								if (user.getAudit().equals("20")) {
									imgCertificationState.setBackgroundResource(R.drawable.v);
								}else {
									imgCertificationState.setBackgroundResource(R.drawable.w);
								}
							}
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}


}
