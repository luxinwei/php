package com.dzqc.enterprise.ui.mine;

import com.dzqc.enterprise.R;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

public class MineFragment extends Fragment implements View.OnClickListener {

	private ImageView imgBasicInfo;
	
	@Override
	public View onCreateView(LayoutInflater inflater,
			@Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_mine, null);
		initNav(view);
		initView(view);
		return view;
	}

	private void initNav(View view) {
		((TextView) view.findViewById(R.id.leftText))
				.setVisibility(View.INVISIBLE);
		TextView titleText = (TextView) view.findViewById(R.id.titleText);
		titleText.setText(R.string.bottommenu_mine);
	}

	private void initView(View view)
	{
		imgBasicInfo=(ImageView) view.findViewById(R.id.img_certificationGo);
		imgBasicInfo.setOnClickListener(this);
	}
	
	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.img_certificationGo:
			startActivity(new Intent(getActivity(), PersonalInfoActivity.class));
			break;

		default:
			break;
		}
	}
}
