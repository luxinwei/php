package com.dzqc.student.adapter;

import java.util.ArrayList;
import java.util.List;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.model.WorkListResult.workList.rowInfo.publishInfo;
import com.dzqc.student.utils.AppTimeUtils;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class MyInnovationListAdapter extends BaseAdapter{

	private LayoutInflater mInflater;
	public List<com.dzqc.student.model.MyInnovationListMode.DataList.Rows> mList;
	public publishInfo pubInfo;//发布者信息
	ViewHolder holder = null;
	public MyInnovationListAdapter(Context pContext,  List<com.dzqc.student.model.MyInnovationListMode.DataList.Rows> pList) {
		mInflater = LayoutInflater.from(pContext);
		if (pList != null) {
			mList = pList;
		} else {
			mList = new ArrayList<com.dzqc.student.model.MyInnovationListMode.DataList.Rows>();
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
			convertView = mInflater.inflate(R.layout.innovation_list_item, null);
			holder = new ViewHolder();
			holder.userName = (TextView) convertView.findViewById(R.id.tv_innovation_Name);
			holder.innovationContent=(TextView) convertView.findViewById(R.id.tv_innovation_content);
			holder.innovationDate=(TextView) convertView.findViewById(R.id.tv_innovation_Date);
			holder.imgAgree=(ImageView) convertView.findViewById(R.id.img_agreeAction);
			holder.imgUserPic=(ImageView) convertView.findViewById(R.id.img_innovation_pic);
			holder.innovationAgreeSum=(TextView)convertView.findViewById(R.id.tv_innovation_sum);
			holder.innovationId=(TextView) convertView.findViewById(R.id.tv_innovation_id);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		com.dzqc.student.model.MyInnovationListMode.DataList.Rows listMode=mList.get(position);
		
		holder.userName.setText(listMode.getTitle());
		holder.innovationContent.setText(listMode.getDesc());
		holder.innovationAgreeSum.setText("共"+listMode.getAgree()+"赞");
		
		//时间转换
		String date=AppTimeUtils.millsToDate(listMode.getAddtime());
		String formatDate=AppTimeUtils.getInitTimeString(DzqcStu.getInstance(), date);
		holder.innovationDate.setText(formatDate);
		
		holder.innovationId.setText(listMode.getId());
		/*String url=userData.getAvatar();
		String imgKey=userData.getStudent_and_photo();
		String imgUrl=url+imgKey;
		if (DzqcStu.isDebug) {
			Log.i("获取图片URl----------》》", url+imgKey);
		}
		if (imgUrl!=null) {
			//HttpImage.loadImage(holder.imgUserPic, imgUrl);
		}*/
		return convertView;
	}
	private static class ViewHolder {
		private TextView userName,innovationContent,innovationDate,innovationAgreeSum,innovationId;
		private ImageView imgUserPic,imgAgree;
	}
}
