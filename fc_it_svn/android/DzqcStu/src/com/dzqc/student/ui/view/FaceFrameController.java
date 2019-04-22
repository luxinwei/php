package com.dzqc.student.ui.view;

import com.dzqc.student.R;
import com.dzqc.student.ui.view.FacePagerAdapter.OnFaceClickCallback;
import com.dzqc.student.utils.DensityUtils;
import android.content.Context;
import android.support.v4.view.ViewPager;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.view.Gravity;
import android.view.View;
import android.view.ViewGroup.LayoutParams;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.LinearLayout;

public class FaceFrameController {

	private ViewPager viewPager;
	private FacePagerAdapter adapter;
	private LinearLayout layout;
	private LinearLayout layout_point;

	public FaceFrameController(Context context, FrameLayout parent, OnFaceClickCallback listener) {
		// 设置parent属性
		LinearLayout.LayoutParams params = (LinearLayout.LayoutParams) parent.getLayoutParams();
		params.width = DensityUtils.getDisplayMetrics(context).widthPixels;
		params.height = FacePagerAdapter.rowHeight * (FacePagerAdapter.row + 1);
		// 设置layout
		layout = new LinearLayout(context);
		layout.setBackgroundResource(R.color.white);
		layout.setLayoutParams(new LayoutParams(LayoutParams.MATCH_PARENT, LayoutParams.MATCH_PARENT));
		layout.setOrientation(1);
		// 设置face
		viewPager = new ViewPager(context);
		viewPager.setLayoutParams(new LayoutParams(LayoutParams.MATCH_PARENT, FacePagerAdapter.rowHeight * FacePagerAdapter.row));
		adapter = new FacePagerAdapter(context, listener);
		viewPager.setAdapter(adapter);
		viewPager.setOnPageChangeListener(new PagerChangerListener());
		// 设置point的layout
		layout_point = new LinearLayout(context);
		int h = FacePagerAdapter.rowHeight;
		layout_point.setLayoutParams(new LayoutParams(LayoutParams.MATCH_PARENT, h));
		layout_point.setGravity(Gravity.CENTER);
		// 设置point点数
		for (int i = 0; i < viewPager.getAdapter().getCount(); i++) {
			LinearLayout.LayoutParams layoutParams = new LinearLayout.LayoutParams(h / 6, h / 6);
			layoutParams.setMargins(h / 6, 0, 0, 0);
			ImageView imageView = new ImageView(context);
			imageView.setLayoutParams(layoutParams);
			layout_point.addView(imageView);
		}
		// 添加View
		layout.addView(viewPager);
		layout.addView(layout_point);
		parent.addView(layout);
	}

	public void hide() {
		layout.setVisibility(View.INVISIBLE);
	}

	public void show() {
		layout.setVisibility(View.VISIBLE);
	}

	class PagerChangerListener implements OnPageChangeListener {

		@Override
		public void onPageScrollStateChanged(int index) {
			// TODO Auto-generated method stub

		}

		@Override
		public void onPageScrolled(int index, float arg1, int arg2) {
			// TODO Auto-generated method stub
			setPointColor(index);
		}

		@Override
		public void onPageSelected(int index) {
			// TODO Auto-generated method stub
		}

	}

	private void setPointColor(int index) {
		for (int i = 0; i < layout_point.getChildCount(); i++) {
			ImageView imageView = (ImageView) layout_point.getChildAt(i);
			if (i == index)
				imageView.setImageResource(R.drawable.point_select_xml);
			else
				imageView.setImageResource(R.drawable.point_xml);
		}

	}
}
