package com.dzqc.enterprise.adapter;

import java.util.ArrayList;
import java.util.List;

import com.android.volley.toolbox.ImageLoader;
import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.AppInfoKeeper;
import com.dzqc.enterprise.http.HttpImage;
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

public class WorkSchoolAlreadyAdapter extends BaseAdapter{

	private LayoutInflater mInflater;
	public List<RowList> mList;
	private String flag;
	private String[] idArry;
	ViewHolder holder = null;
	public WorkSchoolAlreadyAdapter(Context pContext, List<RowList> pList,String flag) {
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
			convertView = mInflater.inflate(R.layout.work_already_school_item_child, null);
			holder = new ViewHolder();
			holder.citytitle = (TextView) convertView.findViewById(R.id.tv_city_title);
			holder.schoolName=(TextView) convertView.findViewById(R.id.tv_school_name);
			holder.schoolAddress=(TextView) convertView.findViewById(R.id.tv_school_address);
			holder.tvDel=(TextView) convertView.findViewById(R.id.tv_apply_comfirm);
			holder.imgIcon=(ImageView) convertView.findViewById(R.id.img_school_icon);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		final RowList listMode=mList.get(position);
		holder.citytitle.setText(listMode.getCity());
		holder.schoolName.setText(listMode.getName());
		holder.schoolAddress.setText(listMode.getAddress());
		String url=listMode.getLogo();
		if (!url.equals("")) {
			HttpImage.loadImage(holder.imgIcon, url);
		}else {
			holder.imgIcon.setImageResource(R.drawable.qq_icon);
		}
		holder.tvDel.setOnClickListener(new OnClickListener() {
			
			@SuppressLint("ResourceAsColor") @Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				idArry=AppInfoKeeper.getSelectSchool().substring(0, AppInfoKeeper.getSelectSchool().lastIndexOf(",")).split(",");
				String res="";
				for (int i = 0; i < idArry.length; i++) {
					if (idArry[i].equals(listMode.getId())) {
					}else {
						res=idArry[i]+","+res;
					}
				}
				AppInfoKeeper.setSelectSchool(res);
				holder.tvDel.setEnabled(false);
				holder.tvDel.setTextColor(R.color.GRB1);
				holder.tvDel.setBackgroundResource(R.drawable.tv_bord_gray);
			}
		});
		return convertView;
	}
	private static class ViewHolder {
		private TextView citytitle,schoolName,schoolAddress,tvDel;
		private ImageView imgIcon;
	}
}
