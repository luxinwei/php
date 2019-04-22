package com.dzqc.student.adapter;

import java.util.ArrayList;
import java.util.List;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.utils.AppTimeUtils;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class MyPostionListAdapter extends BaseAdapter{

	private LayoutInflater mInflater;
	public List<com.dzqc.student.model.MyPositionListMode.PositionList.Rows> mList;
	//public publishInfo pubInfo;//发布者信息
	ViewHolder holder = null;
	public MyPostionListAdapter(Context pContext,  List<com.dzqc.student.model.MyPositionListMode.PositionList.Rows> pList) {
		mInflater = LayoutInflater.from(pContext);
		if (pList != null) {
			mList = pList;
		} else {
			mList = new ArrayList<com.dzqc.student.model.MyPositionListMode.PositionList.Rows>();
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
			holder.workId=(TextView)convertView.findViewById(R.id.tv_work_id);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		com.dzqc.student.model.MyPositionListMode.PositionList.Rows listMode=mList.get(position);
		holder.comName.setText(listMode.getPosition());
		holder.comJob.setText(listMode.getResponsibility());
		//时间转换
		String date=AppTimeUtils.millsToDate(listMode.getTime());
		String formatDate=AppTimeUtils.getInitTimeString(DzqcStu.getInstance(), date);
		holder.regDate.setText(formatDate);
		
		holder.workId.setText(listMode.getRid());
		holder.imgStatus.setVisibility(View.GONE);
		//String status=listMode.getState();
		String status=listMode.getRstate();
		if (status!=null) {
			if (status.equals("1")) {//任务
				holder.imgStatus.setBackgroundResource(R.drawable.task);
			}else if (status.equals("2")) {//兼职
				holder.imgStatus.setBackgroundResource(R.drawable.part_time_job);
			}else if(status.equals("3")){//已全职
				holder.imgStatus.setBackgroundResource(R.drawable.full_time);
			}
		}
		String imgUrl=listMode.getDownload_url();
		if (imgUrl!=null) {
			//HttpImage.loadImage(holder.imgComIcom, imgUrl);
		}
		return convertView;
	}
	private static class ViewHolder {
		private TextView comName,comJob,regDate,workId;
		private ImageView imgComIcom,imgStatus;
	}
}
