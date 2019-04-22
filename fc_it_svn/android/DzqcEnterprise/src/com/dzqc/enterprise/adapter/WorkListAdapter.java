package com.dzqc.enterprise.adapter;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import com.android.volley.toolbox.ImageLoader;
import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.http.HttpImage;
import com.dzqc.enterprise.model.WorkListResult.workList.rowInfo;
import com.dzqc.enterprise.model.WorkListResult.workList.rowInfo.publishInfo;
import com.dzqc.enterprise.utils.AppTimeUtils;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class WorkListAdapter extends BaseAdapter{

	private LayoutInflater mInflater;
	public List<rowInfo> mList;
	public publishInfo pubInfo;//发布者信息
	ViewHolder holder = null;
	public WorkListAdapter(Context pContext,  List<rowInfo> pList) {
		mInflater = LayoutInflater.from(pContext);
		if (pList != null) {
			mList = pList;
		} else {
			mList = new ArrayList<rowInfo>();
		}
	}

	@Override
	public int getCount() {
		return mList.size();
	}

	@Override
	public Object getItem(int position) {
		return mList.get(position);
	}

	@Override
	public long getItemId(int position) {
		// System.out.println("getItemId = " + position);
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		if (getCount() == 0) {
			return null;
		}
		if (convertView == null) {
			convertView = mInflater.inflate(R.layout.work_list_item, null);
			holder = new ViewHolder();
			holder.comName = (TextView) convertView.findViewById(R.id.tv_work_com);
			holder.comJob=(TextView) convertView.findViewById(R.id.tv_work_positon);
			holder.regDate=(TextView) convertView.findViewById(R.id.tv_work_date);
			holder.imgComIcom=(ImageView) convertView.findViewById(R.id.img_work_icon);
			holder.imgStatus=(ImageView) convertView.findViewById(R.id.img_work_com_status);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		rowInfo listMode=mList.get(position);
		holder.comName.setText(listMode.getTitle());
		holder.comJob.setText(listMode.getContent());
		Date regDate=AppTimeUtils.parseDate(listMode.getAddtime());
		holder.regDate.setText(AppTimeUtils.getInitTimeString(DzqcEnterprise.getInstance(), AppTimeUtils.formatDate(regDate)));
		if (listMode.getState().equals("10")) {//报名中
			holder.imgStatus.setBackgroundResource(R.drawable.sign_up);
		}else if (listMode.getState().equals("20")) {//已开始(进行中）
			holder.imgStatus.setBackgroundResource(R.drawable.conduct);
		}else if(listMode.getState().equals("30")){//已结束
			holder.imgStatus.setBackgroundResource(R.drawable.over);
		}else if (listMode.getState().equals("40")) {//已取消
			holder.imgStatus.setBackgroundResource(R.drawable.cancle);
		}
		pubInfo=listMode.getPublisherData();
		String url=pubInfo.getLogo();
		String imgKey=pubInfo.getCompanyimage();
		String imgUrl=url+imgKey;
		if (DzqcEnterprise.isDebug) {
			Log.i("获取图片URl----------》》", url+imgKey);
		}
		if (imgUrl!=null) {
			HttpImage.loadImage(holder.imgComIcom, imgUrl);
		}
		return convertView;
	}
	private static class ViewHolder {
		private TextView comName,comJob,regDate;
		private ImageView imgComIcom,imgStatus;
	}
}
