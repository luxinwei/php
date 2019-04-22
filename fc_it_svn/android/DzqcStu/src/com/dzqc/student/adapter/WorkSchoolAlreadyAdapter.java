package com.dzqc.student.adapter;

import java.util.ArrayList;
import java.util.List;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.database.LocalShoolDbHelp;
import com.dzqc.student.http.HttpImage;
import com.dzqc.student.model.WorkSchoolAddMode.DataList.RowList;
import com.dzqc.student.utils.ToastUtils;

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
	ViewHolder holder = null;
	LocalShoolDbHelp dbHelp;
	public WorkSchoolAlreadyAdapter(Context pContext, List<RowList> pList,String flag) {
		mInflater = LayoutInflater.from(pContext);
		if (pList != null) {
			mList = pList;
		} else {
			mList = new ArrayList<RowList>();
		}
		this.flag=flag;
		dbHelp=LocalShoolDbHelp.getInstance(DzqcStu.getInstance());
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
	public View getView(final int position, View convertView, ViewGroup parent) {
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
		if (position==0) {
			holder.citytitle.setVisibility(View.VISIBLE);
		}else if (position>0) {
			RowList listTemp=mList.get(position-1);
			if (listMode.getCity().equals(listTemp.getCity())) {
				holder.citytitle.setVisibility(View.GONE);
			}else {
				holder.citytitle.setVisibility(View.VISIBLE);
			}
		}
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
				int temp=dbHelp.deleteSchoolInfo(listMode.getId());
				if (temp==0) {
					ToastUtils.showToast("删除失败");
				}else {
					ToastUtils.showToast("删除成功");
					mList.remove(position);
					WorkSchoolAlreadyAdapter.this.notifyDataSetChanged();
				}
			}
		});
		return convertView;
	}
	private static class ViewHolder {
		private TextView citytitle,schoolName,schoolAddress,tvDel;
		private ImageView imgIcon;
	}
}
