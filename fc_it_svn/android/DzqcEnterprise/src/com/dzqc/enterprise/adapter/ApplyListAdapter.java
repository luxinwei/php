package com.dzqc.enterprise.adapter;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.model.ApplyMode.ListInfo.Rows;
import com.dzqc.enterprise.model.ApplyMode.ListInfo.Rows.UserData;
import com.dzqc.enterprise.model.ResultMode;
import com.dzqc.enterprise.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;


public class ApplyListAdapter extends BaseAdapter {
	Context c;
	List<Rows> arrayList;
	Holider holider;
	String typeStatus="";
	public ApplyListAdapter(Context c,List<Rows> listapply) {
		this.c = c;
		if (listapply != null) {
			arrayList = listapply;
		} else {
			arrayList = new ArrayList<Rows>();
		}
	}

	@Override
	public int getCount() {
		// TODO Auto-generated method stub
		return arrayList.size();
	}

	@Override
	public Object getItem(int index) {
		// TODO Auto-generated method stub
		return arrayList.get(index);
	}

	@Override
	public long getItemId(int index) {
		// TODO Auto-generated method stub
		return 0;
	}

	@Override
	public View getView(int index, View view, ViewGroup parent) {
		// TODO Auto-generated method stub
		if (view != null) {
			holider = (Holider) view.getTag();
		} else {
			holider = new Holider();
			view = LayoutInflater.from(c).inflate(R.layout.work_apply_list_item,
					parent, false);
			holider.li_applyAction =  (LinearLayout) view.findViewById(R.id.li_ApplyAction);
			holider.li_applyStatus = (LinearLayout) view.findViewById(R.id.li_ApplyStatus);
			holider.tv_apply_agree = (TextView) view.findViewById(R.id.tv_apply_agree);
			holider.tv_apply_refuse = (TextView) view.findViewById(R.id.tv_apply_refuse);
			holider.tv_apply_status = (TextView) view.findViewById(R.id.tv_apply_status);
			holider.tv_apply_comfirm = (TextView) view.findViewById(R.id.tv_apply_comfirm);
			
			holider.tvApplyName = (TextView) view.findViewById(R.id.tv_apply_name);
			holider.tvApplyDate = (TextView) view.findViewById(R.id.tv_apply_date);
			holider.imgIcon = (ImageView) view.findViewById(R.id.img_apply_photo);
			view.setTag(holider);
		}
		Rows rowsList=arrayList.get(index);
		typeStatus=rowsList.getState();
		if (typeStatus.equals("0")) {
			holider.li_applyAction.setVisibility(View.VISIBLE);
			holider.li_applyStatus.setVisibility(View.GONE);
		}else {
			holider.li_applyAction.setVisibility(View.GONE);
			holider.li_applyStatus.setVisibility(View.VISIBLE);
		}
		if(typeStatus.equals("10"))
		{
			holider.tv_apply_status.setText("已同意");
			holider.tv_apply_comfirm.setVisibility(View.GONE);
		}else if (typeStatus.equals("20")) {
			holider.tv_apply_status.setText("已拒绝");
			holider.tv_apply_comfirm.setVisibility(View.GONE);
		}else if (typeStatus.equals("30")) {
			holider.tv_apply_status.setText("已准备");
			holider.tv_apply_comfirm.setVisibility(View.GONE);
		}else if (typeStatus.equals("40")) {
			holider.tv_apply_status.setText("进行中");
			holider.tv_apply_comfirm.setVisibility(View.GONE);
		}else if (typeStatus.equals("50")) {
			holider.tv_apply_status.setText("申请退出");
			holider.tv_apply_comfirm.setVisibility(View.VISIBLE);
		}
		else if (typeStatus.equals("60")) {
			holider.tv_apply_status.setText("已退出");
			holider.tv_apply_comfirm.setVisibility(View.GONE);
		}
		else if (typeStatus.equals("70")) {
			holider.tv_apply_status.setText("已完成");
			holider.tv_apply_comfirm.setVisibility(View.GONE);
		}
		final String id=arrayList.get(index).getId();//任务参与Id
		UserData userData=arrayList.get(index).user_data;
		if (userData!=null) {
			holider.tvApplyName .setText(userData.getRealname());
			holider.tvApplyDate.setText("申请时间："+arrayList.get(index).getAddtime());
		}
		//同意
		holider.tv_apply_agree.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Map<String, String> map = new HashMap<String, String>();
				map.put("id", id);
				HttpRequest.HttpPost(Urls.ROOTURL, Method.agreeJoin,
						Urls.MethodType.GET, Urls.function.agreeJoin, map,
						new HttpCallback() {

							@Override
							public void httpSuccess(String response) {
								// TODO Auto-generated method stub
								if (DzqcEnterprise.isDebug) {
									Log.i("同意学生申请返回结果----------》》", response);
								}
								Gson gson = new Gson();
								java.lang.reflect.Type type = new TypeToken<ResultMode>() {
								}.getType();
								ResultMode resultBean = gson.fromJson(response,
										type);
								if (resultBean.getStatus().equals("1")) {
									UserInfoKeeper.updToken(resultBean.getToken());
									ToastUtils.showToast(resultBean.getInfo());
								}else {
									ToastUtils.showToast(resultBean.getInfo());
								}
							}

							@Override
							public void httpFail(String response) {
								// TODO Auto-generated method stub
							}

						});
			}
		});
		//拒绝
		holider.tv_apply_refuse.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Map<String, String> map = new HashMap<String, String>();
				map.put("id", id);
				HttpRequest.HttpPost(Urls.ROOTURL, Method.refuseJoin,
						Urls.MethodType.GET, Urls.function.refuseJoin, map,
						new HttpCallback() {

							@Override
							public void httpSuccess(String response) {
								// TODO Auto-generated method stub
								if (DzqcEnterprise.isDebug) {
									Log.i("拒绝学生申请返回结果----------》》", response);
								}
								Gson gson = new Gson();
								java.lang.reflect.Type type = new TypeToken<ResultMode>() {
								}.getType();
								ResultMode resultBean = gson.fromJson(response,
										type);
								if (resultBean.getStatus().equals("1")) {
									UserInfoKeeper.updToken(resultBean.getToken());
									ToastUtils.showToast(resultBean.getInfo());
								}else {
									ToastUtils.showToast(resultBean.getInfo());
								}
							}

							@Override
							public void httpFail(String response) {
								// TODO Auto-generated method stub
							}

						});
			}
		});
		//同意退出申请
		holider.tv_apply_comfirm.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Map<String, String> map = new HashMap<String, String>();
				map.put("id", id);
				HttpRequest.HttpPost(Urls.ROOTURL, Method.withdrawal,
						Urls.MethodType.GET, Urls.function.withdrawal, map,
						new HttpCallback() {

							@Override
							public void httpSuccess(String response) {
								// TODO Auto-generated method stub
								if (DzqcEnterprise.isDebug) {
									Log.i("同意退出申请返回结果----------》》", response);
								}
								Gson gson = new Gson();
								java.lang.reflect.Type type = new TypeToken<ResultMode>() {
								}.getType();
								ResultMode resultBean = gson.fromJson(response,
										type);
								if (resultBean.getStatus().equals("1")) {
									UserInfoKeeper.updToken(resultBean.getToken());
									ToastUtils.showToast(resultBean.getInfo());
								}else {
									ToastUtils.showToast(resultBean.getInfo());
								}
							}

							@Override
							public void httpFail(String response) {
								// TODO Auto-generated method stub
							}

						});
			}
		});
		return view;
	}

	class Holider {
		LinearLayout li_applyAction,li_applyStatus;
		TextView tv_apply_agree,tv_apply_refuse,tv_apply_status,tv_apply_comfirm;
		TextView tvApplyName,tvApplyDate;
		ImageView imgIcon;
	}

}
