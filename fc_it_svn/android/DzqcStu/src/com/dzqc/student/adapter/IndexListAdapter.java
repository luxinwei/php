package com.dzqc.student.adapter;

import java.util.ArrayList;
import java.util.List;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.http.HttpImage;
import com.dzqc.student.model.IndexListMode.DataList.Rows;
import com.dzqc.student.utils.AppTimeUtils;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

public class IndexListAdapter extends BaseAdapter{

	private LayoutInflater mInflater;
	public List<Rows> mList;
	//public publishInfo pubInfo;//发布者信息
	ViewHolder holder = null;
	
	private ListView mListView; 
	
	public IndexListAdapter(Context pContext,  List<Rows> pList) {
		mInflater = LayoutInflater.from(pContext);
		if (pList != null) {
			mList = pList;
		} else {
			mList = new ArrayList<Rows>();
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
		if (mListView == null) {
		    mListView = (ListView) parent;
		}
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
			//holder.tvstate=(TextView) convertView.findViewById(R.id.tv_work_state);
			holder.workId=(TextView)convertView.findViewById(R.id.tv_work_id);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		Rows listMode=mList.get(position);
		/*String jobTitle="你好";
		Log.i("汉字字节长度---->",jobTitle.length()+"");*/
		String jobTitle=listMode.getPosition();
		if (jobTitle.length()>8) {
			jobTitle=jobTitle.substring(0, 8)+"...";
		}
		holder.comName.setText(jobTitle);
		holder.comJob.setText(listMode.getResponsibility());
		
		//时间转换
		String date=AppTimeUtils.millsToDate(listMode.getTime());
		String formatDate=AppTimeUtils.getInitTimeString(DzqcStu.getInstance(), date);
		holder.regDate.setText(formatDate);
		
		holder.workId.setText(listMode.getId());
		if (listMode.getState()!=null) {
			if (listMode.getState().equals("10")) {//任务
				holder.imgStatus.setImageResource(R.drawable.task);
				//holder.tvstate.setText("任务");
			}else if (listMode.getState().equals("2")) {//兼职
				holder.imgStatus.setImageResource(R.drawable.part_time_job);
			}else if(listMode.getState().equals("3")){//已全职
			 holder.imgStatus.setImageResource(R.drawable.full_time);
			}else {
				 holder.imgStatus.setVisibility(View.GONE);
			}
		}
		String imgUrl=listMode.getDownload_url().getBusiness_head();
		if (imgUrl!=null) {
			HttpImage.loadImage(holder.imgComIcom, imgUrl);
		}
		return convertView;
	}
	private static class ViewHolder {
		private TextView comName,comJob,regDate,workId;
		private ImageView imgComIcom,imgStatus;
	}
}
