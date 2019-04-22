package com.dzqc.student.adapter;

import java.util.ArrayList;

import com.dzqc.student.R;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

public class YearAdapter extends BaseAdapter {
	Context c;
	ArrayList<Object> arrayList;
	Holider holider;

	public YearAdapter(Context c, ArrayList<Object> arrayList) {
		this.c = c;
		this.arrayList = arrayList;
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
			view = LayoutInflater.from(c).inflate(R.layout.spinner_item,
					parent, false);
			holider.txtName = (TextView) view.findViewById(R.id.tvName);
			holider.txtCode = (TextView) view.findViewById(R.id.tvCode);
			view.setTag(holider);
		}
		
		//CityMode citySp=(CityMode)arrayList.get(index);
		holider.txtName.setText(arrayList.get(index).toString());
		return view;
	}

	class Holider {
		TextView txtName, txtCode;
	}

}
