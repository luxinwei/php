package com.dzqc.student.adapter;

import java.util.ArrayList;
import java.util.List;
import java.util.Map;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.database.LocalShoolDbHelp;
import com.dzqc.student.model.WorkSchoolAddMode.DataList.RowList;
import com.dzqc.student.utils.ToastUtils;

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
	LocalShoolDbHelp dbHelp;
	public WorkSchoolAddAdapter(Context pContext, List<RowList> pList,String flag) {
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
		boolean isExist=dbHelp.getSchoolById(listMode.getId());
		if (isExist) {
			holder.tvAdd.setEnabled(false);
		    holder.tvAdd.setTextColor(DzqcStu.getInstance().getResources().getColor(R.color.GRB1));
		}else {
			holder.tvAdd.setEnabled(true);
			holder.tvAdd.setTextColor(DzqcStu.getInstance().getResources().getColor(R.color.GRB5));
		}
		holder.tvAdd.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				List<Map<String, String>> listMaps=dbHelp.getSchoolInfo();
				if (listMaps.size()>=5) {
					ToastUtils.showToast("最多只能添加5个学校");
				}else {
					int isSuccess=dbHelp.setSchoolInfo(listMode.getId(), listMode.getName());
					if (isSuccess==-1) {
						ToastUtils.showToast("添加失败");
					}else {
						ToastUtils.showToast("添加成功");
					    WorkSchoolAddAdapter.this.notifyDataSetChanged();
					}
				}
				
			}
		});
		}else if (flag.equals("")) {
			holder.tvName.setText(listMode.getName());//学校名称;
			holder.tvCode.setText(listMode.getId());//学校Id
			holder.tvAdd.setVisibility(View.GONE);
			holder.imgDetailGo.setVisibility(View.GONE);
		}
		return convertView;
	}
	private static class ViewHolder {
		private TextView tvName,tvCode,tvAdd;
		private ImageView imgDetailGo;
	}
}
