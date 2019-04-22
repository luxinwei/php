package com.dzqc.enterprise.adapter;

import java.util.List;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.model.WorkDetailRowMode;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;


public class FileAdapter extends BaseAdapter {
	Context c;
	List<WorkDetailRowMode> arrayList;
	Holider holider;

	public FileAdapter(Context c,List<WorkDetailRowMode> listfile) {
		this.c = c;
		this.arrayList = listfile;
	}

	@Override
	public int getCount() {
		// TODO Auto-generated method stub
		return arrayList.size();
	}

	@Override
	public Object getItem(int index) {
		// TODO Auto-generated method stub
		return arrayList.get(index);
	}

	@Override
	public long getItemId(int index) {
		// TODO Auto-generated method stub
		return 0;
	}

	@Override
	public View getView(int index, View view, ViewGroup parent) {
		// TODO Auto-generated method stub
		if (view != null) {
			holider = (Holider) view.getTag();
		} else {
			holider = new Holider();
			view = LayoutInflater.from(c).inflate(R.layout.detail_file_item,
					parent, false);
			holider.tvFileName = (TextView) view.findViewById(R.id.tv_file1);
			view.setTag(holider);
		}
		WorkDetailRowMode detailRowMode=arrayList.get(index);
		holider.tvFileName.setText(detailRowMode.getFname());
		return view;
	}

	class Holider {
		TextView tvFileName;
	}

}
