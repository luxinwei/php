package com.dzqc.enterprise.ui.index;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.dzqc.enterprise.R;

public class IndexFragment extends Fragment implements View.OnClickListener {

	TextView titleText;

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_index, null);
		initNav(view);
		initView(view);
		return view;
	}

	private void initNav(View view) {
		((TextView) view.findViewById(R.id.leftText)).setVisibility(View.INVISIBLE);
		titleText = (TextView) view.findViewById(R.id.titleText);
		titleText.setText(R.string.app_display_name);
	}

	private void initView(View view) {
		// TODO Auto-generated method stub
	}

	@Override
	public void onPause() {
		super.onPause();
	}

	@Override
	public void onResume() {
		super.onResume();
	}

	@Override
	public void onClick(View v) {

	}

}
