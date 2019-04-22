package com.dzqc.student.ui.view;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.utils.DensityUtils;
import com.dzqc.student.utils.EmojiMapUtil;
import android.content.Context;
import android.support.v4.view.PagerAdapter;
import android.view.Gravity;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.LinearLayout.LayoutParams;

public class FacePagerAdapter extends PagerAdapter {

	private Context context;
	private OnFaceClickCallback listener;
	private int column = 7;
	private int count = EmojiMapUtil.map.size();
	// 每一页行数
	public final static int row = 3;
	// 表情符号大小
	private final static int faceSize = DensityUtils.dp2Px(DzqcStu.getInstance(), 20);
	// 每一行的高度
	public final static int rowHeight = DensityUtils.dp2Px(DzqcStu.getInstance(), 44);

	public FacePagerAdapter(Context context, OnFaceClickCallback listener) {
		this.context = context;
		this.listener = listener;
	}

	@Override
	public int getCount() {
		return (int) Math.ceil(((float) (count + count / (row * column))) / (row * column));
	}

	@Override
	public boolean isViewFromObject(View view, Object object) {
		return view == object;
	}

	@Override
	public void destroyItem(ViewGroup container, int position, Object object) {
		container.removeView((View) object);
	}

	@Override
	public Object instantiateItem(ViewGroup container, int position) {
		LinearLayout view = new LinearLayout(context);
		view.setOrientation(LinearLayout.VERTICAL);
		int start = row * column * position - position;
		int screenWidth = DensityUtils.getDisplayMetrics(context).widthPixels;
		int width = screenWidth / column;
		LayoutParams params = new LayoutParams(width, rowHeight);
		for (int i = 0; i < row; i++) {
			LinearLayout rowView = new LinearLayout(context);
			for (int j = 0; j < column; j++) {
				TextView textView = new TextView(context);
				textView.setLayoutParams(params);
				textView.setTextSize(faceSize);
				textView.setGravity(Gravity.CENTER);
				int index = i * column + j + start;
				if (index == count) {
					textView.setPadding(-faceSize, 0, 0, 0);
					textView.setCompoundDrawablesWithIntrinsicBounds(0, 0, 0, R.drawable.face_delete_btn);
					textView.setOnClickListener(new OnDeleteFaceClickListener());
				} else if (i + 1 == row && j + 1 == column && index < count) {
					textView.setPadding(-faceSize, 0, 0, 0);
					textView.setCompoundDrawablesWithIntrinsicBounds(0, 0, 0, R.drawable.face_delete_btn);
					textView.setOnClickListener(new OnDeleteFaceClickListener());
				} else if (index < this.count) {
					textView.setText(EmojiMapUtil.map.values().toArray()[index].toString());
					textView.setOnClickListener(new OnFaceClickListener(index));
				}
				rowView.addView(textView);
			}
			view.addView(rowView);
		}
		container.addView(view);
		return view;
	}

	private class OnFaceClickListener implements View.OnClickListener {
		private int position;

		public OnFaceClickListener(int position) {
			this.position = position;
		}

		@Override
		public void onClick(View v) {
			if (listener != null) {
				listener.onFaceClick(position);
			}
		}
	}

	private class OnDeleteFaceClickListener implements View.OnClickListener {

		@Override
		public void onClick(View v) {
			if (listener != null) {
				listener.onFaceDelete();
			}
		}
	}

	public interface OnFaceClickCallback {
		public void onFaceClick(int position);

		public void onFaceDelete();
	}

}
