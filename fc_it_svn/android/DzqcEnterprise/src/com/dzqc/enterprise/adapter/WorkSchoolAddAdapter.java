package com.dzqc.enterprise.adapter;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.AppInfoKeeper;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.database.table.SchoolDao;
import com.dzqc.enterprise.model.WorkSchoolAddMode.DataList.RowList;

import android.annotation.SuppressLint;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class WorkSchoolAddAdapter extends BaseAdapter{

	private LayoutInflater mInflater;
	public List<RowList> mList;
	private String flag;
	ViewHolder holder = null;
	public WorkSchoolAddAdapter(Context pContext, List<RowList> pList,String flag) {
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
		final RowList listMode=mList.get(position);
		if (flag.equals("add")) {
		holder.tvName.setText(listMode.getName());//学校名称;
		holder.tvCode.setText(listMode.getId());//学校Id
		holder.tvAdd.setVisibility(View.VISIBLE);
		holder.imgDetailGo.setVisibility(View.GONE);
		holder.tvAdd.setOnClickListener(new OnClickListener() {
			
			@SuppressLint("ResourceAsColor") @Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				String ids=AppInfoKeeper.getSelectSchool();
				if (ids.equals("000000")) {
					AppInfoKeeper.setSelectSchool(listMode.getId()+",");
				}else {
					AppInfoKeeper.setSelectSchool(ids+listMode.getId()+",");
				}
			holder.tvAdd.setEnabled(false);
			holder.tvAdd.setTextColor(R.color.GRB1);
			}
		});
		}
		return convertView;
	}
	private static class ViewHolder {
		private TextView tvName,tvCode,tvAdd;
		private ImageView imgDetailGo;
	}
}
