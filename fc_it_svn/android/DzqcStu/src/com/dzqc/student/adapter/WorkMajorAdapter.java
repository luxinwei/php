package com.dzqc.student.adapter;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import com.dzqc.student.R;
import com.dzqc.student.model.IndustryMode.DataList.Rows;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class WorkMajorAdapter extends BaseAdapter {

	private LayoutInflater mInflater;
	public List<Rows> mList;
	ViewHolder holder = null;

	private String flag;
	HashMap<String, Boolean> states = new HashMap<String, Boolean>();

	public WorkMajorAdapter(Context pContext, List<Rows> pList,String flag) {
		mInflater = LayoutInflater.from(pContext);
		if (pList != null) {
			mList = pList;
		} else {
			mList = new ArrayList<Rows>();
		}
		this.flag=flag;
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
			convertView = mInflater.inflate(R.layout.listview_item, null);
			holder = new ViewHolder();
			holder.tvName = (TextView) convertView.findViewById(R.id.tvName);
			holder.tvCode=(TextView) convertView.findViewById(R.id.tvCode);
			holder.tvAdd=(TextView) convertView.findViewById(R.id.tvAddSchool);
			holder.imgDetailGo=(ImageView) convertView.findViewById(R.id.img_schoolDetail);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		Rows listMode=mList.get(position);
		if (flag.equals("add")) {
			
		}else if (flag.equals("")) {
			holder.tvName.setText(listMode.getName());
			holder.tvCode.setText(listMode.getId());//专业Id
			holder.imgDetailGo.setVisibility(View.GONE);
			holder.tvAdd.setVisibility(View.GONE);
		}else {
			holder.tvName.setText(listMode.getName());
			holder.tvCode.setText(listMode.getId());//专业Id
			holder.imgDetailGo.setVisibility(View.GONE);
			holder.tvAdd.setVisibility(View.GONE);
		}
		return convertView;
	}
	private static class ViewHolder {
		private TextView tvName,tvCode,tvAdd;
		private ImageView imgDetailGo;
	}
}
