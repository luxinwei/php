package com.dzqc.enterprise.adapter;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.database.table.SchoolDao;
import com.dzqc.enterprise.model.WorkSchoolListMode;
import com.dzqc.enterprise.model.WorkSchoolListMode.DataList.RowList;

import android.annotation.SuppressLint;
import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class WorkSchoolAdapter extends BaseAdapter{

	private LayoutInflater mInflater;
	public List<RowList> mList;
	private String flag;
	ViewHolder holder = null;
	public WorkSchoolAdapter(Context pContext, List<RowList> pList,String flag) {
		mInflater = LayoutInflater.from(pContext);
		if (pList != null) {
			mList = pList;
		} else {
			mList = new ArrayList<RowList>();
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
		// System.out.println("getItemId = " + position);
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
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
		RowList listMode=mList.get(position);
		if (flag.equals("add")) {
			
		}else {
			holder.tvName.setText(listMode.getTitle()+"全部大学");
			holder.tvCode.setText(listMode.getId());//城市Id
			holder.imgDetailGo.setVisibility(View.VISIBLE);
			holder.tvAdd.setVisibility(View.GONE);
		}
		return convertView;
	}
	private static class ViewHolder {
		private TextView tvName,tvCode,tvAdd;
		private ImageView imgDetailGo;
	}
}
