package com.dzqc.student.adapter;

import java.util.ArrayList;
import java.util.List;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.http.HttpImage;
import com.dzqc.student.model.ComCommentListMode.ListData.Rows;
import com.dzqc.student.model.ComCommentListMode.ListData.Rows.User_Date;
import com.dzqc.student.model.WorkListResult.workList.rowInfo.publishInfo;
import com.dzqc.student.utils.AppTimeUtils;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;

public class WorkCommentListAdapter extends BaseAdapter{

	private LayoutInflater mInflater;
	public List<com.dzqc.student.model.ComCommentListMode.ListData.Rows> mList;
	public publishInfo pubInfo;//发布者信息
	ViewHolder holder = null;
	public WorkCommentListAdapter(Context pContext,  List<com.dzqc.student.model.ComCommentListMode.ListData.Rows> pList) {
		mInflater = LayoutInflater.from(pContext);
		if (pList != null) {
			mList = pList;
		} else {
			mList = new ArrayList<com.dzqc.student.model.ComCommentListMode.ListData.Rows>();
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
			convertView = mInflater.inflate(R.layout.work_comment_item, null);
			holder = new ViewHolder();
			holder.tvUserName = (TextView) convertView.findViewById(R.id.tvCommentName);
			holder.tvCommentDate=(TextView) convertView.findViewById(R.id.tvCommentDate);
			holder.tvCommentInfo=(TextView) convertView.findViewById(R.id.tvCommentInfo);
			holder.imgUserIcom=(ImageView) convertView.findViewById(R.id.Img_userIcon);
			holder.ratingBar=(RatingBar) convertView.findViewById(R.id.ratingBar);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		Rows commonRows=mList.get(position);
		User_Date user_Date= commonRows.getUser_data();
		
		//时间转换
				String date=AppTimeUtils.millsToDate(commonRows.getAddtime());
				String formatDate=AppTimeUtils.getInitTimeString(DzqcStu.getInstance(), date);
				holder.tvCommentDate.setText(formatDate);
		
		holder.tvUserName.setText(user_Date.getUsername());
		holder.tvCommentInfo.setText(commonRows.getContent());
		int star=Integer.parseInt(commonRows.getStar());
		holder.ratingBar.setRating(star);
		String imgUrl=user_Date.getStudent_and_photo();
		if (DzqcStu.isDebug) {
			Log.i("获取图片URl----------》》", imgUrl);
		}
		if (imgUrl!=null) {
			HttpImage.loadImage(holder.imgUserIcom, imgUrl,R.drawable.myimg,R.drawable.myimg);
		}
		return convertView;
	}
	private static class ViewHolder {
		private TextView tvUserName,tvCommentDate,tvCommentInfo;
		private ImageView imgUserIcom;
		private RatingBar ratingBar;
	}
}
