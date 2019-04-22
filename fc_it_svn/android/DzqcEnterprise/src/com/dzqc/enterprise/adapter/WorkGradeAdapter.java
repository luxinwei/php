package com.dzqc.enterprise.adapter;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.model.WorkGradeListMode;
import com.dzqc.enterprise.ui.work.WorkGradeListActivity;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.RadioButton;
import android.widget.TextView;

public class WorkGradeAdapter extends BaseAdapter {

	private LayoutInflater mInflater;
	public List<WorkGradeListMode> mList;
	ViewHolder holder = null;

	// 用于记录每个RadioButton的状态，并保证只可选一个
	HashMap<String, Boolean> states = new HashMap<String, Boolean>();

	public WorkGradeAdapter(Context pContext, List<WorkGradeListMode> pList) {
		mInflater = LayoutInflater.from(pContext);
		if (pList != null) {
			mList = pList;
		} else {
			mList = new ArrayList<WorkGradeListMode>();
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
		return position;
	}

	@Override
	public View getView(final int position, View convertView, ViewGroup parent) {
		if (getCount() == 0) {
			return null;
		}
		if (convertView == null) {
			convertView = mInflater
					.inflate(R.layout.work_grade_list_item, null);
			holder = new ViewHolder();
			holder.tvGradeName = (TextView) convertView
					.findViewById(R.id.tv_Grade);
			holder.imgCheck=(ImageView) convertView.findViewById(R.id.imgCheck);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		final WorkGradeListMode listMode = mList.get(position);
		holder.tvGradeName.setText(listMode.getGradeName());
		return convertView;
	}

	private static class ViewHolder {
		private TextView tvGradeName;
		private ImageView imgCheck;
	}
}
