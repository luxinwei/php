package com.dzqc.student.adapter;

import java.util.ArrayList;
import java.util.List;

import com.dzqc.student.R;
import com.dzqc.student.model.WorkListResult.workList.rowInfo;
import com.dzqc.student.model.WorkListResult.workList.rowInfo.publishInfo;
import com.dzqc.student.utils.AppTimeUtils;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

public class WorkHistoryAdapter extends BaseAdapter{

	private LayoutInflater mInflater;
	public List<rowInfo> mList;
	public publishInfo pubInfo;//发布者信息
	ViewHolder holder = null;
	public WorkHistoryAdapter(Context pContext,  List<rowInfo> pList) {
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
			convertView = mInflater.inflate(R.layout.work_history_item, null);
			holder = new ViewHolder();
			holder.workName = (TextView) convertView.findViewById(R.id.tv_work_name);
			holder.workCode=(TextView) convertView.findViewById(R.id.tv_work_id);
			holder.date=(TextView) convertView.findViewById(R.id.tv_work_date);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		rowInfo listMode=mList.get(position);
		holder.workName.setText(listMode.getTitle());
		holder.workCode.setText(listMode.getId());
		String regDate=AppTimeUtils.millsToDateFormat(listMode.getAddtime());
		holder.date.setText(regDate);
		return convertView;
	}
	private static class ViewHolder {
		private TextView workName,workCode,date;
	}
}
