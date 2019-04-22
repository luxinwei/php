package com.dzqc.enterprise.ui;

import android.content.Intent;
import android.media.AudioManager;
import android.os.Bundle;
import android.os.Handler;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RelativeLayout;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.ui.index.IndexFragment;
import com.dzqc.enterprise.ui.mine.MineFragment;
import com.dzqc.enterprise.ui.work.WorkFragment;
import com.dzqc.enterprise.utils.ToastUtils;
import com.dzqc.enterprise.utils.ViewUtils;

public class MainActivity extends FragmentActivity implements View.OnClickListener {

	private IndexFragment messageFragment;
	private MineFragment mineFragment;
	private WorkFragment workFragment;
	private View item_message;
	private View item_work;
	private View item_mini;
	private ViewGroup lastItem;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setVolumeControlStream(AudioManager.STREAM_MUSIC);
		setContentView(R.layout.activity_main);
		// 初始化底部按钮
		initBottomMenu();
		
	}

	private void initBottomMenu() {
		item_message = findViewById(R.id.item_index);
		item_work = findViewById(R.id.item_server);
		item_mini = findViewById(R.id.item_mine);
		item_message.setOnClickListener(this);
		item_work.setOnClickListener(this);
		item_mini.setOnClickListener(this);
		onClick(item_message);
	}

	@Override
	public void onClick(View v) {
		if (lastItem != null) {
			ViewUtils.setEnabledWithChild(lastItem, true);
		}
		lastItem = (RelativeLayout) v;
		ViewUtils.setEnabledWithChild(lastItem, false);
		changeFragment(v.getId());
	}

	@Override
	protected void onResume() {

		super.onResume();
	}

	@Override
	protected void onPause() {
		super.onPause();
	}

	@Override
	protected void onNewIntent(Intent intent) {
		super.onNewIntent(intent);
		if (intent.hasExtra("message"))
			ToastUtils.showToast(intent.getStringExtra("message"));
	}

	@Override
	protected void onDestroy() {

		super.onDestroy();
	}

	private void changeFragment(int itemId) {
		FragmentManager fm = getSupportFragmentManager();
		fm.executePendingTransactions();
		FragmentTransaction tran = fm.beginTransaction();
		if (fm.getFragments() != null) {
			for (Fragment fragment : fm.getFragments()) {
				tran.hide(fragment);
			}
		}
		switch (itemId) {
		case R.id.item_index:
			if (getMessageFragment().isAdded()) {
				tran.show(getMessageFragment());
			} else {
				tran.add(R.id.frame, getMessageFragment());
			}
			break;
		case R.id.item_server:
			if (getWorkFragment().isAdded()) {
				tran.show(getWorkFragment());
			} else {
				tran.add(R.id.frame, getWorkFragment());
			}
			break;
		case R.id.item_mine:
			if (getMineFragment().isAdded()) {
				tran.show(getMineFragment());
			} else {
				tran.add(R.id.frame, getMineFragment());
			}
			break;
		}
		tran.commitAllowingStateLoss();
	}

	public IndexFragment getMessageFragment() {
		if (messageFragment == null) {
			messageFragment = new IndexFragment();
		}
		return messageFragment;
	}

	public WorkFragment getWorkFragment() {
		if (workFragment == null) {
			workFragment = new WorkFragment();
		}
		return workFragment;
	}

	public MineFragment getMineFragment() {
		if (mineFragment == null) {
			mineFragment = new MineFragment();
		}
		return mineFragment;
	}

	
	private boolean isDouble = false;
	@SuppressWarnings("unused")
	@Override
	public void onBackPressed() {
		this.finish();
		if (false) {
			if (isDouble) {
				finish();
			} else {
				ToastUtils.showToast(R.string.again_to_exit);
				isDouble = true;
				new Handler().postDelayed(new Runnable() {
					@Override
					public void run() {
						isDouble = false;
					}
				}, 1000);
			}
		}
	}

}
